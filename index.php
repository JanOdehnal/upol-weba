<?php
session_start();

//autoloader
spl_autoload_register(function ($nazevTridy) {
    if (file_exists(__DIR__ . '/controllers/' . $nazevTridy . '.php')) {
        require __DIR__ . '/controllers/' . $nazevTridy . '.php';
    } elseif (file_exists(__DIR__ . '/models/' . $nazevTridy . '.php')) {
        require __DIR__ . '/models/' . $nazevTridy . '.php';
    }
});


$dbConfig = require __DIR__ . '/config/db.php';
// 2. Vybudujeme DSN (Data Source Name) - řetězec, kterému PDO rozumí
$dsn = sprintf(
    "mysql:host=%s;dbname=%s;charset=%s",
    $dbConfig['host'],
    $dbConfig['dbname'],
    $dbConfig['charset']
);
// 3. Vytvoříme JEDNU centrální instanci PDO
try {
    $pdo = new PDO($dsn, $dbConfig['user'], $dbConfig['password'], [
        // Nastavíme, aby PDO při každé SQL chybě vyhodilo výjimku (Exception) - to nám usnadní ladění
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Zabráníme překvapením při fetch(), vždy dostaneme asociativní pole
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);  // presne nerozunin AI
} catch (PDOException $e) {
    // Pokud spadne databáze, nepustíme uživatele dál a nezobrazíme heslo
    die("Chyba databáze: " . $e->getMessage());
}




$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Router
switch ($url) {
    case '/':
    case '/index.php':
        $controller = new PageController($pdo);
        $page = $_GET['page'] ?? 'items';
        $controller->openPage('pages/' . $page, ['page' => $page]);
        break;

    case '/login':
        $controller = new AuthController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->checkLogin($pdo);
        } else {
            $controller->openLogin();
        }
        break;

    case '/logout':
        $controller = new AuthController($pdo);
        $controller->logout();
        break;

    case '/users':
        $controller = new UserController($pdo);
        $controller->allUsers();
        break;
    
    case '/users/delete':
        $controller = new UserController($pdo);
        $page = $_GET['id'] ?? '';
        $controller->deleteUser();
        break;
    
    case '/users/create':
        $controller = new UserController($pdo);
        $controller->createUser();
        break;
    
    case '/users/modify':
        $controller = new UserController($pdo);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $page = $_GET['id'] ?? '';
            $controller->modifyUser();
        } else {
            $controller->modifyPage();
        }
        break;
    case '/dashboard':
        $controller = new UserController($pdo);
        $controller->dashboard();
        break;

    default:
        $controller = new PageController($pdo);
        $controller->openPage('pages/not_found');
        break;
}

?>