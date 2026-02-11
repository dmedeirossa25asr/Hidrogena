<?php
session_start();
require_once __DIR__ . '/app/auth.php';
require_once __DIR__ . '/config/database.php';

// Solo Admin puede acceder
check_login();
if ($_SESSION['tipo'] !== 'Admin') {
    header('Location: /index.php');
    exit;
}

$lang = $_SESSION['lang'] ?? 'es';
$translationsAll = include __DIR__ . '/lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];

$mensaje = '';

// CREAR USUARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario'], $_POST['contrasena'], $_POST['tipo'])) {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);
    $tipo = trim($_POST['tipo']);

    // Validación básica
    if ($usuario === '' || $contrasena === '' || $tipo === '') {
        $mensaje = $translations['rellenar_campos'] ?? "Por favor, rellena todos los campos.";
    } else {
        // Verificar que el usuario no exista
        $sql_check = "SELECT COUNT(*) AS CNT FROM usuarios WHERE usuario = :usuario";
        $stmt_check = oci_parse($conn, $sql_check);
        oci_bind_by_name($stmt_check, ':usuario', $usuario);
        oci_execute($stmt_check);
        $row_check = oci_fetch_assoc($stmt_check);

        if ($row_check['CNT'] > 0) {
            $mensaje = $translations['usuario_existente'] ?? "El usuario ya existe.";
        } else {
            // Insertar nuevo usuario
            $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

            // Obtener un nuevo ID (Oracle sequence recomendada; si no, max+1)
            $sql_id = "SELECT NVL(MAX(idUsuario),0)+1 AS NEW_ID FROM usuarios";
            $stmt_id = oci_parse($conn, $sql_id);
            oci_execute($stmt_id);
            $row_id = oci_fetch_assoc($stmt_id);
            $new_id = $row_id['NEW_ID'];

            $sql_insert = "INSERT INTO usuarios (idUsuario, usuario, contrasena, tipo)
                           VALUES (:id, :usuario, :contrasena, :tipo)";
            $stmt_insert = oci_parse($conn, $sql_insert);
            oci_bind_by_name($stmt_insert, ':id', $new_id);
            oci_bind_by_name($stmt_insert, ':usuario', $usuario);
            oci_bind_by_name($stmt_insert, ':contrasena', $hashed_password);
            oci_bind_by_name($stmt_insert, ':tipo', $tipo);

            $result = @oci_execute($stmt_insert, OCI_COMMIT_ON_SUCCESS);
            if ($result) {
                $mensaje = $translations['usuario_creado'] ?? "Usuario creado correctamente.";
            } else {
                $mensaje = $translations['error_crear'] ?? "Error al crear el usuario.";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $translations['crear_usuario'] ?? 'Crear usuario' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<?php include __DIR__ . '/app/header.php'; ?>

<main class="login-page">
    <form class="login-form" method="POST">
        <h2 style="text-align:center; color:#0ea5e9; margin-bottom:20px;">
            <?= $translations['crear_usuario'] ?? 'Crear Usuario' ?>
        </h2>

        <?php if ($mensaje): ?>
            <p class="success"><?= htmlspecialchars($mensaje) ?></p>
        <?php endif; ?>

        <label for="usuario"><?= $translations['usuario'] ?? 'Usuario' ?></label>
        <input type="text" id="usuario" name="usuario" placeholder="Introduce el nombre de usuario" required>

        <label for="contrasena"><?= $translations['contrasena'] ?? 'Contraseña' ?></label>
        <input type="password" id="contrasena" name="contrasena" placeholder="Introduce la contraseña" required>

        <label for="tipo"><?= $translations['tipo'] ?? 'Tipo' ?></label>
        <select id="tipo" name="tipo" required>
            <option value="" disabled selected>Selecciona el tipo</option>
            <option value="Admin">Admin</option>
            <option value="Logistica">Logistica</option>
            <option value="Finanzas">Finanzas</option>
            <option value="Proveedor">Proveedor</option>
            <option value="Cliente">Cliente</option>
        </select>

        <button type="submit"><?= $translations['crear'] ?? 'Crear' ?></button>
    </form>
</main>

<?php include __DIR__ . '/app/footer.php'; ?>
</body>
</html>