<?php
// Comprueba si existe el parámetro y si esta en uno de los valores válidos para guardar el valor en la sesión. Si no, se asigna 'es' por defecto.
if (isset($_GET['lang']) && in_array($_GET['lang'], ['es','en','eu'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
// Establece la variable $lang con el idioma guardado en la sesión.
$lang = $_SESSION['lang'] ?? 'es';
// Incluye el archivo de traducciones y selecciona solo las traducciones correspondientes al idioma actual.
$translationsAll = include __DIR__ . '/../lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];
// Establece la variable $currentPage con el nombre del archivo PHP actual. Marca la página actual.
$currentPage = basename($_SERVER['PHP_SELF']);
// Comprueba si el usuario ha iniciado sesión.
$logged_in = isset($_COOKIE['usuario']);
?>

<!-- HEADER -->
<header class="main-header">
    <div class="logo">
        <a href="index.php"><img src="img/logo.png" alt="Hidrogena"></a>
    </div>

    <nav class="nav" id="nav-menu">
        <!-- Short Echo Tag en PHP, necesita al menos PHP 5.4+ -->
        <a href="index.php" <?php if ($currentPage === 'index.php') echo 'class="active"'; ?>><?= htmlspecialchars($translations['inicio']) ?></a>
        <a href="index.php#servicios"><?= htmlspecialchars($translations['servicios']) ?></a>
        <a href="index.php#control"><?= htmlspecialchars($translations['centro_control']) ?></a>
        <a href="index.php#pedidos"><?= htmlspecialchars($translations['pedidos']) ?></a>
    </nav>

    <div class="header-right">
        <div class="lang-selector">
            <a href="?lang=es" <?php if ($lang === 'es') echo 'class="active-lang"'; ?>>ES</a> |
            <a href="?lang=en" <?php if ($lang === 'en') echo 'class="active-lang"'; ?>>EN</a> |
            <a href="?lang=eu" <?php if ($lang === 'eu') echo 'class="active-lang"'; ?>>EU</a>
        </div>

        <!-- Si esta logueado lleva al dashboard sino al login -->
        <a href="<?= $logged_in ? 'dashboard.php' : 'login.php' ?>" class="login-icon">
            <i class="fas fa-user fa-lg"></i>
        </a>

        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>