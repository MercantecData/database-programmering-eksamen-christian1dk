<title>Admin Page</title><?php
session_start();
include('./config.php');
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
<a href="index.php">Back</a>