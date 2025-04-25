<?php
session_start();
include '../config/conexion.php';


if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    header("Location: login.php");
    exit();
}


$id_empresa = $_SESSION['id_empresa'];
$queryLicencia = "
    SELECT t.tipo AS tipo_licencia
    FROM licencia l
    JOIN tipo_licencia t ON l.ID_tipo = t.ID_Tipo
    WHERE l.ID_empresa = '$id_empresa' AND l.fecha_fin >= CURDATE()
    LIMIT 1";
$resultLicencia = mysqli_query($conn, $queryLicencia);
$licencia = mysqli_fetch_assoc($resultLicencia);


$tipoLicencia = $licencia['tipo_licencia'] ?? 'Sin Licencia';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #4a4a4a;
        }
        a {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
        a.disabled {
            background-color: #ccc;
            pointer-events: none;
            cursor: not-allowed;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenido Administrador: <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
        <p>Licencia: <strong><?php echo $tipoLicencia; ?></strong></p>

   
        <?php if ($tipoLicencia === 'Premium') { ?>
            <a href="crear_bibliotecario.php">Crear Bibliotecarios</a>
            <a href="ver_estudiantes.php">Ver Estudiantes</a>
            <a href="reportes.php">Generar Reportes</a>
            <a href="generar_barras.php" class="">Generador de codigo de barras</a>
            <a href="leer_barras.php" class="">lector de codigo de barras</a>
        <?php } elseif ($tipoLicencia === 'Básica') { ?>
            <a href="crear_bibliotecario.php" class="disabled">Crear Bibliotecarios</a>
            <a href="ver_estudiantes.php">Ver Estudiantes</a>
            <a href="generar_barras.php" class="">Generador de codigo de barras</a>
            <a href="leer_barras.php" class="">lector  de codigo de barras</a>
            <a href="reportes.php" class="disabled">Generar Reportes</a>
        <?php } else { ?>
            <p style="color: red;">No tienes una licencia activa. Contacta al Super Admin.</p>
        <?php } ?>

        <a href="login.php">Cerrar Sesión</a>
    </div>
</body>
</html>