<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClothesShop</title>
    <link rel="stylesheet" href="./css/carrito.css">
    <style>

    </style>
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

// Obtener los datos del usuario desde la sesión
$email = $_SESSION['usu_correo'];
$username = $_SESSION['username'];
$address = isset($_SESSION['usu_direccion']) ? $_SESSION['usu_direccion'] : 'No disponible';

// Mostrar una tabla con los datos del usuario
echo '<table>';
echo '<tr><th>Email</th><th>Nombre de usuario</th><th>Dirección</th></tr>';
echo '<tr>';
echo '<td>' . $email . '</td>';
echo '<td>' . $username . '</td>';
echo '<td>' . $address . '</td>';
echo '</tr>';
echo '</table>';

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

    // Mostrar el total a pagar en grande
    echo '<p style="font-size:2rem;">Total a pagar: $' . number_format($total, 2) . '</p>';

    // Mostrar el número de WhatsApp de la compañía y la dirección de correo electrónico de PayPal
    echo '<hr><p>Envía el archivo <b>Compra.txt</b> que se ha descargado junto al <b>comprobante de la transferencia</b> a través de <b>WhatsApp al número +58 424662355</b> o por correo electrónico a fabialvaxbox22@gmail.com. En un rango de 6 horas <b>su compra será confirmada con un correo al email registrado</b> y todo lo necesario para proseguir con el envío de los productos. En caso de no poder concretarse la compra, el dinero será devuelto al comprador mediante Paypal en un lapso de 2 horas tras comunicar cualquier inconveniente.</p><hr>';

    // Mostrar el botón "Aceptar"
    echo '<button id="boton-aceptar" style="background-color: green; color: white; padding: 10px 20px; border-radius: 5px; border: none; cursor: pointer;">Aceptar</button>';

    // Agregar código JavaScript para descargar un archivo de texto con los datos de la tabla y el total
    // y actualizar las cantidades de los productos en la base de datos
    echo '<script>
        // Obtener el botón "Aceptar"
        var botonAceptar = document.querySelector("#boton-aceptar");
        // Agregar un evento de clic al botón "Aceptar"
        botonAceptar.addEventListener("click", function() {
            // Crear un arreglo con los datos de la tabla y el total
            var datos = [];
            datos.push("Email: ' . $email . '");
            datos.push("Nombre de usuario: ' . $username . '");
            datos.push("Dirección: ' . $address . '");
            datos.push("");
            datos.push("Productos en el carrito:");
            ';
            foreach ($_SESSION['carrito'] as $producto) {
                $subtotal = $producto['produc_precio'] * $producto['cantidad'];
                echo 'datos.push("' . $producto['produc_nombre'] . ': $' . number_format($subtotal, 2) . '");';
            }
            echo '
            datos.push("");
            datos.push("Total a pagar: $' . number_format($total, 2) . '");

            // Crear un objeto Blob con los datos en formato de texto
            var blob = new Blob([datos.join("\\r\\n")], {type: "text/plain;charset=utf-8"});

            // Crear un elemento <a> temporal y hacer clic en él para descargar el archivo
            var enlaceDescarga = document.createElement("a");
            enlaceDescarga.href = URL.createObjectURL(blob);
            enlaceDescarga.download = "compra.txt";
            document.body.appendChild(enlaceDescarga);
            enlaceDescarga.click();
            document.body.removeChild(enlaceDescarga);

            // Enviar una solicitud AJAX para actualizar las cantidades de los productos en la base de datos
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "logica/actualizar_cantidades.php");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("carrito=" + JSON.stringify(' . json_encode($_SESSION['carrito']) . '));

            // Limpiar el carrito del usuario
            var xhr2 = new XMLHttpRequest();
            xhr2.open("POST", "logica/limpiar_carrito.php");
            xhr2.send();

            // Redirect to carrito.php
            window.location.href = "carrito.php";
        });
    </script>';
}
?>

        </main>
    </div>

</body>
</html>