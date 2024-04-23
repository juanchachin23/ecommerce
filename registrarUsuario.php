<?php
    function validarNombreUsuario($nombreusuario) {
        if (preg_match('/[A-Za-z]/', $nombreusuario) && preg_match('/\d/', $nombreusuario) && !preg_match('/\s/', $nombreusuario)) {
            return true;
        } else {
            return false;
        }
    }
    /*Genera un nombre de usuario aleatorio de 8 caracteres utilizando letras mayúsculas y minúsculas y números*/
    function generarNombreUsuario($nombreBase) {
        $letras = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numeros = '0123456789';
        $longitudLetras = strlen($letras);
        $longitudNumeros = strlen($numeros);
        $nombreUsuario = substr($nombreBase, 0, 4);
        for ($i = 0; $i < 2; $i++) {
            $nombreUsuario .= $letras[rand(0, $longitudLetras - 1)];
        }
        for ($i = 0; $i < 2; $i++) {
            $nombreUsuario .= $numeros[rand(0, $longitudNumeros - 1)];
        }
        return str_shuffle($nombreUsuario);
    }

    /*Esta función utiliza la función filter_var de PHP con el filtro FILTER_VALIDATE_EMAIL para verificar si la dirección de correo electrónico 
    proporcionada es válida. Si es válida, la función devuelve verdadero; de lo contrario, devuelve falso.*/
    function validarCorreo($correo) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /*No contiene espacios (!preg_match('/\s/', $contrasena)).
    Verificar si la longitud de la contraseña es mayor o igual a 8 (strlen($contrasena) >= 8)
    Contiene al menos un carácter especial (preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $contrasena))
    Contiene al menos tres números (preg_match('/\d{3,}/', $contrasena))
    Contiene al menos una letra mayúscula (preg_match('/[A-Z]/', $contrasena))
    Contiene al menos una letra minúscula (preg_match('/[a-z]/', $contrasena))*/

    function validarContrasena($contrasena) {
        if (strlen($contrasena) >= 8 && !preg_match('/\s/', $contrasena) && preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $contrasena) && preg_match('/\d{3,}/', $contrasena) && preg_match('/[A-Z]/', $contrasena) && preg_match('/[a-z]/', $contrasena)) {
            return true;
        } else {
            return false;
        }
    }
    
    /*Palabra secreta no contiene numeros, espacios, ni caracteres eseciales, y debe tener como minimo de 6 letras*/
    function validate_secret_word($secret_word) {
        if (preg_match('/^[a-zA-Z]{6,}$/', $secret_word)) {
            return true;
        } else {
            return false;
        }
    }
    

    if(empty($_POST["usuario"])||empty($_POST["correo"])||empty($_POST["clave"])||empty($_POST["secreta"]))
    {
            header('Location: CrearCuenta.php?mensaje=DEBE COMPLETAR TODOS LOS CAMPOS OBLIGATORIOS(*)');
            
            exit();
    }
        

    include_once 'administrador/conexion.php';
    $USUARIO = $_POST["usuario"];
    $CORREO = $_POST["correo"];
    $DIRECCION = $_POST["direccion"];
    $CLAVE = $_POST["clave"];
    $SECRETA = $_POST["secreta"];

    if (!validarNombreUsuario($USUARIO)) {
        header('Location: CrearCuenta.php?mensaje=El Nombre de Usuario debe contener letras y números, y no debe estar separado por espacios.');
        exit();
    }

    $sentencia = $bd->prepare("SELECT * FROM usuario WHERE usu_nombre = ?");
    $sentencia->execute([$USUARIO]);
    $usuario = $sentencia->fetch();

    if ($usuario) {
        $sugerencias = [];
        for ($i = 0; $i < 3; $i++) {
            $sugerencias[] = generarNombreUsuario($USUARIO);
        }
        header('Location: CrearCuenta.php?mensaje=Nombre de usuario ya registrado. Sugerencias: ' . implode(', ', $sugerencias));
        exit();
    }

    if (!validarCorreo($CORREO)) {
        header('Location: CrearCuenta.php?mensaje=Correo invalido');
        exit();
    }

    $sentencia = $bd->prepare("SELECT * FROM usuario WHERE usu_correo = ?");
    $sentencia->execute([$CORREO]);
    $email = $sentencia->fetch();

    if ($email) {
        header('Location: CrearCuenta.php?mensaje=Correo ya registrado.');
        exit();
    }

    if (!validarContrasena($CLAVE)) {
        header('Location: CrearCuenta.php?mensaje=La contraseña debe tener al menos 8 caracteres y contener al menos un caracter especial, tres números, una letra mayúscula y una minúscula y no debe contener espacios.');
        exit();
    }
    
       //se cifra la contraseña
    $CLAVEHASH = password_hash($_POST["clave"], PASSWORD_DEFAULT);
    
    if (!validate_secret_word($SECRETA)) {
        header('Location: CrearCuenta.php?mensaje=La Palabra Secreta de Recuperación solo debe contener un mínimo de 6 letras. No use espacios, números o caracteres especiales.');
        exit();
    }
        //se cifra la palabra secreta
    $SECRETAHASH = password_hash($_POST["secreta"], PASSWORD_DEFAULT);

    $sentencias = $bd->prepare("INSERT INTO usuario(usu_nombre,usu_correo,usu_direccion,usu_password,palabra_secreta) VALUES (?,?,?,?,?)");
    $resultado = $sentencias->execute([$USUARIO,$CORREO,$DIRECCION,$CLAVEHASH,$SECRETAHASH]);

    if($resultado === TRUE){
        header("Location:CrearCuenta.php?mensaje=El Usuario ha sido registrado correctamente");
    }else{
        header("Location:CrearCuenta.php?mensaje=ERROR");
        exit();
    }
?>
