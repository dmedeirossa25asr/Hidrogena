<?php
session_start();
require_once __DIR__ . '/../config/database.php'; // Conexión a Oracle

// Función para login
function login($usuario, $contrasena) {
    global $conn;
    $sql = "SELECT idUsuario, tipo FROM usuarios WHERE usuario = :usuario AND contrasena = :contrasena";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':usuario', $usuario);
    oci_bind_by_name($stmt, ':contrasena', $contrasena);
    oci_execute($stmt);

    $row = oci_fetch_assoc($stmt);
    if ($row) {
        $_SESSION['idUsuario'] = $row['IDUSUARIO'];
        $_SESSION['tipo'] = $row['TIPO'];
        return true;
    }
    return false;
}

// Verificar si el usuario está logueado
function check_login() {
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: index.php');
        exit;
    }
}

// Función para logout
function logout() {
    session_destroy();
    header('Location: index.php');
    exit;
}
?>