<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// LOGIN
function login($usuario, $contrasena) {
    global $conn;

    // Consulta parametrizada
    $sql = "SELECT idUsuario, tipo, contrasena FROM usuarios WHERE usuario = :usuario";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':usuario', $usuario);
    oci_execute($stmt);

    $row = oci_fetch_assoc($stmt);

    if ($row) {
        $stored = $row['CONTRASENA'];

        // Caso 1: contraseña hasheada
        if (password_verify($contrasena, $stored)) {
            $_SESSION['idUsuario'] = $row['IDUSUARIO'];
            $_SESSION['tipo'] = $row['TIPO'];
            return true;
        }

        // Caso 2: contraseña en texto plano
        if ($stored === $contrasena) {
            // Migramos automáticamente a hash
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);
            $update = "UPDATE usuarios SET contrasena = :hash WHERE idUsuario = :id";
            $stmt2 = oci_parse($conn, $update);
            oci_bind_by_name($stmt2, ':hash', $hash);
            oci_bind_by_name($stmt2, ':id', $row['IDUSUARIO']);
            oci_execute($stmt2, OCI_COMMIT_ON_SUCCESS);

            $_SESSION['idUsuario'] = $row['IDUSUARIO'];
            $_SESSION['tipo'] = $row['TIPO'];
            return true;
        }
    }

    return false;
}

// CHECK LOGIN
function check_login() {
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: index.php');
        exit;
    }
}

// LOGOUT
function logout() {
    $_SESSION = [];
    session_destroy();

    if (isset($_COOKIE['usuario'])) {
        setcookie('usuario', '', time() - 3600, "/");
    }

    header('Location: index.php');
    exit;
}

// REGISTRO
function register_user($usuario, $contrasena) {
    global $conn;
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $tipo = 'Cliente'; // Fijo

    $sql = "INSERT INTO usuarios (usuario, contrasena, tipo) VALUES (:usuario, :contrasena, :tipo)";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':usuario', $usuario);
    oci_bind_by_name($stmt, ':contrasena', $hash);
    oci_bind_by_name($stmt, ':tipo', $tipo);

    $result = @oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
    return $result;
}
?>