<?php require_once '../views/layouts/header.php'; ?>

<h2>Cadastro</h2>
<form action="?controller=auth&action=register" method="POST" class="form-container">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" placeholder="Digite seu nome" required>

    <label for="email">E-mail:</label>
    <input type="email" name="email" id="email" placeholder="Digite seu e-mail" required>

    <label for="password">Senha:</label>
    <input type="password" name="password" id="password" placeholder="Digite sua senha" required>

    <button type="submit" class="btn-primary">Cadastrar</button>
</form>

<?php require_once '../views/layouts/footer.php'; ?>