<?php
// include '../auth/session.php';
// session_start();

// Verificar si el usuario tiene el rol de super admin
// if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'super_admin') {
//     header("Location: ../auth/login.php");
//     exit();
// }

include '../config/conexion.php';

function generarCodigoLicencia() {
    $codigo = '';
    for ($i = 0; $i < 10; $i++) {
        $codigo .= mt_rand(0, 9); 
    }
    return $codigo;
}
$codigoLicencia = generarCodigoLicencia();


$queryEmpresas = "SELECT nit_empresa, nombre FROM empresa";
$resultEmpresas = mysqli_query($conn, $queryEmpresas);


$queryTiposLicencia = "SELECT ID_Tipo, tipo, duracion_licencia, precio FROM tipo_licencia";
$resultTiposLicencia = mysqli_query($conn, $queryTiposLicencia);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $empresa = $_POST['empresa'];
    $tipoLicencia = $_POST['tipo_licencia'];
    $fechaInicio = date('Y-m-d');
    $duracion = intval($_POST['duracion']); 
    $fechaFin = date('Y-m-d', strtotime("+$duracion days"));
    $precio = $_POST['precio'];

    $queryInsert = "INSERT INTO licencia (ID_licencia, nombre, precio, fecha_inicio, fecha_fin, ID_tipo, ID_empresa) 
                    VALUES ('$codigo', 'Licencia Generada', '$precio', '$fechaInicio', '$fechaFin', '$tipoLicencia', '$empresa')";

    if (mysqli_query($conn, $queryInsert)) {
        $mensaje = "Licencia creada exitosamente.";
    } else {
        $mensaje = "Error al crear la licencia: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Licencia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 600px;
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, select, button {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .mensaje {
            text-align: center;
            margin-top: 10px;
            color: green;
        }
    </style>
    <script>
        function actualizarDuracion() {
            const tipoLicencia = document.getElementById('tipo_licencia');
            const duracionInput = document.getElementById('duracion');
            const precioInput = document.getElementById('precio');
            const seleccion = tipoLicencia.options[tipoLicencia.selectedIndex];
            duracionInput.value = seleccion.getAttribute('data-duracion');
            precioInput.value = seleccion.getAttribute('data-precio');
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Crear Licencia</h2>
        <?php if (isset($mensaje)) { echo "<p class='mensaje'>$mensaje</p>"; } ?>
        <form method="POST" action="">
            <label for="codigo">Código de Licencia:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $codigoLicencia; ?>" readonly>

            <label for="empresa">Empresa:</label>
            <select id="empresa" name="empresa" required>
                <option value="">Seleccione una empresa</option>
                <?php while ($empresa = mysqli_fetch_assoc($resultEmpresas)) { ?>
                    <option value="<?php echo $empresa['nit_empresa']; ?>">
                        <?php echo $empresa['nombre']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="tipo_licencia">Tipo de Licencia:</label>
            <select id="tipo_licencia" name="tipo_licencia" onchange="actualizarDuracion()" required>
                <option value="">Seleccione un tipo de licencia</option>
                <?php while ($tipo = mysqli_fetch_assoc($resultTiposLicencia)) { ?>
                    <option value="<?php echo $tipo['ID_Tipo']; ?>" 
                            data-duracion="<?php echo $tipo['duracion_licencia']; ?>" 
                            data-precio="<?php echo $tipo['precio']; ?>">
                        <?php echo $tipo['tipo']; ?>
                    </option>
                <?php } ?>
                <option value="demo" data-duracion="2" data-precio="0">Demo (2 días)</option>
            </select>

            <label for="duracion">Duración (en días):</label>
            <input type="number" id="duracion" name="duracion" readonly>

            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" readonly>

            <button type="submit">Crear Licencia</button>
            <a href="index.php" class="back-button">Regresar al Panel</a>
        </form>
    </div>
</body>
</html>