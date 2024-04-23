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
                        <a class="boton-menu boton-volver" href="./carrito.php">
                            <i class="bi bi-arrow-return-left"></i> Carrito
                        </a>
                    </li>
                    <!-- Con esto terminariamos el pedido y nos contactariamos con la tienda directamente -->
                    <li>
                        <a class="boton-menu boton-carrito active" href="./confirmarCompra.php">
                            <i class="bi bi-cart-fill"></i> Confirmar compra
                        </a>
                    </li>
                </ul>
            </nav>
            <footer>
                <p class="texto-footer">© 2022 Clothes Coder</p>
            </footer>
        </aside>

        <main>
            <h2 class="titulo-principal">Confirmar Compra</h2>

            <?php

            // Incluir el archivo agregar_al_carrito.php
            require 'logica/agregar_al_carrito.php';

            // Verificar si el carrito está vacío
            if (empty($_SESSION['carrito'])) {
                // Mostrar mensaje de carrito vacío
                echo '<p id="carrito-vacio" class="carrito-vacio">Tu carrito está vacío. No hay nada que confirmar. 😔</p>';
            } else {
                // Mostrar los productos en el carrito
                echo '<table>';
                echo '<tr><th>Titulo</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr>';
                $total = 0;
                foreach ($_SESSION['carrito'] as $producto) {
                    $subtotal = $producto['produc_precio'] * $producto['cantidad'];
                    $total += $subtotal;
                    echo '<tr>';
                    echo '<td>' . $producto['produc_nombre'] . '</td>';
                    echo '<td>$' . $producto['produc_precio'] . '</td>';
                    echo '<td>' . $producto['cantidad'] . '</td>';
                    echo '<td>$' . number_format($subtotal, 2) . '</td>';
                    echo '</tr>';
                }
                echo '<tr><td colspan="3">Total:</td><td>$' . number_format($total, 2) . '</td></tr>';
                echo '</table>';

                // Mostrar el botón "Completar compra"
                echo '<button id="completar-compra">Completar compra</button>';
            }
            ?>

        </main>
    </div>

    <!-- Agregar un diálogo de confirmación -->
    <div id="dialogo-confirmacion" style="display:none;">
        ¿Estás seguro de que quieres completar la compra?
        <br><br>
        <button id="boton-si">Sí</button> 
        <button id="boton-no">No</button> 
    </div>

    <!-- Agregar código JavaScript para mostrar el diálogo de confirmación -->
    <script>
        // Obtener el botón "Completar compra"
        var botonCompletarCompra = document.querySelector('#completar-compra');
        // Agregar un evento de clic al botón "Completar compra"
        botonCompletarCompra.addEventListener('click', function() {
            // Mostrar el diálogo de confirmación
            var dialogoConfirmacion = document.querySelector('#dialogo-confirmacion');
            dialogoConfirmacion.style.display = 'block';
        });

        // Obtener los botones "Sí" y "No"
        var botonSi = document.querySelector('#boton-si');
        var botonNo = document.querySelector('#boton-no');
        // Agregar un evento de clic al botón "Sí"
        botonSi.addEventListener('click', function() {
            // Redirigir a la página finalizarCompra.php
            location.href = './finalizarCompra.php';
        });
        // Agregar un evento de clic al botón "No"
        botonNo.addEventListener('click', function() {
            // Ocultar el diálogo de confirmación
            var dialogoConfirmacion = document.querySelector('#dialogo-confirmacion');
            dialogoConfirmacion.style.display = 'none';
        });
    </script>

</body>
</html>