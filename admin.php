<?php
session_start();
include('./config.php');
$loggedIn = isset($_SESSION['userID']);
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Page</title>
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
		if (isset($_SESSION['admin_info']))
		{
			header('Location: ./userlist.php');
		}
		if(isset($_POST["submit"])) {
				$usrname = mysqli_real_escape_string($conn,$_POST['username']);

				
				$sqlVerify = "select Password from adminusers where Username = '".$usrname."'";
				$sqlQueryVerify = mysqli_query($conn,$sqlVerify);
				$dbFetchVerify = mysqli_fetch_array($sqlQueryVerify);
				if (password_verify($_POST['password'], $dbFetchVerify['Password']))
				{
				
					$sql = "select * from adminusers where Username = '".$usrname."'";
					$result = $conn->query($sql);
					if($result->num_rows > 0)
					{
				
						$_SESSION['admin_info'] = mysqli_fetch_array($result);
						unset($_SESSION['admin_info']['password']);
						
						header("Location: userlist.php");
						exit;
					} else {
				echo "<p style='color:red'>Wrong Username/Password</p>";
				}
			}
		}
		?>

		<form action="admin.php" method="POST">
			username:<input type="text" name="username">
			password:<input type="password" name="password">
			<input type="hidden" name="strongkey" value="Lzk34yR71?hrIP">
			<input type="submit" name="submit" value="login">
		</form>
		<br>
		<a href="index.php">Back</a>

		</div>
</div>