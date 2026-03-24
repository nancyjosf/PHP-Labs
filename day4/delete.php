<?php
include "db.php";
session_start();

if(!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($connection, "DELETE FROM users WHERE id=$id");
    header("Location: list.php");
    exit;
}
?>
