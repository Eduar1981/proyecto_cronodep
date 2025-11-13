<?php
$baseUrl = $GLOBALS['baseUrl'] ?? '';
$assetBase = $baseUrl === '/' ? '' : rtrim($baseUrl, '/');
$usuarioSesion = $_SESSION['usuario'] ?? null;
$rolSesion = $_SESSION['rol'] ?? null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Control Entrenamientos Deportivos') ?></title>
    <link rel="stylesheet" href="<?= htmlspecialchars($assetBase . '/public/css/styles.css') ?>">
</head>
<body>
<header class="app-header">
    <h1><?= htmlspecialchars($GLOBALS['appName'] ?? 'CronoDep') ?></h1>
    <nav>
        <a href="<?= htmlspecialchars(route('/')) ?>">Inicio</a>
        <?php if ($usuarioSesion): ?>
            <a href="<?= htmlspecialchars(route('/dashboard')) ?>">Panel</a>
            <?php if (in_array($rolSesion, ['superadmin', 'admin'], true)): ?>
                <a href="<?= htmlspecialchars(route('/usuarios')) ?>">Usuarios</a>
                <a href="<?= htmlspecialchars(route('/clubs')) ?>">Clubs</a>
            <?php endif; ?>
            <form action="<?= htmlspecialchars(route('/logout')) ?>" method="post" class="logout-form">
                <button type="submit">Cerrar sesión</button>
            </form>
        <?php else: ?>
            <a href="<?= htmlspecialchars(route('/login')) ?>">Ingresar</a>
        <?php endif; ?>
    </nav>
</header>
<main class="app-content">
    <?= $content ?? '' ?>
</main>
<script src="<?= htmlspecialchars($assetBase . '/public/js/app.js') ?>"></script>
</body>
</html>
