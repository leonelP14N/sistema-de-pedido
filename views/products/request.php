<?php require_once '../views/layouts/header.php'; ?>

<h2>Solicitar Produto</h2>
<form method="POST" action="?controller=request&action=create">
    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
    <p>Você está solicitando o produto: <strong><?= $product['name'] ?></strong></p>
    <button type="submit">Confirmar Solicitação</button>
</form>

<?php require_once '../views/layouts/footer.php'; ?>