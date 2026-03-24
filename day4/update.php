<?php
include "db.php";
session_start();

if(!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$country = $_POST['country'];

$sql = "UPDATE users SET first_name='$fname', last_name='$lname', country='$country' WHERE id=$id";
mysqli_query($connection, $sql);
header("Location: list.php");
?>
