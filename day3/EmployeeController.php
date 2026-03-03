<?php
require "db.php";


if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['update'])){

    $skills = "";
    if (isset($_POST['skills'])) {
        $skills = is_array($_POST['skills'])
            ? implode("-", $_POST['skills'])
            : trim((string)$_POST['skills']);
    }

    $stm = $connection->prepare("
        INSERT INTO employees
        (name, lastname, address, country, gender, skills, username, password, department, captcha)
        VALUES (?,?,?,?,?,?,?,?,?,?)
    ");

    $stm->execute([
        $_POST['name'],
        $_POST['lastname'],
        $_POST['address'],
        $_POST['country'],
        $_POST['gender'],
        $skills,
        $_POST['username'],
        $_POST['password'],
        $_POST['department'],
        $_POST['captcha']
    ]);

    header("Location: list.php");
    exit;
}


if(isset($_POST['update'])){

    $skills = "";
    if (isset($_POST['skills'])) {
        $skills = is_array($_POST['skills'])
            ? implode("-", $_POST['skills'])
            : trim((string)$_POST['skills']);
    }

    $stm = $connection->prepare("
        UPDATE employees 
        SET name=?, lastname=?, address=?, country=?, gender=?, skills=?, username=?, password=?, department=?, captcha=?
        WHERE id=?
    ");

    $stm->execute([
        $_POST['name'],
        $_POST['lastname'],
        $_POST['address'],
        $_POST['country'],
        $_POST['gender'],
        $skills,
        $_POST['username'],
        $_POST['password'],
        $_POST['department'],
        $_POST['captcha'],
        $_POST['id']
    ]);

    header("Location: list.php");
    exit;
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $stm = $connection->prepare("DELETE FROM employees WHERE id=?");
    $stm->execute([$id]);

    header("Location: list.php");
    exit;
}