<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Personas</title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        a.new-person {
            margin-bottom: 10px;
            display: inline-block;
            padding: 5px 10px;
            background: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 8px 12px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        td a {
            margin-right: 5px;
            text-decoration: none;
            color: #007BFF;
        }
        td a.delete {
            color: #FF4C4C;
        }
    </style>
</head>
<body>
    <h1>Lista de Personas</h1>
    <a class="new-person" href="crear.php">➕ Nueva Persona</a>
    <table>
        <tr>
            <th>Clave</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php
        $resultado = pg_query($conn, "SELECT * FROM personas ORDER BY clave");
        while ($fila = pg_fetch_assoc($resultado)) {
            echo "<tr>
                <td>{$fila['clave']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['direccion']}</td>
                <td>{$fila['telefono']}</td>
                <td>
                    <a href='editar.php?clave={$fila['clave']}'>✏️ Editar</a>
                    <a class='delete' href='eliminar.php?clave={$fila['clave']}'>🗑️ Eliminar</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
