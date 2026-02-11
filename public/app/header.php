<?php
if (isset($_GET['lang']) && in_array($_GET['lang'], ['es','en','eu'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';
$translationsAll = include __DIR__ . '/../lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];
$currentPage = basename($_SERVER['PHP_SELF']);

$logged_in = isset($_COOKIE['usuario']);
?>

<header class="main-header">
    <div class="logo">
        <a href="index.php"><img src="img/logo.png" alt="Hidrogena"></a>
    </div>

    <nav class="nav" id="nav-menu">
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