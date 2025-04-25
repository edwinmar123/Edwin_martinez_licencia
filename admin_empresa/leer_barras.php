<?php
session_start();
include '../config/conexion.php';

// Verificar si el usuario tiene el rol de admin empresa
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    header("Location: login.php");
    exit();
}

// Procesar el formulario
$estudiante = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo_barra = $_POST['codigo_barra'];

    // Buscar el estudiante por código de barras
    $query = "SELECT * FROM estudiantes WHERE codigo_barra = '$codigo_barra'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $estudiante = mysqli_fetch_assoc($result);
    } else {
        $mensaje = "No se encontró ningún estudiante con ese código de barras.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leer Código de Barras</title>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
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
        .mensaje {
            text-align: center;
            margin-top: 10px;
            color: red;
        }
        .resultado {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Leer Código de Barras</h2>
        <div id="reader" style="width: 100%;"></div>
        <script>
            const html5QrCode = new Html5Qrcode("reader");
            html5QrCode.start(
                { facingMode: "environment" },
                {
                    fps: 10,
                    qrbox: 250
                },
                (decodedText) => {
                    document.getElementById('codigo_barra').value = decodedText;
                },
                (errorMessage) => {
                    console.log(errorMessage);
                }
            );
        </script>
        <form method="POST" action="">
            <input type="hidden" id="codigo_barra" name="codigo_barra">
            <button type="submit">Buscar Estudiante</button>
            <a href="index.php" class="back-button">Regresar al Panel</a>
        </form>

        <?php if (isset($mensaje)) { echo "<p class='mensaje'>$mensaje</p>"; } ?>

        <?php if ($estudiante) { ?>
            <div class="resultado">
                <p><strong>ID Estudiante:</strong> <?php echo $estudiante['ID_estudiante']; ?></p>
                <p><strong>Nombre:</strong> <?php echo $estudiante['Nombre']; ?></p>
                <p><strong>Curso:</strong> <?php echo $estudiante['curso']; ?></p>
                <p><strong>Código de Barras:</strong> <?php echo $estudiante['codigo_barra']; ?></p>
                
            </div>
        <?php } ?>
    </div>
</body>
</html>