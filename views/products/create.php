<?php require_once '../views/layouts/header.php'; ?>

<h2>Adicionar Produto</h2>
<form method="POST" action="?controller=product&action=create">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="description">Descrição:</label>
    <textarea name="description" id="description"></textarea>
    <br>
    <label for="price">Preço:</label>
    <input type="number" name="price" id="price" step="0.01" required>
    <br>
    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="available">Disponível</option>
        <option value="unavailable">Indisponível</option>
    </select>
    <br>
    <button type="submit">Cadastrar</button>
</form>

<?php require_once '../views/layouts/footer.php'; ?>
