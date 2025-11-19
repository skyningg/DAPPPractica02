<?php
include("conexion.php");

$nombre    = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono  = $_POST['telefono'];

$sql = "INSERT INTO personas (nombre, direccion, telefono) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $sql, [$nombre, $direccion, $telefono]);

if ($result) {
    header("Location: index.php");
} else {
    echo "Error al guardar.";
}
?>
