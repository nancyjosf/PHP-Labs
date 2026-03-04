<?php
$host = "localhost";
$dbname = "company";
$username = "root";
$password = "root";

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "Failed to connect";
}