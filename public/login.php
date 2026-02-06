<?php
session_start();
require_once __DIR__ . '/app/auth.php';

$lang = $_SESSION['lang'] ?? 'es';
$translationsAll = include __DIR__ . '/lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    if (login($usuario, $contrasena)) {
        $_SESSION['usuario'] = $usuario;
        setcookie('usuario', $usuario, time() + 86400, "/");
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
    <link rel="stylesheet" href="/css/general.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>

<?php include __DIR__ . '/app/header.php'; ?>

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

        <p class="register-link">
            <?= htmlspecialchars($translations['no_cuenta']) ?> 
            <a href="register.php"><?= htmlspecialchars($translations['registrarse']) ?></a>
        </p>
    </div>
</main>

<?php include __DIR__ . '/app/footer.php'; ?>
</body>
</html>
