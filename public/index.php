<?php
session_start();
require_once __DIR__ . '/../app/auth.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hidrógena | Hidrógeno Verde</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<?php include __DIR__ . '/../app/header.php'; ?>

<main>
    <!-- HERO -->
    <section class="hero">
        <div class="hero-images">
            <img src="img/img1.jpg" alt="Producción Hidrógeno">
            <img src="img/img2.jpg" alt="Almacenamiento Hidrógeno">
            <img src="img/img3.jpg" alt="Distribución Hidrógeno">
        </div>
    </section>

    <!-- SOBRE EL PROYECTO -->
    <section class="content">
        <h2>Proyecto de Hidrógeno Verde</h2>
        <p>
            El Gobierno Vasco ha lanzado un proyecto piloto de innovación energética centrado en la 
            <strong>producción, almacenamiento y distribución de hidrógeno verde</strong>. 
            Esta iniciativa busca acelerar la transición hacia un modelo energético sostenible, reduciendo emisiones y fomentando la economía circular.
        </p>
        <p>
            La hidrogenera combina <strong>placas solares fotovoltaicas de alta eficiencia</strong> con 
            <strong>aerogeneradores de última generación</strong>, asegurando una producción constante de hidrógeno renovable durante todo el año. 
            Un <strong>sistema de monitorización inteligente en tiempo real</strong> permite supervisar la producción, almacenamiento y distribución, garantizando eficiencia y seguridad.
        </p>
        <p>
            Además, se integran <strong>mecanismos de predicción de demanda</strong> y algoritmos de optimización energética que ajustan la producción según las necesidades de la red y la capacidad de almacenamiento, asegurando suministro estable y confiable.
        </p>
    </section>

    <!-- SERVICIOS -->
    <section id="servicios" class="content">
        <h2>Servicios</h2>
        <div class="cards">
            <div class="card">
                <strong>Producción sostenible:</strong> Hidrógeno 100% renovable, reduciendo la huella de carbono.
            </div>
            <div class="card">
                <strong>Almacenamiento inteligente:</strong> Monitoreo de presión y capacidad en tiempo real, asegurando seguridad.
            </div>
            <div class="card">
                <strong>Distribución segura:</strong> Transporte y entrega trazable a empresas colaboradoras.
            </div>
            <div class="card">
                <strong>Optimización energética:</strong> Algoritmos que ajustan la producción según demanda.
            </div>
        </div>
    </section>

    <!-- CENTRO DE CONTROL -->
    <section id="control" class="content">
        <h2>Centro de Control</h2>
        <p>
            Nuestro centro de control realiza una <strong>supervisión integral de producción y distribución</strong>. 
            Los sistemas generan <strong>alertas automáticas</strong> ante desviaciones críticas, permitiendo respuesta inmediata.
        </p>
        <p>
            La comunicación entre las hidrogeneras y la central se realiza mediante <strong>VPN segura y encriptada</strong>, protegiendo los datos frente a ciberataques y asegurando la integridad de la información.
        </p>
        <p>
            También se generan informes diarios y estadísticos para análisis de eficiencia, trazabilidad y proyecciones de demanda, apoyando la toma de decisiones estratégicas.
        </p>
    </section>

    <!-- PEDIDOS -->
    <section id="pedidos" class="content">
        <h2>Solicitud de Pedidos</h2>
        <p>
            Las empresas interesadas pueden realizar pedidos de hidrógeno verde directamente en nuestra plataforma, asegurando un 
            <strong>proceso ágil, seguro y trazable</strong>.
        </p>
        <form class="form" action="pedido_submit.php" method="POST">
            <input type="text" name="empresa" placeholder="Nombre de la empresa" required>
            <input type="email" name="email" placeholder="Correo electrónico de contacto" required>
            <input type="number" name="cantidad" placeholder="Cantidad de hidrógeno (kg)" required>
            <textarea name="comentarios" placeholder="Comentarios u observaciones adicionales"></textarea>
            <button class="btn">Enviar pedido</button>
        </form>
    </section>
</main>

<?php include __DIR__ . '/../app/footer.php'; ?>

<!-- JS -->
<script src="js/main.js"></script>

</body>
</html>
