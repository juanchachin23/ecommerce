<?php
require '../administrador/conexion.php';
session_start();

// Retrieve the value of $correo from the session variable
$correo = $_SESSION['correo'];

    function validarContrasena($contrasena) {
        if (strlen($contrasena) >= 8 && !preg_match('/\s/', $contrasena) && preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $contrasena) && preg_match('/\d{3,}/', $contrasena) && preg_match('/[A-Z]/', $contrasena) && preg_match('/[a-z]/', $contrasena)) {
            return true;
        } else {
            return false;
        }
    }

   if(empty($_POST["clave"])||empty($_POST["clave_con"]))
    {
            header('Location: ../nuevaClave.php?mensaje=DEBE COMPLETAR TODOS LOS CAMPOS VACÍOS.');
            
            exit();
    }

    $CLAVE = $_POST["clave"];
    $CLAVE_CON = $_POST["clave_con"];

    if (!validarContrasena($CLAVE)) {
        header('Location: ../nuevaClave.php?mensaje=La contraseña debe tener al menos 8 caracteres y contener al menos un caracter especial, tres números, una letra mayúscula y una minúscula y no debe contener espacios.');
        exit();
    }
    
    if ($CLAVE_CON == $CLAVE){
        //se cifra la contraseña
        $CLAVE_CON_HASH = password_hash($_POST["clave_con"], PASSWORD_DEFAULT);
    } else {
        // Store the error message in a session variable
        session_start();
        $_SESSION['error_message'] = 'Las contraseñas ingresadas no coinciden entre sí. Asegúrese de que sean idénticas.';
        header('Location: ../nuevaClave.php');
        exit();
    }


    $sentencias = $bd->prepare("UPDATE usuario SET usu_password = ? WHERE usu_correo = ?");
    $resultado = $sentencias->execute([$CLAVE_CON_HASH, $correo]);

    if($resultado === TRUE){
        header("Location: ../nuevaClave.php?mensaje=Su clave ha sido modificada correctamente.");
    }else{
        header("Location: ../nuevaClave.php?mensaje=ERROR");
        exit();
    }
    

?>