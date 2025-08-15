<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <h1>Iniciar sesión</h1>
    <?php if (isset($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        <label>Usuario: <input type="text" name="username"></label><br>
        <label>Contraseña: <input type="password" name="password"></label><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
