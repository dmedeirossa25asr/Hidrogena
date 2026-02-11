<?php
session_start();
require_once __DIR__ . '/app/auth.php';
require_once __DIR__ . '/config/database.php';

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
        $sql_check = "SELECT idUsuario FROM usuarios WHERE usuario = :usuario";
        $stmt_check = oci_parse($conn, $sql_check);
        oci_bind_by_name($stmt_check, ':usuario', $usuario);
        oci_execute($stmt_check);

        if (oci_fetch_assoc($stmt_check)) {
            $error = "El usuario ya existe.";
        } else {
            $sql_id = "SELECT NVL(MAX(idUsuario),0)+1 AS NEW_ID FROM usuarios";
            $stmt_id = oci_parse($conn, $sql_id);
            oci_execute($stmt_id);
            $row_id = oci_fetch_assoc($stmt_id);
            $new_id = $row_id['NEW_ID'];

            // Insertar usuario
            $sql_insert = "INSERT INTO usuarios (idUsuario, usuario, contrasena, tipo)
                           VALUES (:id, :usuario, :contrasena, 'Cliente')";
            $stmt_insert = oci_parse($conn, $sql_insert);
            oci_bind_by_name($stmt_insert, ':id', $new_id);
            oci_bind_by_name($stmt_insert, ':usuario', $usuario);
            oci_bind_by_name($stmt_insert, ':contrasena', $contrasena);

            $result = @oci_execute($stmt_insert, OCI_COMMIT_ON_SUCCESS);
            if ($result) {
                $success = "Registro exitoso. Ya puedes iniciar sesión.";
            } else {
                $e = oci_error($stmt_insert);
                $error = "Hubo un error al registrar el usuario: " . ($e['message'] ?? "desconocido");
            }

            oci_free_statement($stmt_insert);
            oci_free_statement($stmt_id);
        }

        oci_free_statement($stmt_check);
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
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php elseif ($success): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
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