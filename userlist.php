<?php
	$conn = mysqli_connect("localhost", "root", "", "DatabaseExam");

	if(isset($_GET['deleteuser']))
	{
		$userID = $_GET['deleteuser'];
		$sql = "delete from users where ID = ".$userID;
		mysqli_query($conn,$sql);
	}

	$sql = "SELECT id, name FROM users WHERE 1";
	$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>User List</title>

</head>
<body>
	<h1>Users:</h1>
	<?php 
	while($row = $result->fetch_assoc()){
		echo $row["name"];
		echo "
		<a onClick=\"javascript: return confirm('Are you sure you want to delete this user?');\" 
		href='?deleteuser=".$row['id']."'>delete</a>
		<br>
		";
	}
	?>
</body>
</html>