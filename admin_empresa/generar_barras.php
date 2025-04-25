<?php
session_start();
include '../config/conexion.php';
require '../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

function generarCodigoBarra() {
    return 'BAR' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
}

$codigo_barra = null;
$ruta_imagen = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $curso = $_POST['curso'];
    $codigo_barra = generarCodigoBarra();

  
    $queryInsert = "INSERT INTO estudiantes (Nombre, codigo_barra, curso) 
                    VALUES ('$nombre', '$codigo_barra', '$curso')";
    if (mysqli_query($conn, $queryInsert)) {
        $mensaje = "Estudiante registrado exitosamente.";

        
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = $generator->getBarcode($codigo_barra, $generator::TYPE_CODE_128);

        
        $ruta_imagen = "../codigos/$codigo_barra.png";
        file_put_contents($ruta_imagen, $barcodeImage);
    } else {
        $mensaje = "Error al registrar el estudiante: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generar Codigo de Barras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, button {
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
        .mensaje.error {
            color: red;
        }
        .barcode {
            text-align: center;
            margin-top: 20px;
        }
        .back-button {
            display: inline-block;
            padding: 10px;
            background-color: #6c757d;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Generar Codigo de Barras</h2>
        <?php if (isset($mensaje)) {
            $class = strpos($mensaje, 'Error') !== false ? 'mensaje error' : 'mensaje';
            echo "<p class='$class'>$mensaje</p>";
        } ?>
        <form method="POST" action="">
            <label for="nombre">Nombre del Estudiante:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="curso">Curso:</label>
            <input type="text" id="curso" name="curso" required>

            <button type="submit">Generar Codigo de Barras</button>
            <a href="index.php" class="back-button">Regresar al Panel</a>
        </form>

        <?php if ($codigo_barra && $ruta_imagen) { ?>
            <div class="barcode">
                <p><strong>Codigo de Barras:</strong> <?php echo $codigo_barra; ?></p>
                <img src="<?php echo $ruta_imagen; ?>" alt="Codigo de Barras">
            </div>
        <?php } ?>
    </div>
</body>
</html>
