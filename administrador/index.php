<?php include 'header.php'?>

<?php
include_once 'conexion.php';
$sentencias = $bd -> query("select * from producto");
$productos = $sentencias->fetchAll(PDO::FETCH_OBJ);
//print_r($producto)
?>
<div class="container mt-5">
    <!---inicio de la alerta---->
    <?php
    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
    ?>

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> ingrese todos los campos.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>


<?php
    if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado'){
    ?>
    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Registrado!</strong> se agregaron los datos.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
?>






<?php 

 if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){

?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">

<strong>Error!</strong> Vuelve a intentar.

<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
        
<?php 
 }
 ?>   
<?php 
 if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Cambiado!</strong> Los datos fueron actualizados.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php 
  }
?> 

<?php 
 if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
<strong>Eliminado!</strong> Los datos fueron borrados.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php 
   }
?> 




    <!---final de la alerta---->
   <div class=" row justify-content-center ">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                articulo
                </div>
                <div class="table">
                    <div class="table-responsive">
                        <table class="table aling-middle">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">cantidad</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">categoria</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($productos as $dato){

                               
                                ?>
                                <tr >
                                    <td scope="row"> <?php echo $dato->id_producto;?></td>
                                    <td> <?php echo $dato->produc_nombre;?></td>
                                    <td><?php echo $dato->produc_precio;?></td>
                                    <td><?php echo $dato->produc_cantidad;?></td>
                                    <td><?php echo $dato->produc_descripcion;?></td>
                                    <td><?php echo $dato->produc_id_categoria;?></td>
                                    <td><?php echo $dato->produc_proveedor;?></td>
                                    <td ><a class="text-succes" href="editar.php?codigo=<?php echo $dato->id_producto;?>"><i class="bi bi-pencil-square"></i></a></td>
                                    <td ><a class="text-danger" href="eliminar.php?codigo=<?php echo $dato->id_producto;?>"><i class="bi bi-trash"></i></a></td>
                                    
                                </tr>
                                <?php
                                 }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>



        <div class="col-4">
        <div class="card">
            <div class="card-header">
                Ingresar datos:
            </div>
        </div>
        <form class="p-4" method="POST" action="registrar.php">
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="txtNombre" autofocus required>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" class="form-control" name="txtPrecio" autofocus required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cantidad</label>
                <input type="number" class="form-control" name="txtCantidad" autofocus required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input type="text" class="form-control" name="txtDescripcion" autofocus required>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-control" name="txtCategoria" id="lang" required>
                <option value="1">Abrigo</option>
                <option value="2">Calzado</option>
                <option value="3">Camisa</option>
                <option value="4">Peluche</option>
                <option value="5">Estupefacientes</option>
                <option value="6">Pantalón</option>   
            </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Proveedor</label>
                <select class="form-control" name="txtProveedor" id="lang" required>
                <option value="1">Adidas</option>
                <option value="2">Converse</option>
                <option value="3">Hasbro</option>
                <option value="4">Nike</option>
                <option value="5">Puma</option>
                <option value="6">Sneakers</option>
                <option value="7">Vans</option>
                <option value="8">Yonson</option>
            </select>
            </div>
            <div class="mb-3">
            <label class="form-label">Activacion</label>
            <select class="form-control" name="txtAct" id="lang" required>
                <option value="1">Activado</option>
                <option value="0">Desactivado</option>
                
            </select>
            </div>
            <div class="d-grid">
                <label class="form-label">registrar</label>
                <input type="hidden" name="oculto" value="1">
                <input type="submit" class="btn btn-primary" value="Registrar">
            </div>
            
        </form>
        <button class="btn btn-outline-secondary">  
        <a href="execel.php" bg='' target="_blank">reporte</a>
        </button>
       
        <button class="btn btn-outline-dark"><a href="../Index.php">volver</a></button>

        </div>
   
    </div>
</div>


<?php include 'footer.php'?>