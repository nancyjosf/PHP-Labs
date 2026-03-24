<?php
include "db.php";
session_start();

if (isset($_POST['register'])) {
    $errors = [];

    $fname = trim($_POST['fname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $addr = trim($_POST['addr'] ?? '');
    $country = trim($_POST['country'] ?? '');
    $gender = trim($_POST['gender'] ?? '');
    $skills = $_POST['skills'] ?? [];
    $username = trim($_POST['username'] ?? '');
    $pass = trim($_POST['pass'] ?? '');
    $dep = trim($_POST['dep'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $_SESSION['old'] = [
        'fname' => $fname,
        'lname' => $lname,
        'addr' => $addr,
        'country' => $country,
        'gender' => $gender,
        'skills' => $skills,
        'username' => $username,
        'dep' => $dep,
        'email' => $email
    ];

    if ($fname === '') {
        $errors['fname'] = 'First name is required.';
    } elseif (preg_match('/\d/', $fname)) {
        $errors['fname'] = 'First name must not contain numbers.';
    }

    if ($lname === '') {
        $errors['lname'] = 'Last name is required.';
    } elseif (preg_match('/\d/', $lname)) {
        $errors['lname'] = 'Last name must not contain numbers.';
    }

    if ($addr === '') {
        $errors['addr'] = 'Address is required.';
    }

    if ($country === '') {
        $errors['country'] = 'Country is required.';
    }

    if ($gender === '') {
        $errors['gender'] = 'Gender is required.';
    }

    if (!is_array($skills) || count($skills) === 0) {
        $errors['skills'] = 'Please select at least one skill.';
    }

    if ($username === '') {
        $errors['username'] = 'Username is required.';
    }

    if ($pass === '') {
        $errors['pass'] = 'Password is required.';
    } elseif (!preg_match('/^[a-z0-9_]{8}$/', $pass)) {
        $errors['pass'] = 'Password must be exactly 8 chars with lowercase letters, numbers, underscore only.';
    }

    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    $profilePath = '';
    if (!isset($_FILES['profile']) || $_FILES['profile']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['profile'] = 'Profile picture is required.';
    } else {
        $file = $_FILES['profile'];
        $allowed = ['image/jpeg' => 'jpg', 'image/png' => 'png'];

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors['profile'] = 'Failed to upload file.';
        } elseif (!isset($allowed[$file['type']])) {
            $errors['profile'] = 'Only JPG and PNG files are allowed.';
        } elseif ($file['size'] > 2 * 1024 * 1024) {
            $errors['profile'] = 'File size must be 2MB or less.';
        } else {
            $uploadDir = __DIR__ . '/uploads';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = $allowed[$file['type']];
            $newName = 'user_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $target = $uploadDir . '/' . $newName;

            if (move_uploaded_file($file['tmp_name'], $target)) {
                $profilePath = 'uploads/' . $newName;
            } else {
                $errors['profile'] = 'Could not save uploaded file.';
            }
        }
    }

    $usernameEsc = mysqli_real_escape_string($conn, $username);
    $checkUser = mysqli_query($conn, "SELECT id FROM users WHERE username='$usernameEsc' LIMIT 1");
    if ($checkUser && mysqli_num_rows($checkUser) > 0) {
        $errors['username'] = 'Username already exists.';
    }

    $emailEsc = mysqli_real_escape_string($conn, $email);
    $checkEmail = mysqli_query($conn, "SELECT id FROM users WHERE email='$emailEsc' LIMIT 1");
    if ($checkEmail && mysqli_num_rows($checkEmail) > 0) {
        $errors['email'] = 'Email already exists.';
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: register.php');
        exit;
    }

    $fnameEsc = mysqli_real_escape_string($conn, $fname);
    $lnameEsc = mysqli_real_escape_string($conn, $lname);
    $addrEsc = mysqli_real_escape_string($conn, $addr);
    $countryEsc = mysqli_real_escape_string($conn, $country);
    $genderEsc = mysqli_real_escape_string($conn, $gender);
    $skillsEsc = mysqli_real_escape_string($conn, implode('|', $skills));
    $passEsc = mysqli_real_escape_string($conn, $pass);
    $emailEsc = mysqli_real_escape_string($connection, $email);
    $profileEsc = mysqli_real_escape_string($connection, $profilePath);
    $fullNameEsc = mysqli_real_escape_string($connection, trim($fname . ' ' . $lname));

    $sql = "INSERT INTO users (name, first_name, last_name, address, country, gender, skills, username, password, email, profile_picture)
            VALUES ('$fullNameEsc', '$fnameEsc', '$lnameEsc', '$addrEsc', '$countryEsc', '$genderEsc', '$skillsEsc', '$usernameEsc', '$passEsc', '$emailEsc', '$profileEsc')";

    try {
        if (mysqli_query($connection, $sql)) {
            unset($_SESSION['old']);
            header('Location: login.php');
            exit;
        }
    } catch (mysqli_sql_exception $e) {
        if ((int)$e->getCode() === 1062 && strpos($e->getMessage(), 'users.email') !== false) {
            $_SESSION['errors'] = ['email' => 'Email already exists.'];
            header('Location: register.php');
            exit;
        }

        if ((int)$e->getCode() === 1062 && strpos($e->getMessage(), 'users.username') !== false) {
            $_SESSION['errors'] = ['username' => 'Username already exists.'];
            header('Location: register.php');
            exit;
        }

        $_SESSION['errors'] = ['username' => 'Failed to register user.'];
        header('Location: register.php');
        exit;
    }

    $_SESSION['errors'] = ['username' => 'Failed to register user.'];
    header('Location: register.php');
    exit;
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        header('Location: login.php?error=1');
        exit;
    }

    $emailEsc = mysqli_real_escape_string($connection, $email);
    $passwordEsc = mysqli_real_escape_string($connection, $password);
    $sql = "SELECT * FROM users WHERE email='$emailEsc' AND password='$passwordEsc' LIMIT 1";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        header('Location: home.php');
        exit;
    }

    header('Location: login.php?error=1');
    exit;
}

if (isset($_POST['update'])) {
    $id = (int)($_POST['id'] ?? 0);
    $fname = trim($_POST['fname'] ?? '');
    $lname = trim($_POST['lname'] ?? '');
    $country = trim($_POST['country'] ?? '');

    if ($id > 0) {
        $fnameEsc = mysqli_real_escape_string($connection, $fname);
        $lnameEsc = mysqli_real_escape_string($connection, $lname);
        $countryEsc = mysqli_real_escape_string($connection, $country);
        mysqli_query($connection, "UPDATE users SET first_name='$fnameEsc', last_name='$lnameEsc', country='$countryEsc' WHERE id=$id");
    }
    header('Location: list.php');
    exit;
}

if (isset($_GET['delete'])) {
    $id = (int)($_GET['delete'] ?? 0);
    if ($id > 0) {
        mysqli_query($connection, "DELETE FROM users WHERE id=$id");
    }
    header('Location: list.php');
    exit;
}
