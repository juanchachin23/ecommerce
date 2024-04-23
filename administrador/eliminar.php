<?php
if(!isset($_GET['codigo'])){
    header('Location: index.php?mensaje=error');
    exit();
}

include 'conexion.php';
$codigo= $_GET['codigo'];

$sentencias = $bd->prepare("DELETE FROM producto where id_producto = ?;");
$resultado = $sentencias->execute([$codigo]);

if ($resultado === TRUE) {
    header('Location: index.php?mensaje=eliminado');
} else {
    header('Location: index.php?mensaje=error');
    
}
?>