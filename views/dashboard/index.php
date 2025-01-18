<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1><?= $title; ?></h1>
    </header>
    <nav>
        <a href="?controller=home&action=index">Início</a>
        <a href="?controller=request&action=index">Solicitações</a>
        <a href="?controller=auth&action=logout">Sair</a>
    </nav>
    <main>
        <section>
            <h2>Estatísticas</h2>
            <ul>
                <li>Solicitações Pendentes: <?= $pendingCount; ?></li>
                <li>Solicitações Aceitas: <?= $acceptedCount; ?></li>
                <li>Solicitações Rejeitadas: <?= $rejectedCount; ?></li>
            </ul>
        </section>
    </main>
</body>
</html>
