<?php require_once '../views/layouts/header.php'; ?>

<h1>Gestão de Usuários</h1>
<a href="?controller=user&action=create" class="btn">Adicionar Usuário</a>
<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Nível de Acesso</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= ucfirst($user['role']) ?></td>
            <td><?= ucfirst($user['status']) ?></td>
            <td>
                <?php if ($user['status'] === 'inactive'): ?>
                    <a href="?controller=user&action=activate&id=<?= $user['id'] ?>" class="btn btn-success">Ativar</a>
                <?php else: ?>
                    <a href="?controller=user&action=deactivate&id=<?= $user['id'] ?>" class="btn btn-warning">Desativar</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php require_once '../views/layouts/footer.php'; ?>