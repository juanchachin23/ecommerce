<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DrUrban</title>
    <link rel="stylesheet" href="css/main.css">

    <!--Link para usar bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
 
</head>

    <body>

    <form action="registrarUsuario.php" method="POST">

    <h1>Dr Urban</h1>
        <hr>
        <?php
    if (isset($_GET['mensaje'])) {
        echo '<p>' . $_GET['mensaje'] . '</p>';
    }
    ?>
        <hr>
            <label>Usuario</label>
            <input type="text" name="usuario" placeholder="Nombre de usuario (*)">

            <label>Correo</label>
            <input type="text" name="correo" placeholder="Correo ejemplo@gmail.com (*)">

            <label>Direccion</label>
            <input type="text" name="direccion" placeholder="Direccion de envío">

            <label>Contraseña</label>
            <input type="text" name="clave" placeholder="Clave (*)">

            <label>Palabra Secreta de Recuperación</label>
            <input type="text" name="secreta" placeholder="Guarda tu palabra secreta para recuperar tu usuario (*)">
        <hr>
    
    <button type="submit">Crear Cuenta</button>
    <a class="volver" href="Index.php"> Volver a iniciar sesion </a>
    
    
    </form>
        
    </body>



</html>