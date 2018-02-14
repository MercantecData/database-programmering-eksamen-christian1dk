<?php
if(isset($_POST["submit"]) || ($_GET["exist"] == 0)) {
	session_start();
	session_unset();
	session_destroy();
	header("Location: index.php");
}
