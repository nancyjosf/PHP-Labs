<?php
session_start();

require_once __DIR__ . '/controllers/UserController.php';

$controller = new UserController();
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === '') {
    $action = isset($_SESSION['user']) ? 'home' : 'login';
}

switch ($action) {
    case 'register':
        $controller->showRegister();
        break;

    case 'registerStore':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->register();
        }
        header('Location: index.php?action=register');
        exit;

    case 'login':
        $controller->showLogin();
        break;

    case 'loginStore':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->login();
        }
        header('Location: index.php?action=login');
        exit;

    case 'home':
        $controller->home();
        break;

    case 'list':
        $controller->listUsers();
        break;

    case 'view':
        $controller->viewUser();
        break;

    case 'edit':
        $controller->editUser();
        break;

    case 'updateUser':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->updateUser();
        }
        header('Location: index.php?action=list');
        exit;

    case 'deleteUser':
        $controller->deleteUser();
        break;

    case 'profile':
        $controller->profile();
        break;

    case 'logout':
        $controller->logout();
        break;

    default:
        header('Location: index.php?action=login');
        exit;
}
