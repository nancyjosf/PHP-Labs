<?php
$id = $_GET['id'];

$rows = file("data.txt");

$data = explode(",", $rows[$id]);

echo "<h2>Row Details</h2>";
echo "<ul>";
foreach ($data as $value) {
    echo "<li>$value</li>";
}
echo "</ul>";
