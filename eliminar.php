<?php
include("conexion.php");
$clave = $_GET['clave'];

$sql = "DELETE FROM personas WHERE clave=$1";
$result = pg_query_params($conn, $sql, [$clave]);

if ($result) {
    header("Location: index.php");
} else {
    echo "Error al eliminar.";
}
?>
