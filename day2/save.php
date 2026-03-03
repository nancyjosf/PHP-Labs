<?php

$data = implode(",", $_POST);

if (filesize("data.txt") == 0) {
    file_put_contents("data.txt", $data, FILE_APPEND);
} else {
    file_put_contents("data.txt", "\n" . $data, FILE_APPEND);
}

header("Location: list.php");
?>