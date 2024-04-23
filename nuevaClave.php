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

    <!-- Added styles for buttons -->
    <style>
        .buttons {
            display: flex;
            justify-content: space-between;
        }
        .buttons button {
            margin: 0 10px;
        }
    </style>

    <?php
    // Check for the existence of the 'mensaje' query parameter and display it if it exists
    if (isset($_GET['mensaje'])) {
        echo '<div class="alert alert-danger">' . $_GET['mensaje'] . '</div>';
    }
    ?>


</head>

    <body>

    <?php
    // Check for the existence of the error_message session variable and display it if it exists
    session_start();
    if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
        // Unset the session variable so the message is not displayed again
        unset($_SESSION['error_message']);
    }
    ?>
   
    <form action="logica/crearClave.php" method="POST">
    <h1>Dr Urban</h1>
       
    <label>Nueva Clave de Usuario</label>
    <input type="text" name="clave" placeholder="Introduzca su nueva clave">

    <label>Confirmar Clave</label>
    <input type="text" name="clave_con" placeholder="Confirme su nueva clave">
    
    <hr>
   
    <div class="buttons">
        <button type="button" onclick="location.href='Index.php'">Volver a inicio</button>
        
        <button type="submit">Confirmar</button>
    </div>

    </form>
    
        
    </div>

    </body>

</html>


