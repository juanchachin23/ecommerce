<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClothesShop</title>
    <link rel="stylesheet" href="./css/carrito.css">
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
                <ul>
                    <li>
                        <a class="boton-menu boton-volver" href="./paginaPrincipal.php">
                            <i class="bi bi-arrow-return-left"></i> Seguir comprando
                        </a>
                    </li>
                    <li>
                        <a class="boton-menu boton-carrito active" href="./carrito.php">
                            <i class="bi bi-cart-fill"></i> Carrito
                        </a>
                    </li>
                    <!-- Con esto terminariamos el pedido y nos contactariamos con la tienda directamente -->
                    <li>
                        <a class="boton-menu boton-volver" href="./confirmarCompra.php">
                            <i class="bi bi-arrow-return-left"></i> Confirmar compra
                        </a>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer">© 2022 Clothes Coder</p>
            </footer>
        </aside>

        <main>
            <h2 class="titulo-principal">Carrito</h2>
            <div class="contenedor-carrito">

                <?php

                // Incluir el archivo agregar_al_carrito.php
                require 'logica/agregar_al_carrito.php';

                // Verificar si el carrito está vacío
                if (empty($_SESSION['carrito'])) {
                    // Mostrar mensaje de carrito vacío
                    echo '<p id="carrito-vacio" class="carrito-vacio">Tu carrito está vacío. <i class="bi bi-emoji-frown"></i></p>';
                } else {
                    // Mostrar los productos en el carrito
                    echo '<table>';
                    echo '<tr><th>Titulo</th><th>Precio</th><th>Cantidad</th><th></th></tr>';
                    foreach ($_SESSION['carrito'] as $producto) {
                        echo '<tr>';
                        echo '<td>' . $producto['produc_nombre'] . '</td>';
                        echo '<td>$' . $producto['produc_precio'] . '</td>';
                        echo '<td>' . $producto['cantidad'] . '</td>';
                        echo '<td><button class="producto-eliminar" data-id="' . $producto['id_producto'] . '">Eliminar</button></td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                ?>

            </div>
        </main>
    </div>

    <script>
        // Obtener todos los botones "Eliminar"
        var botonesEliminar = document.querySelectorAll('.producto-eliminar');
        // Agregar un evento de clic a cada botón "Eliminar"
        botonesEliminar.forEach(function(boton) {
            boton.addEventListener('click', function() {
                // Obtener el ID del producto desde el atributo "data-id" del botón
                var id = this.getAttribute('data-id');
                // Enviar una solicitud POST al archivo agregar_al_carrito.php para eliminar el producto del carrito
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'logica/agregar_al_carrito.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function() {
                    if (this.status == 200) {
                        // Recargar la página para actualizar el carrito
                        location.reload();
                    }
                };
                xhr.send('id_producto=' + id);
            });
        });
    </script>

</body>
</html>


