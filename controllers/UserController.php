<?php

class UserController extends BaseController {
    private $userModel;

    public function __construct(PDO $pdo) {
        parent::__construct($pdo);
        $this->userModel = new UserModel($pdo);
    }

    public function allUsers() {
        $this->checkSession();
        $users = $this->userModel->getAllUsers();
        $this->renderView('pages/users', ['users' => $users, 'page' => 'users']);
    }

    public function deleteUser() {
        $this->checkSession();
        $userId = $_GET['id'] ?? null;

        if ($userId) {
            $deleted = $this->userModel->deleteUser($userId);
            if ($deleted) {
                //$this->renderView('pages/users', ['users' => $this->userModel->getAllUsers(), 'page' => 'users']);
                header('Location: /users');
                exit;
            } else {
                $this->renderView('pages/error', ['message' => 'Nepodařilo se smazat uživatele.']);
            }
        } else {
            $this->renderView('pages/error', ['message' => 'Neplatné ID uživatele.']);
        }
    }

    public function createUser() {
        $this->checkSession();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['jmeno'] ?? '';
            $surname = $_POST['surname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? '';
            $phone_number = $_POST['phone_number'] ?? '';
            $class = $_POST['class'] ?? '';
            $description = $_POST['description'] ?? '';

            if ($name !== '' && $surname !== '' && $email !== '' && $password !== '' && $role !== '') {
                $created = $this->userModel->createUser(
                    $name,
                    $surname,
                    $email,
                    $password,
                    $role,
                    $phone_number,
                    $class,
                    $description
                );
                if ($created) {
                    header('Location: /users');
                    exit;
                } else {
                    $this->renderView('pages/error', ['message' => 'Nepodařilo se vytvořit uživatele.']);
                }
            } else {
                $this->renderView('pages/error', ['message' => 'Vyplňte všechna povinná pole.']);
            }
        } else {
            $this->renderView('pages/create_user', ['page' => 'create_user']);
        }
    }

    public function modifyUser()
    {
        $this->checkSession();
        $userId = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        $name = trim($_POST['jmeno'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $role = $_POST['role'] ?? '';
        $phoneNumber = trim($_POST['phone_number'] ?? '');
        $class = trim($_POST['class'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (
            !$userId
            || $name === ''
            || $surname === ''
            || !filter_var($email, FILTER_VALIDATE_EMAIL)
            || !in_array($role, ['student', 'teacher'], true)
        ) {
            http_response_code(400);
            $this->renderView('pages/error', ['message' => 'Vyplňte správně všechna povinná pole.']);
            return;
        }

        $updated = $this->userModel->updateUser(
            $userId,
            $name,
            $surname,
            $email,
            '',
            $role,
            $phoneNumber,
            $class,
            $description
        );

        if (!$updated) {
            $this->renderView('pages/error', ['message' => 'Nepodařilo se upravit uživatele.']);
            return;
        }

        header('Location: /users');
        exit;
    }

    public function modifyPage()
    {
        $this->checkSession();
        $userId = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
        $user = $userId ? $this->userModel->getUserById($userId) : false;

        if (!$user) {
            http_response_code(404);
            $this->renderView('pages/error', ['message' => 'Uživatel nebyl nalezen.']);
            return;
        }

        $this->renderView('pages/detail', ['page' => 'users', 'user' => $user]);
    }

    public function dashboard() {
        $this->checkSession();
        $users = $this->userModel->getLastLogged();
        $this->renderView('pages/dashboard', ['page' => 'dashboard', 'users' => $users]);
    }
}