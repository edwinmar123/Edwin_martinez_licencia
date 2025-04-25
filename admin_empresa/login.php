<?php
session_start();
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $documento = $_POST['documento'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE nombre = '$nombre' AND Documento = '$documento'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['contraseña'])) {
            $_SESSION['id_usuario'] = $user['Documento'];
            $_SESSION['nombre'] = $user['nombre'];
            $_SESSION['rol'] = $user['id_rol'];
            $_SESSION['id_empresa'] = $user['id_empresa'];

           
            if ($user['id_rol'] == 2) { 
                header("Location: index.php");
            } elseif ($user['id_rol'] == 3) { 
                header("Location: bibliotecario/index.php");
            } else {
                $error = "No tienes permisos para acceder.";
            }
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Administrador/Bibliotecario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
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
            gap: 15px;
        }
        label {
            font-weight: bold;
        }
        input, button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="documento">Documento:</label>
            <input type="text" id="documento" name="documento" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Iniciar Sesión</button>
            <body onload ="document.getElementById('nombre').focus();"></body>
            

            <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
        </form>
    </div>
</body>
</html>