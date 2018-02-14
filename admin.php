<title>Admin Page</title><?php

if(isset($_POST["submit"])) {
	$conn = mysqli_connect("localhost", "root", "", "DatabaseExam");
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql = "SELECT id FROM adminusers WHERE username = '$username' AND password = '$password'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		header("Location: userlist.php");
		exit;
	} else {
		echo "<p style='color:red'>Wrong Username/Password</p>";
	}
}
?>

<form action="admin.php" method="POST">
	username:<input type="text" name="username">
	password:<input type="password" name="password">
	<input type="hidden" name="strongkey" value="Lzk34yR71?hrIP">
	<input type="submit" name="submit" value="login">
</form>