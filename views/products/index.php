<?php require_once '../views/layouts/header.php'; ?>

<h1>Produtos e Serviços</h1>
<a href="?controller=product&action=create" class="btn">Adicionar Produto</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['name'] ?></td>
            <td><?= $product['description'] ?></td>
            <td><?= $product['price'] ?></td>
            <td>
                <a href="?controller=product&action=edit&id=<?= $product['id'] ?>" class="btn btn-primary">Editar</a>
                <a href="?controller=product&action=delete&id=<?= $product['id'] ?>" class="btn btn-danger">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once '../views/layouts/footer.php'; ?>
