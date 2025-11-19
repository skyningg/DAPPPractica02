<?php
session_start();

// Inicializar arreglo si no existe
if (!isset($_SESSION['personas'])) {
    $_SESSION['personas'] = [];
}

// Función para obtener todas las personas
function obtenerPersonas() {
    return $_SESSION['personas'];
}

// Función para agregar persona
function agregarPersona($nombre, $direccion, $telefono) {
    $clave = count($_SESSION['personas']) + 1;
    $_SESSION['personas'][$clave] = [
        "clave" => $clave,
        "nombre" => $nombre,
        "direccion" => $direccion,
        "telefono" => $telefono
    ];
}

// Función para actualizar persona
function actualizarPersona($clave, $nombre, $direccion, $telefono) {
    if (isset($_SESSION['personas'][$clave])) {
        $_SESSION['personas'][$clave] = [
            "clave" => $clave,
            "nombre" => $nombre,
            "direccion" => $direccion,
            "telefono" => $telefono
        ];
    }
}

// Función para eliminar persona
function eliminarPersona($clave) {
    unset($_SESSION['personas'][$clave]);
}
?>
