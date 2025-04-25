<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$bd = "biblioteca_software";

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    echo("Error de conexion: " . $conn->connect_error);
}
?>
