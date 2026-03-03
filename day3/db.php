<?php
$host = "localhost";
$dbname = "company";
$username = "root";
$password = "root";

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Failed to connect: " . $e->getMessage();
}
