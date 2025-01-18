<?php require_once '../layouts/header.php'; ?>

<h1>Alterar Perfil</h1>
<form action="?controller=profile&action=edit" method="POST">
    <label for="name">Nome:</label>
    <input type="text" name="name" value="<?= $user['name'] ?>" required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="<?= $user['email'] ?>" required>

    <button type="submit" class="btn">Salvar</button>
</form>

 <?php require_once '../layouts/footer.php'; ?>