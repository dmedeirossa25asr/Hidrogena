<?php
require_once __DIR__ . '/../app/auth.php';
check_login(); // Verifica si el usuario está logueado
include __DIR__ . '/../app/header.php';
?>

<h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['tipo']); ?></h1>

<?php if ($_SESSION['tipo'] === 'Admin'): ?>
    <p>Opciones de administración:</p>
    <ul>
        <li><a href="#">Crear usuarios</a></li>
        <li><a href="#">Eliminar usuarios</a></li>
        <li><a href="#">Gestionar Base de Datos</a></li>
    </ul>
<?php else: ?>
    <p>Panel de usuario:</p>
    <ul>
        <li><a href="#">Ver pedidos</a></li>
        <li><a href="#">Ver clientes</a></li>
        <li><a href="#">Reportes</a></li>
    </ul>
<?php endif; ?>

<a href="logout.php">Cerrar sesión</a>

<?php include __DIR__ . '/../app/footer.php'; 
?>