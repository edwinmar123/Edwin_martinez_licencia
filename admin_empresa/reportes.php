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


if ($tipoLicencia !== 'Premium') {
    die("No tienes permisos para acceder a esta funcionalidad.");
}


$queryReporte = "
    SELECT e.ID_estudiante, e.Nombre AS nombre_estudiante, e.curso, COUNT(i.ID_estudiante) AS total_ingresos
    FROM ingreso i
    JOIN estudiantes e ON i.ID_estudiante = e.ID_estudiante
    WHERE i.ID_empresa = '$id_empresa'
    GROUP BY e.ID_estudiante, e.Nombre, e.curso
    ORDER BY total_ingresos DESC";
$resultReporte = mysqli_query($conn, $queryReporte);


$queryTotalIngresos = "
    SELECT COUNT(*) AS total_general
    FROM ingreso
    WHERE ID_empresa = '$id_empresa'";
$resultTotalIngresos = mysqli_query($conn, $queryTotalIngresos);
$totalIngresos = mysqli_fetch_assoc($resultTotalIngresos)['total_general'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ingresos</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #007bff;
            color: #fff;
        }
        .back-button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            background-color: #6c757d;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
        .total-ingresos {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reporte de Ingresos a la Biblioteca</h2>
        <p class="total-ingresos">Total de ingresos: <strong><?php echo $totalIngresos; ?></strong></p>
        <table>
            <thead>
                <tr>
                    <th>ID Estudiante</th>
                    <th>Nombre</th>
                    <th>Curso</th>
                    <th>Total de Ingresos</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reporte = mysqli_fetch_assoc($resultReporte)) { ?>
                    <tr>
                        <td><?php echo $reporte['ID_estudiante']; ?></td>
                        <td><?php echo $reporte['nombre_estudiante']; ?></td>
                        <td><?php echo $reporte['curso']; ?></td>
                        <td><?php echo $reporte['total_ingresos']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="index.php" class="back-button">Regresar al Panel</a>
    </div>
</body>
</html>