<?php require_once '../views/layouts/header.php'; ?>

<h2>Editar Produto</h2>
<form action="?controller=product&action=update&id=<?= $product['id'] ?>" method="POST">
    <label for="name">Nome do Produto:</label>
    <input type="text" name="name" id="name" value="<?= $product['name'] ?>" required>

    <label for="price">Preço:</label>
    <input type="number" step="0.01" name="price" id="price" value="<?= $product['price'] ?>" required>

    <label for="description">Descrição:</label>
    <textarea name="description" id="description"><?= $product['description'] ?></textarea>

    <button type="submit">Salvar Alterações</button>
</form>

<?php require_once '../views/layouts/footer.php'; ?>