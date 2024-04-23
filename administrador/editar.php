<?php
include 'header.php';
?>

<?php
if(!isset($_GET['codigo'])){
    header('Location: index.php?menseje=error');
    exit();
}

include_once 'conexion.php';
$codigo = $_GET['codigo'];

$sentencias = $bd->prepare("select * from producto where id_producto=?;"); 
$sentencias -> execute([$codigo]);
$productos = $sentencias->fetch(PDO::FETCH_OBJ);

?>
<div class="row justify-content-center">
<div class="col-4">
        <div class="card">
            <div class="card-header">
                ingresar datos:
            </div>
        </div>
        <form class="p-4" method="POST" action="editarProceso.php">
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" class="form-control" required name="txtNombre" autofocus
                value="<?php echo $productos->produc_nombre;?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" class="form-control" required name="txtPrecio" autofocus
                value="<?php echo $productos->produc_precio?>">
            </div>
            <div class="mb-3">
                <label class="form-label">cantidad</label>
                <input type="number" class="form-control" required name="txtCantidad" autofocus
                value="<?php echo $productos->produc_cantidad;?>">
            </div>
           
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input type="text" class="form-control" required name="txtDescripcion" autofocus
                value="<?php echo $productos->produc_descripcion;?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-control"  value="<?php echo $productos->produc_id_categoria;?>" name="txtCategoria" id="lang">
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
                <select class="form-control" value="<?php echo $productos->produc_proveedor;?>" name="txtProveedor" id="lang">
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

        
            <div class="d-grid">
                <input type="hidden" name="codigo" value="value=<?php echo $productos->id_producto;?>">
                <input type="submit" class="btn btn-primary" value="Editar" autofocus>
            </div>
            
        </form>

        </div>
        </div>
<?php
include 'footer.php'
?>