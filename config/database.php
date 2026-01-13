<?php
$host = "10.14.1.206";
$port = "1521";
$sid  = "pdb_hidrogena";  
$username = "hidrogena";  
$password = "zubiri";     

$connectionString = "(DESCRIPTION=
    (ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))
    (CONNECT_DATA=(SID=$sid))
)";

$conn = oci_connect($username, $password, $connectionString);
if (!$conn) {
    $e = oci_error();
    die("Error al conectar a Oracle: " . $e['message']);
}
?>