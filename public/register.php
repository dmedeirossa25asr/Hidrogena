<?php
session_start();
require_once __DIR__ . '/app/auth.php';

$lang = $_SESSION['lang'] ?? 'es';
$translationsAll = include __DIR__ . '/lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');
    $contrasena2 = trim($_POST['contrasena2'] ?? '');

    // Validaciones
    if ($usuario === '' || $contrasena === '' || $contrasena2 === '') {
        $error = "Por favor completa todos los campos.";
    } elseif ($contrasena !== $contrasena2) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Verificar si el usuario ya existe
        global $conn;
        $sql_check = "SELECT idUsuario FROM usuarios WHERE usuario = :usuario";
        $stmt_check = oci_parse($conn, $sql_check);
        oci_bind_by_name($stmt_check, ':usuario', $usuario);
        oci_execute($stmt_check);

        if (oci_fetch_assoc($stmt_check)) {
            $error = "El usuario ya existe.";
        } else {
            if (register_user($usuario, $contrasena)) {
                $success = "Registro exitoso. Ya puedes iniciar sesión.";
            } else {
                $error = "Hubo un error al registrar el usuario.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title>Registro | <?= $translations['hidrogeno_verde'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/app/header.php'; ?>

<main class="login-page">
    <div class="login-form">
        <h2>Registrarse</h2>

        <?php if ($error): ?>
            <p class="error"><?= $error ?></p>
        <?php elseif ($success): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="usuario" placeholder="<?= htmlspecialchars($translations['usuario']) ?>" required>
            <input type="password" name="contrasena" placeholder="<?= htmlspecialchars($translations['contrasena']) ?>" required>
            <input type="password" name="contrasena2" placeholder="<?= htmlspecialchars($translations['repetir_contrasena']) ?>" required>
            <button type="submit"><?= htmlspecialchars($translations['registro']) ?></button>
        </form>

        <p class="register-link">
            <?= htmlspecialchars($translations['ya_cuenta']) ?> 
            <a href="login.php"><?= htmlspecialchars($translations['iniciar_sesion']) ?></a>
        </p>
    </div>
</main>

<?php include __DIR__ . '/app/footer.php'; ?>

</body>
</html>