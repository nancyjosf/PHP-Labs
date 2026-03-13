<?php

if (isset($_POST['register'])) {

    try {
        $connection = new PDO("mysql:host=localhost;dbname=company", "root", "root");

        $skills = "";
        if (isset($_POST['skills'])) {
            $skills = is_array($_POST['skills'])
                ? implode("-", $_POST['skills'])
                : $_POST['skills'];
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
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


if (isset($_POST['update'])) {

    try {
        $connection = new PDO("mysql:host=localhost;dbname=company", "root", "root");

        $skills = "";
        if (isset($_POST['skills'])) {
            $skills = is_array($_POST['skills'])
                ? implode("-", $_POST['skills'])
                : $_POST['skills'];
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
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


if (isset($_GET['delete'])) {

    try {
        $connection = new PDO("mysql:host=localhost;dbname=company", "root", "root");

        $stm = $connection->prepare("DELETE FROM employees WHERE id=?");
        $stm->execute([$_GET['delete']]);

        header("Location: list.php");
        exit;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

header("Location: register.php");
exit;
