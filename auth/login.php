<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesion</h2>
    <form action="verificar.php" method="post">
        <label>Documento:</label><br>
        <input type="text" name="documento" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="contrasena" required><br><br>
        <input type="submit" value="Ingresar">
    </form>
</body>
</html>
