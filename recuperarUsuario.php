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

</head>

    <body>

   
    <form action="../logica/recuperacion.php" method="POST">
    <h1>Dr Urban</h1>

       
    <label>Correo</label>
    <input type="email" name="correo" placeholder="Correo">

    <label>Palabra Secreta de Recuperación</label>
    <input type="text" name="secreta" placeholder="Palabra Secreta de Recuperación">
    
    <hr>
   
    <div class="buttons">
        <button type="button" onclick="location.href='Index.php'">Volver</button>
        
        <button type="submit">Recuperar Cuenta</button>
    </div>

    </form>
    
        
    </div>

    </body>


</html>

