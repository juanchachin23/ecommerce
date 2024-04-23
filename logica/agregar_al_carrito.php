<?php
// Iniciar sesión para acceder a las variables de sesión
session_start();

// Verificar si se recibieron los datos del producto a través de una solicitud POST
if (isset($_POST['id_producto']) && isset($_POST['produc_nombre']) && isset($_POST['produc_precio'])) {
    // Obtener los datos del producto desde la solicitud POST
    $id = $_POST['id_producto'];
    $titulo = $_POST['produc_nombre'];
    $precio = $_POST['produc_precio'];

    // Verificar si el carrito ya existe en la variable de sesión
    if (isset($_SESSION['carrito'])) {
        // El carrito ya existe, buscar el producto en el carrito
        $producto_encontrado = false;
        foreach ($_SESSION['carrito'] as &$producto) {
            if ($producto['id_producto'] == $id) {
                // El producto ya está en el carrito, aumentar su cantidad en 1
                $producto['cantidad']++;
                $producto_encontrado = true;
                break;
            }
        }
        if (!$producto_encontrado) {
            // El producto no está en el carrito, agregarlo al carrito con cantidad 1
            $_SESSION['carrito'][] = array('id_producto' => $id, 'produc_nombre' => $titulo, 'produc_precio' => $precio, 'cantidad' => 1);
        }
    } else {
        // El carrito no existe, crear un nuevo carrito y agregar el producto con cantidad 1
        $_SESSION['carrito'] = array(array('id_producto' => $id, 'produc_nombre' => $titulo, 'produc_precio' => $precio, 'cantidad' => 1));
    }

    // Enviar una respuesta indicando que el producto fue agregado al carrito correctamente
    echo 'Producto agregado al carrito';
} elseif (isset($_POST['id_producto'])) {
    // Obtener el ID del producto desde la solicitud POST
    $id = $_POST['id_producto'];

    // Verificar si el carrito ya existe en la variable de sesión
    if (isset($_SESSION['carrito'])) {
        // El carrito ya existe, buscar el producto en el carrito
        foreach ($_SESSION['carrito'] as $indice => &$producto) {
            if ($producto['id_producto'] == $id) {
                // El producto está en el carrito, disminuir su cantidad en 1
                $producto['cantidad']--;
                // Si la cantidad es menor a 0, setearla en 0
                if ($producto['cantidad'] < 0) {
                    $producto['cantidad'] = 0;
                }
                // Si la cantidad es igual a 0, eliminar el producto del carrito
                if ($producto['cantidad'] == 0) {
                    unset($_SESSION['carrito'][$indice]);
                }
                break;
            }
        }
    }

    // Enviar una respuesta indicando que el producto fue eliminado del carrito correctamente
    echo 'Producto eliminado del carrito';
}
?>


