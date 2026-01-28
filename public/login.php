<?php
session_start();
require_once __DIR__ . '/../app/auth.php';

$lang = $_SESSION['lang'] ?? 'es';
$translationsAll = include __DIR__ . '/lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (login($usuario, $contrasena)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = $translations['login_error'];
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $translations['login_title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="/Hidrogena/public/css/styles.css">
    <link rel="stylesheet" href="/Hidrogena/public/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* Ajuste para que el contenido no quede debajo del header fijo */
        main { margin-top: 160px; display: flex; justify-content: center; }
        .login-form { width: 100%; max-width: 400px; padding: 20px; border: 1px solid #d1d5db; border-radius: 12px; box-shadow: 0 8px 20px rgba(0,0,0,0.1); background: #fff; }
        .login-form input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #d1d5db; border-radius: 8px; }
        .login-form button { width: 100%; padding: 12px; margin-top: 15px; background: #0ea5e9; color: #fff; border-radius: 8px; border: none; cursor: pointer; }
        .login-form button:hover { background: #0284c7; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>

<?php include __DIR__ . '/../app/header.php'; ?>

<main class="login-page">
    <div class="login-form">
        <h2><?= $translations['login_title'] ?></h2>
        <?php if ($error) : ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="usuario" placeholder="<?= $translations['usuario'] ?>" required>
            <input type="password" name="contrasena" placeholder="<?= $translations['contrasena'] ?>" required>
            <button type="submit"><?= $translations['ingresar'] ?></button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/../app/footer.php'; ?>
</body>
</html>
