<?php
require_once __DIR__ . '/../app/auth.php';
check_login();

$lang = $_SESSION['lang'] ?? 'es';
$translationsAll = include __DIR__ . '/../public/lang/lang.php';
$translations = $translationsAll[$lang] ?? $translationsAll['es'];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Hidrogena</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="/Hidrogena/public/css/styles.css">
    <link rel="stylesheet" href="/Hidrogena/public/css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/../app/header.php'; ?>

<main>
    <section class="content-dashboard">
        <h1>Bienvenido, <?= htmlspecialchars($_SESSION['tipo']); ?></h1>

        <div class="cards">
            <?php if ($_SESSION['tipo'] === 'Admin'): ?>
                <div class="card">
                    <h3>Crear usuarios</h3>
                    <p>Agrega nuevos usuarios al sistema.</p>
                    <a href="#" class="btn">Ir</a>
                </div>
                <div class="card">
                    <h3>Eliminar usuarios</h3>
                    <p>Elimina usuarios existentes de forma segura.</p>
                    <a href="#" class="btn">Ir</a>
                </div>
                <div class="card">
                    <h3>Gestionar Base de Datos</h3>
                    <p>Accede y administra los datos de la plataforma.</p>
                    <a href="#" class="btn">Ir</a>
                </div>
            <?php else: ?>
                <div class="card">
                    <h3>Ver pedidos</h3>
                    <p>Consulta todos los pedidos realizados.</p>
                    <a href="#" class="btn">Ir</a>
                </div>
                <div class="card">
                    <h3>Ver clientes</h3>
                    <p>Revisa la lista de clientes registrados.</p>
                    <a href="#" class="btn">Ir</a>
                </div>
                <div class="card">
                    <h3>Reportes</h3>
                    <p>Genera reportes de actividad y ventas.</p>
                    <a href="#" class="btn">Ir</a>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <a href="logout.php" class="btn logout">Cerrar sesión</a>
        </div>
    </section>
</main>

<?php include __DIR__ . '/../app/footer.php'; ?>
</body>
</html>