<?php include("config.php");
@session_start();
$loggedIn = isset($_SESSION['userID']);
include('./config.php');

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['user']))
    { 
        if($_POST['passwd'] == $_POST['passwd2']){
        $uname = mysqli_real_escape_string($conn,$_POST['uname']);
        $hash = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
        $password = mysqli_real_escape_string($conn, $hash);
        $Name = mysqli_real_escape_string($conn,$_POST['Name']);
        $Create = mysqli_real_escape_string($conn,$_POST['create']);

        echo $Create;
            if ($Create == 'admin')
            {
                $sql = "INSERT INTO adminusers (username, password) VALUES ('$uname', '$password')";
                $result = mysqli_query($conn,$sql);
            }
            else 
            {
                $sql = "INSERT INTO Users (username, password, name) VALUES ('$uname', '$password', '$Name')";
                $result = mysqli_query($conn,$sql);
            }
        }
        else {
            $pwerror = '<p style="color:red;">Kodeordene er ikke éns. Pr&oslash;v igen.</p>';
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Opret Bruger</title>
  <meta name="description" content="">
  <meta name="author" content="">


  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/style.css">

<script>
    function accountType(that) {
        if (that.value == "user") {
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
</script>
</head>
<body>
<div class="grid">
		<div class="topbar">
			<h1>MercBook</h1>
			<h2>Billeder fra Mercantec</h2>
		</div>

		<div class="login">
			<?php if(!$loggedIn):?>
			<form method="post" action="login.php">
				Brugernavn <input type="text" name="username">
				Password<input type="password" name="password">
				<input type="submit" name="submit" value="login">
			</form>
			<?php else:?>
			<form method="POST" action="logout.php">
				<input type="submit" name="submit" value="logout">
			</form>
			<?php endif;?>
		</div>

        <div class="content">
        <h2>Create User</h2>
        <form method="post" enctype="multipart/form-data">
        <div>
            <?php
                if (isset($_SESSION['admin_info']))
                {
            ?>
            <div>
                <label>User or Admin</label>
                <p>Select user or admin</p>
                    <select name="create" onchange="accountType(this);">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <br>
                <div id="ifYes">
                <label>Name</label>
                <p>Input Full Name</p>
                <input class="addufield" type="text" 
                        <?php if(!empty($pwerror)){$Name = $_POST['Name']; echo 'value="'.$Name.'"';}?> maxlength="100" name="Name" required>
                </div>
            <?php
                }
                else
                {
                    echo '<input type="hidden" name="create">
                    <div>
                    <label>Name</label>
                    <p>Input Full Name</p>
                    <input class="addufield" type="text"';
                            if(!empty($pwerror)){$Name = $_POST['Name']; echo 'value="'.$Name.'"';}
                    echo' maxlength="100" name="Name" required>
                    </div>
                    ';
                }
            ?>
            <br>
            <div>
              <label>Username</label>
              <p>Input Username</p>
              <input class="addufield" type="text" 
                     <?php if(!empty($pwerror)){$uname = $_POST['uname']; echo 'value="'.$uname.'"';}?> maxlength="100" name="uname" required>
            </div>
            <br>
            <div>
              <label>Password</label>
              <p>Input password</p>
              <input class="addufield" type="password" maxlength="50" name="passwd" required>
                <?php if(!empty($pwerror)){echo $pwerror;}?>
            </div>
            <br>
            <div>
              <label>Password</label>
              <p>Input password again</p>
              <input class="addufield" type="password" maxlength="50" name="passwd2" required>
            </div>
            <input class="button" type="submit" name='user' value="Save">
        </form>
        <a href="index.php">Back</a>

</div>
</div>
</body>
</html>