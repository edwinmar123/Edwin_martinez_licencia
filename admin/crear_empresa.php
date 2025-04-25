<?php
// include '../auth/session.php';
// session_start();

// if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'super_admin') {
//     header("Location: ../auth/login.php");
//     exit();
// }

include '../config/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nit = $_POST['nit'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $numero = $_POST['numero'];

    $queryInsert = "INSERT INTO empresa (nit_empresa, nombre, direccion, numero) 
                    VALUES ('$nit', '$nombre', '$direccion', '$numero')";

    if (mysqli_query($conn, $queryInsert)) {
        $mensaje = "Empresa creada exitosamente.";
    } else {
        $mensaje = "Error al crear la empresa: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Empresa</title>
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
        <h2>Crear Empresa</h2>
        <?php if (isset($mensaje)) { echo "<p class='mensaje'>$mensaje</p>"; } ?>
        <form method="POST" action="">
            <label for="nit">NIT:</label>
            <input type="text" id="nit" name="nit" required>

            <label for="nombre">Nombre de la Empresa:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>

            <label for="numero">Número de Teléfono:</label>
            <input type="text" id="numero" name="numero" required>

            <button type="submit">Crear Empresa</button>
            <a href="index.php" class="back-button">Regresar al Panel</a>
        </form>
    </div>
</body>
</html>