<?php
session_start();
$usrname = $_POST["username"];
$password = $_POST["password"];

$conn = mysqli_connect("localhost", "root", "", "DatabaseExam");


$sql = "SELECT id, name FROM users WHERE username = '$usrname' AND password = '$password'";
echo $sql . "<br>";
$result = $conn->query($sql);
if($row = $result->fetch_assoc())
{
    var_dump($row);
    $id = $row["id"];
    $name = $row["name"];
    $_SESSION['userID'] = $id;
    $_SESSION["userName"] = $name;
}
header("Location: index.php");//redirects back
