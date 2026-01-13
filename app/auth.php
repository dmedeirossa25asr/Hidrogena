<?php
session_start();
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND contrasena = :contrasena";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':usuario', $usuario);
    oci_bind_by_name($stmt, ':contrasena', $contrasena);
    oci_execute($stmt);

    if ($row = oci_fetch_assoc($stmt)) {
        $_SESSION['usuario'] = $row['USUARIO'];
        $_SESSION['tipo'] = $row['TIPO'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>