<?php
include("conexion.php");

$mensaje = "";

if (isset($_POST['guardar'])) {
    $nombre    = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono  = $_POST['telefono'];
    
    $sql = "INSERT INTO personas (nombre, direccion, telefono) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $sql, [$nombre, $direccion, $telefono]);
    
    $mensaje = $result ? "Persona guardada correctamente." : "Error al guardar.";
}

if (isset($_POST['actualizar'])) {
    $clave     = $_POST['clave'];
    $nombre    = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono  = $_POST['telefono'];
    
    $sql = "UPDATE personas SET nombre=$1, direccion=$2, telefono=$3 WHERE clave=$4";
    $result = pg_query_params($conn, $sql, [$nombre, $direccion, $telefono, $clave]);
    
    $mensaje = $result ? "Persona actualizada correctamente." : "Error al actualizar.";
}

if (isset($_GET['eliminar'])) {
    $clave = $_GET['eliminar'];
    $sql = "DELETE FROM personas WHERE clave=$1";
    $result = pg_query_params($conn, $sql, [$clave]);
    
    $mensaje = $result ? "Persona eliminada correctamente." : "Error al eliminar.";
}

$editando = false;
$personaEdit = null;
if (isset($_GET['editar'])) {
    $editando = true;
    $clave = $_GET['editar'];
    $sql = "SELECT * FROM personas WHERE clave=$1";
    $resultado = pg_query_params($conn, $sql, [$clave]);
    $personaEdit = pg_fetch_assoc($resultado);
}

$resultado = pg_query($conn, "SELECT * FROM personas ORDER BY clave");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Personas - Verde y Rosa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #eafaf1; /* verde muy suave */
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
            color: #2d7a4f; /* verde oscuro */
        }
        h2 {
            margin-top: 20px;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table th, table td {
            border: 1px solid #2d7a4f;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #f9c1d9; /* rosa suave */
            color: #2d7a4f;
        }
        table tr:nth-child(even) {
            background-color: #d1f0d6; /* verde suave */
        }
        form {
            width: 50%;
            margin: 0 auto 20px auto;
            padding: 20px;
            background: #f9c1d9; /* rosa suave */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form input {
            width: 95%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #2d7a4f;
            border-radius: 5px;
        }
        form button {
            padding: 10px 20px;
            background-color: #2d7a4f;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #196032;
        }
        a {
            text-decoration: none;
            color: #c2185b;
            font-weight: bold;
        }
        a:hover {
            color: #ff4081;
        }
        p.mensaje {
            text-align: center;
            font-weight: bold;
            color: #2d7a4f;
        }
    </style>
</head>
<body>
    <h1>CRUD Personas</h1>
    
    <?php if($mensaje) echo "<p class='mensaje'>$mensaje</p>"; ?>
    
    <!-- FORMULARIO CREAR / EDITAR -->
    <h2><?= $editando ? "Editar Persona" : "Crear Nueva Persona" ?></h2>
    <form method="POST">
        <?php if($editando): ?>
            <input type="hidden" name="clave" value="<?= $personaEdit['clave'] ?>">
        <?php endif; ?>
        
        Nombre: <input type="text" name="nombre" value="<?= $editando ? $personaEdit['nombre'] : '' ?>" required><br>
        Dirección: <input type="text" name="direccion" value="<?= $editando ? $personaEdit['direccion'] : '' ?>"><br>
        Teléfono: <input type="text" name="telefono" value="<?= $editando ? $personaEdit['telefono'] : '' ?>"><br>
        
        <button type="submit" name="<?= $editando ? 'actualizar' : 'guardar' ?>">
            <?= $editando ? "Actualizar" : "Guardar" ?>
        </button>
        <?php if($editando): ?>
            <a href="crud.php">Cancelar</a>
        <?php endif; ?>
    </form>
    
    <h2>Lista de Personas</h2>
    <table>
        <tr>
            <th>Clave</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php while ($fila = pg_fetch_assoc($resultado)): ?>
            <tr>
                <td><?= $fila['clave'] ?></td>
                <td><?= $fila['nombre'] ?></td>
                <td><?= $fila['direccion'] ?></td>
                <td><?= $fila['telefono'] ?></td>
                <td>
                    <a href="?editar=<?= $fila['clave'] ?>">✏️ Editar</a> |
                    <a href="?eliminar=<?= $fila['clave'] ?>" onclick="return confirm('¿Seguro que quieres eliminar?')">🗑️ Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
