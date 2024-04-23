<?php

// Incluir el archivo de conexión a la base de datos
require 'conexion.php';

// Obtener los datos del carrito desde el parámetro POST
$carrito = json_decode($_POST['carrito'], true);

// Recorrer los productos en el carrito
foreach ($carrito as $producto) {
    // Obtener el nombre y la cantidad del producto
    $produc_nombre = $producto['produc_nombre'];
    $cantidad = $producto['cantidad'];

    // Actualizar la cantidad del producto en la base de datos
    $query = "UPDATE producto SET produc_cantidad = produc_cantidad - $cantidad WHERE produc_nombre = '$produc_nombre'";
    mysqli_query($conexion, $query);
}

?>
