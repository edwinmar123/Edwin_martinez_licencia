<?php
include '../config/conexion.php';


$query = "
    SELECT 
        e.nit_empresa, 
        e.nombre AS empresa_nombre, 
        e.direccion, 
        e.numero, 
        u.Documento, 
        u.nombre AS admin_nombre, 
        u.gmail,
        t.tipo AS tipo_licencia,
        l.fecha_fin,
        DATEDIFF(l.fecha_fin, CURDATE()) AS dias_restantes
    FROM empresa e
    LEFT JOIN usuarios u ON e.nit_empresa = u.id_empresa
    LEFT JOIN licencia l ON e.nit_empresa = l.ID_empresa
    LEFT JOIN tipo_licencia t ON l.ID_tipo = t.ID_Tipo
    WHERE u.id_rol = 2
    ORDER BY e.nit_empresa, u.nombre";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Empresas y Administradores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 1900px;
            margin: 0 auto;
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
        .status-activa {
            color: green;
            font-weight: bold;
        }
        .status-inactiva {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Empresas, Administradores y Licencias</h2>
        <table>
            <thead>
                <tr>
                    <th>NIT Empresa</th>
                    <th>Nombre Empresa</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Documento Admin</th>
                    <th>Nombre Admin</th>
                    <th>Email Admin</th>
                    <th>Tipo de Licencia</th>
                    <th>Fecha de Expiración</th>
                    <th>Días Restantes</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $currentEmpresa = null;
                while ($row = mysqli_fetch_assoc($result)) {
                    $estado = ($row['dias_restantes'] >= 0) ? "<span class='status-activa'>Activa</span>" : "<span class='status-inactiva'>Inactiva</span>";
                    if ($currentEmpresa !== $row['nit_empresa']) {
                        $currentEmpresa = $row['nit_empresa'];
                        echo "<tr>
                                <td>{$row['nit_empresa']}</td>
                                <td>{$row['empresa_nombre']}</td>
                                <td>{$row['direccion']}</td>
                                <td>{$row['numero']}</td>
                                <td>{$row['Documento']}</td>
                                <td>{$row['admin_nombre']}</td>
                                <td>{$row['gmail']}</td>
                                <td>{$row['tipo_licencia']}</td>
                                <td>{$row['fecha_fin']}</td>
                                <td>" . ($row['dias_restantes'] >= 0 ? $row['dias_restantes'] . " días" : "Expirada") . "</td>
                                <td>$estado</td>
                              </tr>";
                    } else {
                        echo "<tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{$row['Documento']}</td>
                                <td>{$row['admin_nombre']}</td>
                                <td>{$row['gmail']}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <a href="index.php" class="back-button">Regresar al Panel</a>
    </div>
</body>
</html>