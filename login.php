<?php
session_start();
include('./config.php');

$usrname = mysqli_real_escape_string($conn,$_POST['username']);

		
		$sqlVerify = "select Password from Users where Username = '".$usrname."'";
		$sqlQueryVerify = mysqli_query($conn,$sqlVerify);
		$dbFetchVerify = mysqli_fetch_array($sqlQueryVerify);
		if (password_verify($_POST['password'], $dbFetchVerify['Password']))
		{
		
			$sql = "select * from Users where Username = '".$usrname."'";
			$result = $conn->query($sql);
			if($row = $result->fetch_assoc())
			{
				var_dump($row);
				$id = $row["id"];
				$name = $row["name"];
				$_SESSION['userID'] = $id;
				$_SESSION["userName"] = $name;
			}
		}
		header('Location: ./index.php');