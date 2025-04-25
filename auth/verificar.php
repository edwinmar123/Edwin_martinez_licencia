<?php
session_start();
include '../config/conexion.php';

$documento = $_POST['documento'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM usuarios WHERE Documento = '$documento' AND contraseña = '$contrasena'";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $_SESSION['documento'] = $fila['Documento'];
    $_SESSION['rol'] = $fila['id_rol'];
    $_SESSION['nombre'] = $fila['nombre'];

    echo "Bienvenido " . $fila['nombre'] . "<br>";

    if ($fila['id_rol'] == 1) {
        echo "Redirigiendo al panel del super admin...";
        header("refresh:2;url=../admin/index.php");
    } else {
        echo "Redirigiendo al panel principal...";
        header("refresh:2;url=../panel/index.php");
    }
} else {
    echo "Documento o contraseña incorrectos.";
}
?>
