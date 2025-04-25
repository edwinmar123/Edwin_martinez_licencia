<?php
session_start();
include '../../config/conexion.php';

// Verificar si el usuario tiene el rol de bibliotecario
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: ../login.php");
    exit();
}

echo "<h2>Bienvenido Bibliotecario: " . htmlspecialchars($_SESSION['nombre']) . "</h2>";
?>

<a href="../login.php">Cerrar Sesión</a>