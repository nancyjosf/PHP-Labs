<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../config/database.php';

use App\Models\User;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showRegister()
    {
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
        $old = isset($_SESSION['old']) ? $_SESSION['old'] : [];
        unset($_SESSION['errors'], $_SESSION['old']);

        $this->render('register', [
            'errors' => $errors,
            'old' => $old,
        ]);
    }

    public function register()
    {
        $errors = [];

        $fname = $this->validateInput($_POST['fname'] ?? '');
        $lname = $this->validateInput($_POST['lname'] ?? '');
        $addr = $this->validateInput($_POST['addr'] ?? '');
        $country = $this->validateInput($_POST['country'] ?? '');
        $gender = $this->validateInput($_POST['gender'] ?? '');
        $skills = $_POST['skills'] ?? [];
        $username = $this->validateInput($_POST['username'] ?? '');
        $pass = trim($_POST['pass'] ?? '');
        $dep = $this->validateInput($_POST['dep'] ?? '');
        $email = $this->validateInput($_POST['email'] ?? '');

        $_SESSION['old'] = [
            'fname' => $fname,
            'lname' => $lname,
            'addr' => $addr,
            'country' => $country,
            'gender' => $gender,
            'skills' => $skills,
            'username' => $username,
            'dep' => $dep,
            'email' => $email,
        ];

        if ($fname === '') {
            $errors['fname'] = 'First name is required.';
        } elseif (preg_match('/\\d/', $fname)) {
            $errors['fname'] = 'First name must not contain numbers.';
        }

        if ($lname === '') {
            $errors['lname'] = 'Last name is required.';
        } elseif (preg_match('/\\d/', $lname)) {
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
                $uploadDir = __DIR__ . '/../uploads';
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

        if ($this->userModel->existsByUsername($username)) {
            $errors['username'] = 'Username already exists.';
        }

        if ($this->userModel->emailExists($email)) {
            $errors['email'] = 'Email already exists.';
        }

        if (!empty($errors)) {
            if ($profilePath !== '' && file_exists(__DIR__ . '/../' . $profilePath)) {
                unlink(__DIR__ . '/../' . $profilePath);
            }
            $_SESSION['errors'] = $errors;
            $this->redirect('register');
        }

        $created = $this->userModel->create([
            'name' => trim($fname . ' ' . $lname),
            'first_name' => $fname,
            'last_name' => $lname,
            'address' => $addr,
            'country' => $country,
            'gender' => $gender,
            'skills' => implode('|', $skills),
            'username' => $username,
            'password' => $pass,
            'email' => $email,
            'profile_picture' => $profilePath,
        ]);

        if ($created) {
            unset($_SESSION['old']);
            $this->redirect('login');
        }

        $_SESSION['errors'] = ['username' => 'Failed to register user.'];
        $this->redirect('register');
    }

    public function showLogin()
    {
        $error = isset($_GET['error']) ? $_GET['error'] : '';
        $this->render('login', ['error' => $error]);
    }

    public function login()
    {
        $email = $this->validateInput($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $this->redirect('login', ['error' => '1']);
        }

        $user = $this->userModel->findByEmailAndPassword($email, $password);

        if ($user) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $this->redirect('home');
        }

        $this->redirect('login', ['error' => '1']);
    }

    public function home()
    {
        $this->requireAuth();
        $userName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : $_SESSION['user'];
        $this->render('home', ['userName' => $userName]);
    }

    public function listUsers()
    {
        $this->requireAuth();
        $users = $this->userModel->getAll();
        $this->render('list', ['users' => $users]);
    }

    public function viewUser()
    {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);
        $row = $this->userModel->getById($id);
        if (!$row) {
            $this->redirect('list');
        }
        $this->render('view', ['row' => $row]);
    }

    public function editUser()
    {
        $this->requireAuth();
        $id = (int)($_GET['id'] ?? 0);
        $row = $this->userModel->getById($id);
        if (!$row) {
            $this->redirect('list');
        }
        $this->render('edit', ['row' => $row]);
    }

    public function updateUser()
    {
        $this->requireAuth();
        $id = (int)($_POST['id'] ?? 0);
        $fname = $this->validateInput($_POST['fname'] ?? '');
        $lname = $this->validateInput($_POST['lname'] ?? '');
        $country = $this->validateInput($_POST['country'] ?? '');

        if ($id > 0) {
            $this->userModel->update($id, [
                'first_name' => $fname,
                'last_name' => $lname,
                'country' => $country,
            ]);
        }

        $this->redirect('list');
    }

    public function deleteUser()
    {
        $this->requireAuth();
        $id = (int)($_GET['delete'] ?? 0);
        if ($id > 0) {
            $this->userModel->delete($id);
        }
        $this->redirect('list');
    }

    public function profile()
    {
        $this->requireAuth();
        $username = $_SESSION['user'];
        $row = $this->userModel->findByUsername($username);

        if (!$row) {
            $this->redirect('login', ['error' => '1']);
        }

        $this->render('profile', ['row' => $row]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }

    private function requireAuth()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('login');
        }
    }

    private function render($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }

    private function redirect($action, $params = [])
    {
        $query = http_build_query(array_merge(['action' => $action], $params));
        header('Location: index.php?' . $query);
        exit;
    }

    private function validateInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        return $data;
    }
}
