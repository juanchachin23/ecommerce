<?php
require 'config/Conexion.php';
$db = new Database();
$con = $db->conectar();

// Obtener el nombre de la categoría desde la URL
$categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : null;

// Consulta para obtener los productos
if ($categoria) {
    // Si se especificó una categoría, obtener solo los productos de esa categoría
    $sql = $con->prepare("SELECT id_producto,produc_nombre,produc_precio,produc_id_categoria FROM producto WHERE produc_activo=1 AND produc_id_categoria=:id_categoria");
    $sql->bindParam(':id_categoria', $categoria);
} else {
    // Si no se especificó una categoría, obtener todos los productos
    $sql = $con->prepare("SELECT id_producto,produc_nombre,produc_precio,produc_id_categoria FROM producto WHERE produc_activo=1");
}
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClothesShop</title>
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/rrr.css">
</head>

<body>

    <div class="wrapper">
        <header class="header-mobile">
            <h1 class="logo">ClothesShop</h1>
            <button class="open-menu" id="open-menu">
                <i class="bi bi-list"></i>
            </button>
        </header>
        <aside>
            <button class="close-menu" id="close-menu">
                <i class="bi bi-x"></i>
            </button>
            <header>
                <h1 class="logo">ClothesShop</h1>
            </header>
            
                <nav>
                    <ul class="menu">
                    <li>
                        <button id="todos" name="categoria" class="boton-menu boton-categoria" onclick="window.location.href='paginaPrincipal.php?id_categoria='"><i class="bi bi-hand-index-thumb"></i>Todod los productos</button>
                        <li>
                        <li>
                        <button id="abrigos" name="categoria" class="boton-menu boton-categoria" onclick="window.location.href='paginaPrincipal.php?id_categoria=1'"><i class="bi bi-hand-index-thumb"></i>Abrigos</button>
                        <li>
                        <li>
                        <button id="camisas" name="categoria" class="boton-menu boton-categoria" onclick="window.location.href='paginaPrincipal.php?id_categoria=3'"><i class="bi bi-hand-index-thumb"></i>Camisas</button>
                        <li>
                        <li>
                        <button id="pantalones" name="categoria" class="boton-menu boton-categoria" onclick="window.location.href='paginaPrincipal.php?id_categoria=6'"><i class="bi bi-hand-index-thumb"></i>Pantalones</button>
                        <li>
                        <li>
                        <button id="calzados" name="categoria" class="boton-menu boton-categoria" onclick="window.location.href='paginaPrincipal.php?id_categoria=2'"><i class="bi bi-hand-index-thumb"></i>Calzados</button>
                        <li>
                        <li>
                            <a class="boton-menu boton-carrito" href="./carrito.php">
                                <i class="bi bi-cart-fill"></i> Carrito <span id="numerito" class="numerito">
                                    <?php
                                        // Incluir el archivo agregar_al_carrito.php
                                        require 'logica/agregar_al_carrito.php';

                                        // Calcular la cantidad total de objetos en el carrito
                                        $cantidad_total = 0;
                                        if (isset($_SESSION['carrito'])) {
                                            foreach ($_SESSION['carrito'] as $producto) {
                                                $cantidad_total += $producto['cantidad'];
                                            }
                                        }
                                        echo $cantidad_total;
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <?php
                                $usuario = $_SESSION['username'];

                                if(!isset($usuario)){
                                    header("location: Index.php");
                                }
                                ?>
                                
                            <a href="logica/salir.php" class="boton-menu"> Salir </a>
                        </li>
                    </ul>
                </nav>
            <footer>
                <p class="texto-footer">© 2022 Clothes Coder</p>
            </footer>
        </aside>

        <! –Inicio del desglo del catalogo en el menu principal –>

        <main>
            <h2 class="titulo-principal" id="titulo-principal">
                <?php
                    // Obtener el ID de la categoría desde la URL
                    $id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : '';

                    // Mostrar el título de la categoría según el ID de la categoría
                    switch ($id_categoria) {
                        case '1':
                            echo 'Abrigos';
                            break;
                        case '2':
                            echo 'Calzados';
                            break;
                        case '3':
                            echo 'Camisas';
                            break;
                        case '6':
                            echo 'Pantalones';
                            break;
                        default:
                            echo 'Todos los productos';
                    }
                ?>
            </h2>

            <?php if (count($resultado) == 0): ?>
               <div class="contenedor-carrito">
                    <p id="mensaje-contenedor" class="carrito-vacio">No hay artículos disponibles para esta categoría.</p>
                </div>
            <?php else: ?>
                <div id="contenedor-productos" class="contenedor-productos">
                    <?php foreach ($resultado as $row):
                        $id = $row['id_producto'];
                        $image = "img/productos/" . $id . "/principal.jpg"; 
                    ?>
                    <div class="producto">
                        <?php if(!file_exists($image)) {
                            $image = "img/void-photo.jpg";
                        } ?>
                        <img class="producto-imagen" src="<?php echo $image; ?>">
                        <div class="producto-detalles">
                            <h3 class="producto-titulo"><?php echo $row['produc_nombre']?></h3>
                            <p class="producto-precio">$ <?php echo number_format($row['produc_precio'], 2, ',', '.');?></p>
                            <! –Falta que el boton agregar funcione –>
                            <button class="producto-agregar" data-id="<?php echo $id; ?>" data-titulo="<?php echo $row['produc_nombre']; ?>" data-precio="<?php echo $row['produc_precio']; ?>">Agregar</button>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            <?php endif;?>
        </main>
    </div>
    
    <!-- Agregar al carrito un articulo -->
    <script>
        // Obtener todos los botones "Agregar al carrito"
        var botonesAgregar = document.querySelectorAll('.producto-agregar');
        // Agregar un evento de clic a cada botón "Agregar al carrito"
        botonesAgregar.forEach(function(boton) {
            boton.addEventListener('click', function() {
                // Obtener los datos del producto desde los atributos "data-*" del botón
                var id = this.getAttribute('data-id');
                var titulo = this.getAttribute('data-titulo');
                var precio = this.getAttribute('data-precio');
                // Enviar una solicitud POST al archivo agregar_al_carrito.php para agregar el producto al carrito
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'logica/agregar_al_carrito.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200) {
                        // Actualizar la cantidad total en el elemento con id="numerito"
                        var numerito = document.querySelector('#numerito');
                        var cantidad_total = parseInt(numerito.textContent);
                        cantidad_total++;
                        numerito.textContent = cantidad_total;
                    }
                };
                xhr.send('id_producto=' + id + '&produc_nombre=' + titulo + '&produc_precio=' + precio);
            });
        });
    </script>

    <script src="./js/menu.js"></script>
    <script> src="./js/filtrar_pruduc.js"</script>

</body>

</html>