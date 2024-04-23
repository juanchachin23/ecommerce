<?php
require 'conexion.php';
session_start();

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

// Consulta la base de datos para el usuario con el nombre de usuario proporcionado
$q = "SELECT * FROM usuario WHERE usu_nombre = '$usuario'";
$consulta = mysqli_query($conexion, $q);
$user = mysqli_fetch_array($consulta);

// Verifica si el usuario existe y si la contraseña proporcionada es correcta
if ($user && password_verify($clave, $user['usu_password'])) {
    // El nombre de usuario y la contraseña son correctos
    $_SESSION['username'] = $usuario;
    // Guardar la dirección del usuario en una variable de sesión
    $_SESSION['usu_direccion'] = $user['usu_direccion'];
    // Guardar el correo del usuario en una variable de sesión
    $_SESSION['usu_correo'] = $user['usu_correo'];
    if ($user['usu_admin'] == 1) {
        header("location: ../paginaPrincipal.php");
    } else {
        header("location: ../administrador/index.php");
    }
} else {
    // El nombre de usuario o la contraseña son incorrectos
    header("Location: ../Index.php?mensaje=NOMBRE+DE+USUARIO+O+CONTRASEÑA+INVALIDA.");
    exit();
}
?>

