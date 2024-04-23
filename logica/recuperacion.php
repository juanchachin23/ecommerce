<?php
require 'conexion.php';
session_start();

$correo = $_POST['correo'];
$secreta = $_POST['secreta'];

// Consulta la base de datos para el usuario con el correo proporcionado
$q = "SELECT * FROM usuario WHERE usu_correo = '$correo'";
$consulta = mysqli_query($conexion, $q);
$user = mysqli_fetch_array($consulta);

// Verifica si el usuario existe y si la contraseña proporcionada es correcta
if ($user && password_verify($secreta, $user['palabra_secreta'])) {
    // El nombre de usuario y la contraseña son correctos
    $_SESSION['correo'] = $correo;
    header("location: ../nuevaClave.php");
} else {
    // El correo proporcionado o la palabra secreta son incorrectos.
    echo "CORREO O PALABRA SECREATA INCORRECTOS.";
}
?>
