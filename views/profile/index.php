<?php require_once '../views/layouts/header.php'; ?>

<h1>Meu Perfil</h1>
<p><strong>Nome:</strong> <?= $user['name'] ?></p>
<p><strong>Email:</strong> <?= $user['email'] ?></p>
<p><strong>Data de Cadastro:</strong> <?= $user['created_at'] ?></p>
<a href="?controller=profile&action=edit" class="btn">Alterar Perfil</a>


<?php require_once '../views/layouts/footer.php'; ?>