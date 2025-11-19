<?php
include("conexion.php");

$clave     = $_POST['clave'];
$nombre    = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono  = $_POST['telefono'];

$sql = "UPDATE personas SET nombre=$1, direccion=$2, telefono=$3 WHERE clave=$4";
$result = pg_query_params($conn, $sql, [$nombre, $direccion, $telefono, $clave]);

if ($result) {
    header("Location: index.php");
} else {
    echo "Error al actualizar.";
}
?>
