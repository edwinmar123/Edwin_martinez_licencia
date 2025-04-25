<?php
include '../auth/session.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Principal</title>
</head>
<body>
    <h2>Bienvenido: <?php echo $_SESSION['nombre']; ?></h2>
    <p>Acceso al sistema de biblioteca segun su rol.</p>
</body>
</html>
    