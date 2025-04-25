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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $gmail = $_POST['gmail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $id_rol = 3; 

    // Verificar si el correo ya existe
    $queryCheck = "SELECT * FROM usuarios WHERE gmail = '$gmail'";
    $resultCheck = mysqli_query($conn, $queryCheck);

    if (mysqli_num_rows($resultCheck) > 0) {
        $mensaje = "Error: El correo electrónico ya está registrado.";
    } else {
        // Insertar el nuevo bibliotecario
        $queryInsert = "INSERT INTO usuarios (Documento, contraseña, nombre, gmail, id_rol, id_empresa) 
                        VALUES ('$documento', '$password', '$nombre', '$gmail', '$id_rol', '$id_empresa')";

        if (mysqli_query($conn, $queryInsert)) {
            $mensaje = "Bibliotecario creado exitosamente.";
        } else {
            $mensaje = "Error al crear el bibliotecario: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Bibliotecario</title>
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
        <h2>Crear Bibliotecario</h2>
        <?php if (isset($mensaje)) { 
            $class = strpos($mensaje, 'Error') !== false ? 'mensaje error' : 'mensaje';
            echo "<p class='$class'>$mensaje</p>"; 
        } ?>
        <form method="POST" action="">
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" required>

            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="gmail">Correo Electrónico:</label>
            <input type="email" id="gmail" name="gmail" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Crear Bibliotecario</button>
            <a href="index.php" class="back-button">Regresar al Panel</a>
        </form>
    </div>
</body>
</html>