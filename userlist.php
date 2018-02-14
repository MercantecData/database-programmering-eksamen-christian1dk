<?php
session_start();
include('./config.php');
if (!isset($_SESSION['admin_info']))
{
	header('Location: ./index.php');
}

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
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="grid">
		<div class="topbar">
			<h1>MercBook</h1>
			<h2>Billeder fra Mercantec</h2>
		</div>

		<div class="login">
			<form method="POST" action="logout.php">
				<input type="submit" name="submit" value="logout">
			</form>
			<br>
			<form method="post" action="add.php">
				<input type="submit" name="submit" value="Add brugere">
			</form>
		</div>
		<div class="content">
			<h1>Users:</h1>
			<?php 
			while($row = $result->fetch_assoc()){
				echo $row["name"];
				echo "
				<br>
				<form method='post' action='edit.php'>
						<button type='submit' name='userid' value='".$row["id"]."' id='user'>Edit</button>
				<form>";
				echo "
				<button><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?');\" 
				href='?deleteuser=".$row['id']."'>delete</a></button>
				<br><br>
				";
			}
			?>
			<br>
			<a href="index.php">Back</a>
		</div>
	</div>
	<script>

$(document).ready(function() {
     $('#user').click(function() {
         var userid = $('#userid').val();
         $.ajax({
             url:"edit.php",
             type:"post",
             data:{userid:userid},
             success:function(response){
                console.log('success ajax');
             },
             error:function(response){
                console.log('error ajax');
             }
         });
     });
});
</script>
</body>
</html>