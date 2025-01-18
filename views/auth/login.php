<?php require_once '../views/layouts/header.php'; ?>

<h2>Login</h2>

<?php if (!empty($error)): ?>
    <p class="error"><?= $error ?></p>
<?php endif; ?>

<form action="?controller=auth&action=login" method="POST" class="form-container">
    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required>

    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" placeholder="Digite sua senha" required>

    <button type="submit" class="btn-primary">Entrar</button>
</form>

<?php require_once '../views/layouts/footer.php'; ?>