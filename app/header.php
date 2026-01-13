<?php
if (!isset($_SESSION)) session_start();
?>
<header class="main-header">
    <div class="logo">
        <img src="/images/logo.png" alt="Hidrogena Logo" height="50">
    </div>
    <?php if(isset($_SESSION['usuario'])): ?>
        <nav>
            <span>Bienvenido, <?= $_SESSION['usuario'] ?></span>
            <a href="/public/logout.php">Cerrar sesión</a>
        </nav>
    <?php endif; ?>
</header>