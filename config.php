<?php 
$conn = mysqli_connect("localhost", "root", "", "DatabaseExam"); 
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
?>