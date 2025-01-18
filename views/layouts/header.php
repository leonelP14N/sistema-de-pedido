<?php
// Verifique a sessão para determinar o nível de acesso
session_start();
$userRole = $_SESSION['user_role'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Completo</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a href="?controller=request&action=index" class="nav-link">Solicitações</a>
        <a href="?controller=request&action=statistics" class="nav-link">Estatísticas</a>
        <a href="?controller=request&action=detailedReport" class="nav-link">Relatórios</a>
        
        <?php if ($userRole === 'admin' || $userRole === 'edit'): ?>
            <a href="?controller=product&action=index" class="nav-link">Produtos</a>
            <a href="?controller=user&action=index" class="nav-link">Usuários</a>
        <?php endif; ?>
        
        <a href="?controller=auth&action=logout" class="nav-link logout">Sair</a>
    </div>
</nav>

<header class="header">
    <div class="container">
        <h1>Bem-vindo ao Sistema</h1>
        <p>Gerencie suas solicitações, produtos, usuários e relatórios de forma eficiente.</p>
        <p>Você está conectado como: <strong><?= ucfirst($userRole) ?></strong></p>
    </div>
</header>

<main class="content">
    <div class="container">
        <!-- Conteúdo dinâmico renderizado aqui -->
    </div>
</main>
