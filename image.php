<?php
session_start();
include('./config.php');
$loggedIn = isset($_SESSION['userID']);
if($loggedIn) {

    if(isset($_GET['deleteimage']))
	{
		$imageID = $_GET['deleteimage'];
		$sql = "delete from images where ID = ".$imageID;
        mysqli_query($conn,$sql);
        header('Location: ./index.php');
    }
    else
    {
        $imageID = $_POST['image'];
    }
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
			if($loggedIn) {
                $sql = "SELECT id, imageURL FROM images WHERE id = $imageID";
                $imageresult = $conn->query($sql);
                while($row = $imageresult->fetch_assoc()) {
                echo "<img src='".$row['imageURL']."'>";
                }
                echo "
				<a onClick=\"javascript: return confirm('Are you sure you want to delete this image?');\" 
				href='?deleteimage=".$imageID."'>delete</a>
				<br>
				";
			} 
			?>
            <br>
            <a href="index.php">Back</a>
		</div>
	</div>

	<a href="admin.php">Admin Login</a>

</body>
</html>