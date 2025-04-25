<?php
include '../auth/session.php';


if ($_SESSION['rol'] !== 'super_admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Principal - Super Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h2 {
            color: #4a4a4a;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
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
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bienvenido Super Admin: <?php echo $_SESSION['nombre']; ?></h2>
        <p>Aquí podrás gestionar licencias, administradores y más.</p>
        
        <div class="button-container">
            <a href="../admin/crear_licencia.php" class="button">Crear Licencias</a>
            <a href="../admin/ver_licencias.php" class="button">Ver Licencias</a>
            <a href="../admin/crear_admin.php" class="button">Crear Administradores</a>
            <a href="../auth/logout.php" class="button" style="background-color: #dc3545;">Cerrar Sesión</a>
        </div>
    </div>
</body>
</html>