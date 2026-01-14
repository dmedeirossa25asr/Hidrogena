<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Hidrogena</title>
    <link rel="stylesheet" href="/Styles/header.css">
    <link rel="stylesheet" href="/Styles/body.css">
    <link rel="stylesheet" href="/Styles/footer.css">
</head>
<body>
<?php include __DIR__ . '/app/header.php'; ?>

<main class="dashboard-main">
    <h2>Panel de control</h2>
    <p>Bienvenido a tu dashboard. Aquí podrás gestionar tus datos.</p>
</main>

<?php include __DIR__ . '/app/footer.php'; ?>
</body>
</html>