<?php
session_start();
if (isset($_GET['lang']) && in_array($_GET['lang'], ['es','en','eu'])) {
    $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'es';
$translationsAll = include __DIR__ . '/../public/lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<header class="main-header">
    <div class="logo">
        <a href="index.php"><img src="img/logo.png" alt="Hidrógena"></a>
    </div>

    <nav class="nav" id="nav-menu">
        <a href="index.php" class="<?= ($currentPage=='index.php')?'active':'' ?>"><?= $translations['inicio'] ?></a>
        <a href="index.php#servicios"><?= $translations['servicios'] ?></a>
        <a href="index.php#control"><?= $translations['centro_control'] ?></a>
        <a href="index.php#pedidos"><?= $translations['pedidos'] ?></a>
    </nav>

    <div class="header-right">
        <div class="lang-selector">
            <a href="?lang=es" <?= $lang=='es'?'class="active-lang"':'' ?>>ES</a> |
            <a href="?lang=en" <?= $lang=='en'?'class="active-lang"':'' ?>>EN</a> |
            <a href="?lang=eu" <?= $lang=='eu'?'class="active-lang"':'' ?>>EU</a>
        </div>

        <a href="login.php" class="login-icon">
            <i class="fas fa-user fa-lg"></i>
        </a>

        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</header>