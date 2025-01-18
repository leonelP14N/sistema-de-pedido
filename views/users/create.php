<?php require_once '../views/layouts/header.php'; ?>

<h1>Cadastrar Usuário</h1>
<form action="?controller=user&action=create" method="POST">
    <label for="name">Nome:</label>
    <input type="text" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    
    <label for="password">Senha:</label>
    <input type="password" name="password" required>
    
    <label for="role">Nível de Acesso:</label>
    <select name="role">
        <option value="admin">Administrador</option>
        <option value="editor">Editor</option>
        <option value="viewer">Visualizador</option>
    </select>
    
    <button type="submit" class="btn">Cadastrar</button>
</form>

<?php require_once '../views/layouts/footer.php'; ?>