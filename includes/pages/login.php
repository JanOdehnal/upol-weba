<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $email;

    header("Location: /index.php?page=dashboard");
    exit;
}
?>

<section>
    <h2>Login</h2>
    <form class="row g-3" method="POST" action="/includes/pages/login.php">
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </form>
</section>