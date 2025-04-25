<?php
// include '../auth/session.php';
// session_start();

// // Verificar si el usuario tiene el rol de super admin
// if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'super_admin') {
//     header("Location: ../auth/login.php");
//     exit();
// }

include '../config/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $documento = $_POST['documento'];
    $nombre = $_POST['nombre'];
    $gmail = $_POST['gmail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña
    $id_rol = 2; 
    $id_empresa = $_POST['id_empresa'];

    $queryInsert = "INSERT INTO usuarios (Documento, contraseña, nombre, gmail, id_rol, id_empresa) 
                    VALUES ('$documento', '$password', '$nombre', '$gmail', '$id_rol', '$id_empresa')";

    if (mysqli_query($conn, $queryInsert)) {
        $mensaje = "Administrador creado exitosamente.";
    } else {
        $mensaje = "Error al crear el administrador: " . mysqli_error($conn);
    }
}


$queryEmpresas = "SELECT nit_empresa, nombre FROM empresa";
$resultEmpresas = mysqli_query($conn, $queryEmpresas);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Administrador</title>
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
        <h2>Crear Administrador</h2>
        <?php if (isset($mensaje)) { echo "<p class='mensaje'>$mensaje</p>"; } ?>
        <form method="POST" action="">
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" required>

            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="gmail">Correo Electrónico:</label>
            <input type="email" id="gmail" name="gmail" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="id_empresa">Empresa:</label>
            <select id="id_empresa" name="id_empresa" required>
                <option value="">Seleccione una empresa</option>
                <?php while ($empresa = mysqli_fetch_assoc($resultEmpresas)) { ?>
                    <option value="<?php echo $empresa['nit_empresa']; ?>">
                        <?php echo $empresa['nombre']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">Crear Administrador</button>
            <a href="index.php" class="back-button">Regresar al Panel</a>
        </form>
    </div>
</body>
</html>