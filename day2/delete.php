<?php

$id = $_GET['id'] ?? null;

$old_data = file("data.txt");
$new_data = "";

foreach ($old_data as $index => $row) {

    if ($index == $id) {
        continue;
    }

$new_data = $new_data . $row;
}

file_put_contents("data.txt", $new_data);

header("Location: list.php");
exit;

?>