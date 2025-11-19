<?php
$host = "localhost";
$port = "5432";
$db   = "personas_db";
$user = "postgres";   
$pass = "1234"; 

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Error de conexión a PostgreSQL.");
}
?>
