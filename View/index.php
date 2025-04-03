<?php
require_once __DIR__ . '/../config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração</title>
    <link rel="stylesheet" href="/siteadm/View/assets/css/style.css">
    <link rel="stylesheet" href="/siteadm/View/assets/css/components/sidebar.css">
    <link rel="stylesheet" href="/siteadm/View/assets/css/components/navbar.css">
    <link rel="stylesheet" href="/siteadm/View/assets/css/components/footer.css">
</head>
<body>
    <?php include __DIR__ . '/components/navbar.php'; ?>
    <div class="container">
        <?php include __DIR__ . '/components/sidebar.php'; ?>
        <div class="content">
            <h1>Bem-vindo ao Painel de Administração</h1>
            <p>Escolha uma opção no menu.</p>
        </div>
    </div>
    <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
