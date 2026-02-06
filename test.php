<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "192.168.100.245";
$port = "1521";
$serviceName  = "pdb_hidrogena";
$username = "hidrogena";
$password = "zubiri";

$connectionString = "(DESCRIPTION=
    (ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))
    (CONNECT_DATA=(SERVICE_NAME=$serviceName))
)";

$conn = oci_connect($username, $password, $connectionString);
if ($conn) {
    echo "✅ Conexión a Oracle correcta";
} else {
    $e = oci_error();
    echo "❌ Error Oracle: " . $e['message'];
}
?>