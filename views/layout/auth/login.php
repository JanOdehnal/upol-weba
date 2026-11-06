<section>
    <h2>Login</h2>
    <form class="row g-3" method="POST" action="/login">
        <?php if (!empty($chyba)): ?>
            <div class="col-12 alert alert-danger" role="alert">
                <?= htmlspecialchars($chyba, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>
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