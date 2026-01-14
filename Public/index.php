<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/app/auth.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Hidrogena</title>
    <link rel="stylesheet" href="Styles/header.css">
    <link rel="stylesheet" href="Styles/body.css">
    <link rel="stylesheet" href="Styles/footer.css">
</head>
<body>
<?php include __DIR__ . '/app/header.php'; ?>

<main class="login-main">
    <h2>Iniciar Sesión</h2>
    <?php if(!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
    </form>
</main>

<?php include __DIR__ . '/app/footer.php'; ?>
</body>
</html>