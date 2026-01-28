<?php
session_start();

$lang = 'es';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['es','en','eu'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
} elseif (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
}

$allTranslations = include __DIR__ . '/../public/lang/lang.php';
$translations = $allTranslations[$lang];
?>

<header class="main-header">
  <div class="logo">
    <a href="index.php">
      <img src="img/logo.png" alt="Hidrógena">
    </a>
  </div>

  <nav class="nav" id="nav-menu">
    <a href="index.php"><?= $translations['inicio'] ?></a>
    <a href="#servicios"><?= $translations['servicios'] ?></a>
    <a href="#control"><?= $translations['control'] ?></a>
    <a href="#pedidos"><?= $translations['pedidos'] ?></a>
  </nav>

  <div class="header-right">
    <div class="lang-selector">
      <a href="?lang=es">ES</a> |
      <a href="?lang=en">EN</a> |
      <a href="?lang=eu">EU</a>
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

<!--
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="css/responsive.css">
<script src="js/main.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">-->