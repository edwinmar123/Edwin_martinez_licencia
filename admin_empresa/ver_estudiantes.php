<?php
session_start();
include '../config/conexion.php';

// Verificar si el usuario tiene el rol de admin empresa
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    header("Location: login.php");
    exit();
}

// Obtener el tipo de licencia de la empresa
$id_empresa = $_SESSION['id_empresa'];
$queryLicencia = "
    SELECT t.tipo AS tipo_licencia
    FROM licencia l
    JOIN tipo_licencia t ON l.ID_tipo = t.ID_Tipo
    WHERE l.ID_empresa = '$id_empresa' AND l.fecha_fin >= CURDATE()
    LIMIT 1";
$resultLicencia = mysqli_query($conn, $queryLicencia);
$licencia = mysqli_fetch_assoc($resultLicencia);

// Si no hay licencia activa, asignar "Sin Licencia"
$tipoLicencia = $licencia['tipo_licencia'] ?? 'Sin Licencia';

// Restringir acceso si no hay licencia activa
if ($tipoLicencia === 'Sin Licencia') {
    die("No tienes permisos para acceder a esta funcionalidad.");
}

// Obtener los estudiantes que han ingresado a la biblioteca
$queryEstudiantes = "
    SELECT e.ID_estudiante, e.Nombre AS nombre_estudiante, e.curso, i.FECHA_HORA AS fecha_ingreso
    FROM ingreso i
    JOIN estudiantes e ON i.ID_estudiante = e.ID_estudiante
    JOIN licencia l ON l.ID_empresa = '$id_empresa'
    WHERE l.ID_empresa = '$id_empresa'
    ORDER BY i.FECHA_HORA DESC";
$resultEstudiantes = mysqli_query($conn, $queryEstudiantes);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Estudiantes que han ingresado</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Estudiantes que han ingresado a la biblioteca</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Estudiante</th>
                    <th>Nombre</th>
                    <th>Curso</th>
                    <th>Fecha de Ingreso</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($estudiante = mysqli_fetch_assoc($resultEstudiantes)) { ?>
                    <tr>
                        <td><?php echo $estudiante['ID_estudiante']; ?></td>
                        <td><?php echo $estudiante['nombre_estudiante']; ?></td>
                        <td><?php echo $estudiante['curso']; ?></td>
                        <td><?php echo $estudiante['fecha_ingreso']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="index.php" class="back-button">Regresar al Panel</a>
    </div>
</body>
</html>