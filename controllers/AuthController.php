<?php
class AuthController extends BaseController {
    
    public function openLogin() {
        $this->renderView('layout/auth/login');
    }

    public function checkLogin(PDO $pdo) {
        $email = $_POST['email'] ?? '';
        $passw = $_POST['password'] ?? '';

        if ($email === '' || $passw === '') {
            $this->renderView('layout/auth/login', [
                'chyba' => 'Vyplňte všechny údaje'
            ]);
            return;
        }

        $uzivatelModel = new UserModel($pdo);
        $uzivatel = $uzivatelModel->checkUser($email, $passw);

        if ($uzivatel) {
            # session_regenerate_id(true);
            $_SESSION['user_id'] = $uzivatel['id'];
            $_SESSION['user_role'] = $uzivatel['role'];
            header('Location: /');
            exit;
        } else {
            $this->renderView('layout/auth/login', [
                'chyba' => 'Nesprávný e-mail nebo heslo'
            ]);
        }
    }

    public function checkSession() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit; 
        }
    }
    // Metoda 3: Odhlášení
    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}