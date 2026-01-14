<?php
if (!isset($_SESSION)) session_start();
?>
<header class="main-header">
    <div class="logo">
        <img src="/images/Logo.png" alt="Hidrogena Logo" height="50">
    </div>
    <?php if(isset($_SESSION['usuario'])): ?>
        <nav>
            <span>Bienvenido, <?= $_SESSION['usuario'] ?></span>
            <a href="/Hidrogena/logout.php">Cerrar sesión</a>
        </nav>
    <?php endif; ?>
</header>