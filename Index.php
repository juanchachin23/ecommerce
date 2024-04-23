<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DrUrban</title>
    <link rel="stylesheet" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

    <body>

   
    <form action="logica/loguear.php" method="POST">

    <h1>Dr Urban</h1>
    
    <hr>
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<p>' . $_GET['mensaje'] . '</p>';
        }
        ?>
    <hr>

    <label>Usuario</label>
    <input type="text" name="usuario" placeholder="Nombre de usuario">

    <label>Contraseña</label>
    <input type="password" name="clave" placeholder="Clave">
    <a href="recuperarUsuario.php">He olvidado mis datos de ingreso</a>

    <hr>
   
    <button type="submit">Iniciar sesion</button>

    <a class="volver" href="CrearCuenta.php">Crear Cuenta</a>
    </form>
    
        
    </div>

    </body>



</html>