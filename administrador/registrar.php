<?php
if(empty($_POST["oculto"])||empty($_POST["txtNombre"])||empty($_POST["txtPrecio"])||empty($_POST["txtCantidad"])||empty($_POST["txtDescripcion"])||empty($_POST["txtCategoria"])||empty($_POST["txtProveedor"]) ||empty($_POST["txtAct"]))
{
        header('Location: index.php?mensaje=falta');
        exit();
}
    

include_once 'conexion.php';
$nombre = $_POST["txtNombre"];
$precio = $_POST["txtPrecio"];
$cantidad = $_POST["txtCantidad"];
$descripcion = $_POST["txtDescripcion"];
$categoria = $_POST["txtCategoria"];
$proveedor = $_POST["txtProveedor"];
$act = $_POST["txtAct"];

$sentencias = $bd->prepare("INSERT INTO producto(produc_nombre,produc_precio,produc_cantidad,produc_descripcion,produc_id_categoria,produc_proveedor,produc_activo) VALUES (?,?,?,?,?,?,?)");
$resultado = $sentencias->execute([$nombre,$precio,$cantidad,$descripcion,$categoria,$proveedor,$act]);

if($resultado === TRUE){
    header("Location:index.php?mensaje=registrado");
}else{
    header("Location:index.php?mensaje=ERROR");
    exit();
}
?>