<?php
session_start();
$loggedIn = isset($_SESSION['userID']);
if($loggedIn) {
	$conn = mysqli_connect("localhost", "root", "", "databaseexam");
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
		header("Location: logout.php?exist=0");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>MercBook</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style type="text/css">
		.grid {
			display: grid;
			grid-template-areas: "topbar login" "myContent myContent";
			grid-template-columns: auto 135px;
			grid-template-rows: 110px auto;
			max-width: 535px;
			margin-left: auto;
			margin-right: auto;
			grid-gap: 20px;
		}

		.topbar{
			grid-area: topbar;
			background-color: lightgray;
			color:grey;
			font-family: sans-serif;
			padding-left: 15px;
		}

		.login{
			grid-area: login;
		}

		.content{
			grid-area: myContent;
			background-color: white;
			padding:10px;
		}

		.myTextArea {
			min-width: 100px;
			max-width: 535px;
		}

		input{
			width: 95%;
		}

		p {
			text-align: justify;
		}

		body {
			font-family: sans-serif;
			background-color: darkgrey;
		}

		.myImage {
			max-width: 48%;
			margin: 1%;
		}

	</style>
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
			<h1>Velkommen Til!</h1>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus feugiat quis purus ut bibendum. Mauris sit amet lacinia arcu. Vivamus fringilla magna id augue luctus interdum. 

			<?php 
			if($loggedIn) {
				echo "<h2>Dine Billeder</h2>";
				while($row = $imageresult->fetch_assoc()) {
					$url = $row["imageURL"];
					echo "<img class = 'myImage' src='$url'>";
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

</body>
</html>