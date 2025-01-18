<?php require_once '../views/layouts/header.php'; ?>

<h2>Lista de Solicitações</h2>

<!-- Botões de Exportação -->
<a href="?controller=request&action=exportCSV" class="btn btn-primary">Exportar CSV</a>
<a href="?controller=request&action=exportPDF" class="btn btn-secondary">Exportar PDF</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Produto</th>
        <th>Usuário</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($requests as $request): ?>
        <tr>
            <td><?= $request['id'] ?></td>
            <td><?= $request['product_name'] ?></td>
            <td><?= $request['user_name'] ?></td>
            <td><?= ucfirst($request['status']) ?></td>
            <td><?= $request['created_at'] ?></td>
            <td>
                <a href="?controller=request&action=accept&id=<?= $request['id'] ?>">Aceitar</a>
                <a href="?controller=request&action=reject&id=<?= $request['id'] ?>">Rejeitar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php require_once '../views/layouts/footer.php'; ?>
