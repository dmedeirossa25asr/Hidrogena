<?php
if (!isset($_SESSION)) session_start();
?>
<header class="main-header">
    <div class="logo">
        <a href="dashboard.php"><img src="Images/Logo.png" alt="Hidrogena Logo"></a>
    </div>

    <nav class="main-nav">
        <ul>
            <li><a href="dashboard.php">Inicio</a></li>
            <li><a href="#">Servicios</a></li>
            <li><a href="#">Proyectos</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </nav>

    <div class="user-nav">
        <?php if(isset($_SESSION['usuario'])): ?>
            <span>Bienvenido, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong></span>
            <a href="logout.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="index.php">Login</a>
        <?php endif; ?>
    </div>

    <button class="nav-toggle" aria-label="Abrir menú">
        ☰
    </button>
</header>