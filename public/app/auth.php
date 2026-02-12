<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// LOGIN -- Inicia sesión de un usuario
function login($usuario, $contrasena) {
    global $conn;

    // Consulta parametrizada
    $sql = "SELECT idUsuario, tipo, contrasena FROM usuarios WHERE usuario = :usuario";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':usuario', $usuario);
    oci_execute($stmt);

    // Recupera la fila del usuario como array asociativo. Si no existe, devuelve false.
    $row = oci_fetch_assoc($stmt);

    // Comprueba si el usuario existe. Guarda la contraseña almacenada en BD.
    if ($row) {
        $stored = $row['CONTRASENA'];

        // Caso 1: Compara la contraseña introducida con el hash.
        if (password_verify($contrasena, $stored)) {
            $_SESSION['idUsuario'] = $row['IDUSUARIO'];
            $_SESSION['tipo'] = $row['TIPO'];
            return true;
        }

        // Caso 2: Compara la contraseña introducida con la contraseña en texto plano.
        if ($stored === $contrasena) {
            // Genera automáticamente a hash -- Indica a PHP que utilice el algoritmo de hash más seguro.
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

// CHECK LOGIN -- Redirige a index.php si no hay sesión iniciada
function check_login() {
    if (!isset($_SESSION['idUsuario'])) {
        header('Location: index.php');
        exit;
    }
}

// LOGOUT -- Cierra la sesión del usuario
function logout() {
    $_SESSION = [];
    session_destroy();

    // Elimina las cookies de sesión
    if (isset($_COOKIE['usuario'])) {
        setcookie('usuario', '', time() - 3600, "/");
    }

    header('Location: index.php');
    exit;
}

// REGISTRO -- Crea un nuevo usuario
function register_user($usuario, $contrasena) {
    global $conn;
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);
    $tipo = 'Cliente'; // Fijo

    $sql = "INSERT INTO usuarios (usuario, contrasena, tipo) VALUES (:usuario, :contrasena, :tipo)";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':usuario', $usuario);
    oci_bind_by_name($stmt, ':contrasena', $hash);
    oci_bind_by_name($stmt, ':tipo', $tipo);

    // Ejecuta la consulta y se utiliza el operador de control de errores
    $result = @oci_execute($stmt, OCI_COMMIT_ON_SUCCESS);
    return $result;
}
?>