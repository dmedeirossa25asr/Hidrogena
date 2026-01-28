<?php
session_start();
require_once __DIR__ . '/../../app/auth.php';
require_once __DIR__ . '/../../config/database.php';

// Solo Admin puede acceder
check_login();
if ($_SESSION['tipo'] !== 'Admin') {
    header('Location: /Hidrogena/public/index.php');
    exit;
}

$lang = $_SESSION['lang'] ?? 'es';
$translationsAll = include __DIR__ . '/../../public/lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];

$mensaje = '';

// ELIMINAR USUARIO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);

    $sql = "DELETE FROM usuarios WHERE idUsuario = :id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':id', $delete_id);
    $result = @oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);

    if ($result) {
        $mensaje = $translations['usuario_eliminado'] ?? "Usuario eliminado correctamente";
    } else {
        $mensaje = $translations['error_eliminar'] ?? "Error al eliminar el usuario";
    }
}

// OBTENER TODOS LOS USUARIOS
$sql_all = "SELECT idUsuario, usuario, tipo FROM usuarios ORDER BY idUsuario";
$stmt_all = oci_parse($conn, $sql_all);
oci_execute($stmt_all);

$usuarios = [];
while ($row = oci_fetch_assoc($stmt_all)) {
    $usuarios[] = $row;
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title><?= $translations['eliminar_usuarios'] ?? 'Eliminar usuarios' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="/Hidrogena/public/css/general.css">
    <link rel="stylesheet" href="/Hidrogena/public/css/responsive.css">
    <link rel="stylesheet" href="/Hidrogena/public/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/../../app/header.php'; ?>

<main class="content">
    <h2 class="page-title"><?= $translations['eliminar_usuarios'] ?? 'Eliminar usuarios' ?></h2>

    <?php if ($mensaje): ?>
        <p class="success"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th><?= $translations['id'] ?? 'ID' ?></th>
                    <th><?= $translations['usuario'] ?? 'Usuario' ?></th>
                    <th><?= $translations['tipo'] ?? 'Tipo' ?></th>
                    <th><?= $translations['acciones'] ?? 'Acciones' ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['IDUSUARIO']) ?></td>
                    <td><?= htmlspecialchars($usuario['USUARIO']) ?></td>
                    <td><?= htmlspecialchars($usuario['TIPO']) ?></td>
                    <td>
                        <form method="POST" onsubmit="return confirm('<?= $translations['confirm_delete'] ?? '¿Estás seguro de eliminar este usuario?' ?>')">
                            <input type="hidden" name="delete_id" value="<?= $usuario['IDUSUARIO'] ?>">
                            <button type="submit" class="btn-delete"><?= $translations['eliminar'] ?? 'Eliminar' ?></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($usuarios)): ?>
                <tr>
                    <td colspan="4" style="text-align:center; padding:20px;">No hay usuarios registrados.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include __DIR__ . '/../../app/footer.php'; ?>
</body>
</html>