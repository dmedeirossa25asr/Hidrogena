<?php
session_start();
$translationsAll = include __DIR__ . '/lang/lang.php';
$lang = $_SESSION['lang'] ?? 'es';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title>Hidrogena | <?= $translations['hidrogeno_verde'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/../app/header.php'; ?>

<main>
    <!-- HERO -->
    <section class="hero">
        <div class="hero-images">
            <img src="img/img1.jpg" alt="<?= $translations['servicio_1'] ?>">
            <img src="img/img2.jpg" alt="<?= $translations['servicio_2'] ?>">
            <img src="img/img3.jpg" alt="<?= $translations['servicio_3'] ?>">
        </div>
    </section>

    <!-- PROYECTO -->
    <section class="content">
        <h2><?= $translations['proyecto_titulo'] ?></h2>
        <p><?= $translations['proyecto_desc'] ?></p>
        <p><?= $translations['proyecto_detalle'] ?></p>
        <p><?= $translations['proyecto_extra'] ?></p>
    </section>

    <!-- SERVICIOS -->
    <section id="servicios" class="content">
        <h2><?= $translations['servicios'] ?></h2>
        <div class="cards">
            <div class="card"><?= $translations['servicio_1'] ?></div>
            <div class="card"><?= $translations['servicio_2'] ?></div>
            <div class="card"><?= $translations['servicio_3'] ?></div>
            <div class="card"><?= $translations['servicio_4'] ?></div>
        </div>
    </section>

    <!-- CENTRO DE CONTROL -->
    <section id="control" class="content">
        <h2><?= $translations['centro_control'] ?></h2>
        <p><?= $translations['control_desc'] ?></p>
        <p><?= $translations['control_seguridad'] ?></p>
        <p><?= $translations['control_informes'] ?></p>
    </section>

    <!-- PEDIDOS -->
    <section id="pedidos" class="content">
        <h2><?= $translations['pedidos'] ?></h2>
        <p><?= $translations['pedido_desc'] ?></p>
        <form class="form" action="pedido_submit.php" method="POST">
            <input type="text" name="empresa" placeholder="<?= $translations['empresa'] ?>" required>
            <input type="email" name="email" placeholder="<?= $translations['email'] ?>" required>
            <input type="number" name="cantidad" placeholder="<?= $translations['cantidad'] ?>" required>
            <textarea name="comentarios" placeholder="<?= $translations['comentarios'] ?>"></textarea>
            <button class="btn"><?= $translations['enviar'] ?></button>
        </form>
    </section>
</main>

<?php include __DIR__ . '/../app/footer.php'; ?>

<!-- JS -->
<script src="js/main.js"></script>

</body>
</html>