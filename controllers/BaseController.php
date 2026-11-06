<?php
class BaseController {
    protected $pdo;

    // Tuto metodu tam musíš mít, jinak na ni UserController nemůže zavolat 'parent::'
    public function __construct(PDO $pdo = null) {
        $this->pdo = $pdo;
    }
    
    protected function renderView($nazevSablony, $data = []) {
        // extract() rozbalí pole ['titulek' => 'Ahoj'] na proměnnou $titulek
        extract($data); 
        
        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/layout/navigation.php';
        require __DIR__ . '/../views/' . $nazevSablony . '.php';
        require __DIR__ . '/../views/layout/footer.php';
    }

    // Tato metoda funguje jako vyhazovač
    protected function checkSession() {
        if (!isset($_SESSION['user_id'])) {
            /*$this->renderView('layout/auth/login', [
                'chyba' => 'Pro přístup na tuto stránku se musíte přihlásit'
            ]);*/
            header('Location: /login');
            exit; 
        }
    }
}