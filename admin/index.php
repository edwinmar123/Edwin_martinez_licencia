<?php

include '../auth/session.php';


?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Super Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4a4a4a;
        }
        .button {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .logout {
            background-color: #dc3545;
        }
        .logout:hover {
            background-color: #a71d2a;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenido Super Admin: <?php echo htmlspecialchars($_SESSION['nombre']); ?></h2>
        <p>Aquí podrás crear licencias, ver activas/inactivas, y crear nuevos administradores.</p>
        
        <a href="crear_licencia.php" class="button">Crear Licencias</a>
        <a href="crear_empresa.php" class="button">Crear empresa</a>
        <!-- <a href="crear_admin.php" class="button">Crear administradores</a> -->
        <a href="crear_admin.php" class="button">Crear Administradores</a>
        <a href="ver_empresas.php" class="button">Ver Empresas y Administradores</a>
        <a href="../auth/login.php" class="button logout">Cerrar Sesión</a>

    </div>
</body>
</html>