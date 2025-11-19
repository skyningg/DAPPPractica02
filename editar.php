<?php
include("conexion.php");
$clave = $_GET['clave'];

$sql = "SELECT * FROM personas WHERE clave=$1";
$resultado = pg_query_params($conn, $sql, [$clave]);
$persona = pg_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html>
<head><title>Editar Persona</title></head>
<body>
    <h1>Editar Persona</h1>
    <form action="actualizar.php" method="POST">
        <input type="hidden" name="clave" value="<?= $persona['clave'] ?>">
        Nombre: <input type="text" name="nombre" value="<?= $persona['nombre'] ?>" required><br>
        Dirección: <input type="text" name="direccion" value="<?= $persona['direccion'] ?>"><br>
        Teléfono: <input type="text" name="telefono" value="<?= $persona['telefono'] ?>"><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
