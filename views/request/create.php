<?php require_once '../layouts/header.php'; ?>

<h1>Solicitar Produto ou Serviço</h1>
<form action="?controller=request&action=create" method="POST">
    <label for="product_id">Produto/Serviço:</label>
    <select name="product_id" required>
        <?php foreach ($products as $product): ?>
        <option value="<?= $product['id'] ?>"><?= $product['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn">Solicitar</button>
</form>

<?php require_once '../layouts/footer.php' ?>
