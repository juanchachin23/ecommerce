<?php
print_r($_POST);
if(!isset($_POST['codigo'])){
    header('Location: index.php?mensaje=error');
}

include 'conexion.php';
$codigo = $_POST['codigo'];
$nombre = $_POST['txtNombre'];
$precio = $_POST['txtPrecio'];
$cantidad = $_POST['txtCantidad'];
$descripcion = $_POST['txtDescripcion'];
$categoria = $_POST['txtCategoria'];
$proveedor = $_POST['txtProveedor'];
$act = $_POST['txtAct'];

$sentencias = $bd-> prepare("UPDATE producto SET produc_nombre = ?, produc_precio = ?, produc_cantidad = ?, produc_descripcion = ?, produc_id_categoria = ?, produc_proveedor = ?  where id_producto = ?;");

$resultado = $sentencias->execute([$nombre, $precio, $cantidad, $descripcion, $categoria, $proveedor, $codigo]);


if ($resultado === TRUE) {
    header('Location: index.php?mensaje=editado');
} else {
    header('Location: index.php?mensaje=error');
    exit();
}
?>

