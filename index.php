<?php
session_start();
include('./config.php');
$loggedIn = isset($_SESSION['userID']);
if($loggedIn) {
	$id =  $_SESSION['userID'];

	//Check if user exist in Database
	$sqlUserCheck = "SELECT id FROM users WHERE id = $id";
	$result = $conn->query($sqlUserCheck);
	if($result->num_rows > 0) {
		$sql = "SELECT id, imageURL FROM images WHERE owner = $id";
		$imageresult = $conn->query($sql);
	}
	else
	{
		//header("Location: logout.php?exist=0");
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
			<h1>Velkommen Til!</h1>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus feugiat quis purus ut bibendum. Mauris sit amet lacinia arcu. Vivamus fringilla magna id augue luctus interdum. 

			<?php 
			if($loggedIn) {
				echo "<h2>Dine Billeder</h2>";
				while($row = $imageresult->fetch_assoc()) {
					$url = $row["imageURL"];
					$id = $row["id"];
					echo "<form method='post' action='image.php'>";
					echo "<input type='image' id='imageview' class='myImage' name='image' value='$id' src='$url'>";
					//echo "<a id='imageview' href='image.php'><img class = 'myImage' src='$url'></a>";
					echo "<form>";
				}
			} 
			?>
			<div class="myTextArea"><p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus feugiat quis purus ut bibendum. Mauris sit amet lacinia arcu. Vivamus fringilla magna id augue luctus interdum. Aliquam urna dui, efficitur at imperdiet sed, ultricies eu tellus. Pellentesque iaculis sagittis nisi id ultrices. Phasellus pharetra diam ac ex feugiat dapibus eget a diam. Fusce ullamcorper nunc quis massa ornare dapibus. Nunc efficitur nunc ut consectetur condimentum. Maecenas faucibus quis justo nec venenatis. Donec at placerat magna. Donec a lobortis eros. Aliquam erat volutpat. Proin gravida orci ut semper aliquet. Donec vitae purus commodo, accumsan purus sed, congue neque. Nullam egestas, augue sed euismod mollis, leo risus elementum nisi, non venenatis felis justo ac libero.
			</p>
			<p>
				Etiam euismod arcu at sapien fermentum vulputate. Vivamus suscipit imperdiet nulla non ornare. Integer at nisi metus. Donec elementum magna et faucibus sagittis. Fusce placerat venenatis semper. Vivamus sed dictum nunc. Morbi elit ex, ornare sit amet dui in, faucibus fermentum elit. Vivamus rutrum dui nec risus suscipit, in dapibus elit elementum. Sed ut aliquet dolor. Aliquam id blandit lorem, eget gravida neque. Donec luctus orci felis, vitae laoreet lacus porta et. Integer mattis justo lacus, ac consectetur est semper non. Phasellus sit amet eros eget enim cursus euismod vel vel eros. Nunc vulputate metus quis est fermentum sollicitudin. In quis lobortis neque. Aliquam ac lectus venenatis, bibendum leo vel, consectetur massa.
			</p>
			<p>
				Ut imperdiet ut lacus in aliquet. Nam a risus massa. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi posuere blandit vehicula. Nam placerat vel urna et malesuada. Duis varius, lorem et vulputate porttitor, turpis metus accumsan est, eu vehicula nibh justo non est. Phasellus in venenatis eros. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus maximus eu ligula sed venenatis. Pellentesque sed porttitor nunc. Aliquam vel massa iaculis, tristique magna eget, pharetra metus. Praesent aliquam nunc eget porta dignissim. Phasellus hendrerit sem eget diam sagittis volutpat. Vivamus accumsan vehicula ante at rhoncus. Aenean eu commodo ligula. Suspendisse quis consectetur enim, vel pellentesque est.
			</p>
			<p>
				Duis augue mauris, fermentum sit amet urna ut, iaculis cursus dolor. Praesent elit nunc, molestie sed erat ac, rutrum egestas metus. Praesent rhoncus erat sed facilisis aliquam. Nullam aliquet massa sit amet erat euismod, non ullamcorper ipsum sollicitudin. Aenean accumsan erat nec lorem aliquam, eu pharetra velit placerat. Nunc tincidunt lacus non nisl hendrerit semper. In eleifend augue id elit porttitor bibendum. Ut vitae risus ac turpis sodales tristique. Aenean quis bibendum sapien, in porta sapien. Curabitur ultrices sodales augue eget pellentesque. Integer tortor neque, auctor sit amet justo vel, fermentum laoreet velit.
			</p>
			<p>
				Maecenas mollis nulla a ultrices sagittis. Phasellus tellus augue, pretium et mattis in, venenatis quis tortor. Cras eget lorem nulla. Quisque semper condimentum hendrerit. Nunc laoreet, mauris in ullamcorper dignissim, turpis dui convallis mi, sed dapibus quam justo vitae nibh. Donec sapien nulla, maximus quis commodo vitae, rutrum in magna. Sed congue semper nulla, ac pretium sapien. Nam blandit augue sed neque pellentesque, at scelerisque tellus consectetur. Sed auctor, ipsum at sollicitudin congue, ligula lorem faucibus magna, et congue sem lacus in dui.
			</div>
		</div>
	</div>

	<a href="admin.php">Admin Login</a>

<script>

$(document).ready(function() {
     $('#imageview').click(function() {
         var image = $('#image').val();
         $.ajax({
             url:"image.php",
             type:"post",
             data:{image:image},
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