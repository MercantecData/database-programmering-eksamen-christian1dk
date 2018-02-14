<?php
session_start();
include('./config.php');
$loggedIn = isset($_SESSION['userID']);
if (!isset($_SESSION['admin_info']))
{
	header('Location: ./index.php');
}
if(isset($_POST['userid']) || isset($_POST['Update']))
{

}
else
{
    header('Location: ./userlist.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>MercBook</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
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
			<form method="post" action="add.php">
				<input type="submit" name="submit" value="Join">
			</form>
			<?php else:?>
			<form method="POST" action="logout.php">
				<input type="submit" name="submit" value="logout">
			</form>
			<?php endif;?>
		</div>

		<div class="content">
<?php
                        
            if(isset($_POST['Update'])){
                $Name = mysqli_real_escape_string($conn,$_POST['Name']);
                $userID = mysqli_real_escape_string($conn,$_POST['userID']);
                
                if(!empty($err)) {
                        echo "<p>".implode("<br />",$err)."</p>";

                } else {
                    $sql = "update users set 
                                        name = '".$Name."'
                                        where ID = ".$userID;
                                        
                mysqli_query($conn,$sql);
                @header('Location: ./userlist.php');
                }
            }
            else
            {
                $userID = $_POST['userid'];
                $sql = "select * from Users where ID =".$userID;
                $query = $conn->query($sql);
                $intQuery = mysqli_num_rows($query);

                if($intQuery== true){
                    $row = $query->fetch_assoc();
                    
                    $Name = $row['name'];

                    echo "
                    <form method='post'  enctype='multipart/form-data'>
                        <input type='hidden' name='userID' value='".$userID."' />

                        <input name='Name' value='".$row['name']."'>
                        
                        <hr>
                        <input class='admbtn'type='submit' name='Update' value='Update'>
                        <br>
                        <a href='./index.php' class='admbtn'>Tilbage</a>
                
                    </form>";
                }
            }
?>
		</div>
	</div>

	<a href="admin.php">Admin Login</a>