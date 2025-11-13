<?php
$baseUrl = $GLOBALS['baseUrl'] ?? '';
$assetBase = $baseUrl === '/' ? '' : rtrim($baseUrl, '/');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo ?? ($GLOBALS['appName'] ?? 'CronoDep')) ?></title>
    <link rel="stylesheet" href="<?= htmlspecialchars($assetBase . '/public/css/styles.css') ?>">
</head>
<body>
<header class="app-header">
    <h1><?= htmlspecialchars($GLOBALS['appName'] ?? 'CronoDep') ?></h1>
    <nav>
        <a href="<?= htmlspecialchars($baseUrl === '/' ? '/' : rtrim($baseUrl, '/')) ?>">Inicio</a>
        <a href="<?= htmlspecialchars($assetBase . '/usuarios') ?>">Usuarios</a>
        <a href="<?= htmlspecialchars($assetBase . '/clubs') ?>">Clubs</a>
    </nav>
</header>
<main class="app-content">
    <?php if (isset($contentFile)) { include $contentFile; } ?>
</main>
<script src="<?= htmlspecialchars($assetBase . '/public/js/app.js') ?>"></script>
</body>
</html>
