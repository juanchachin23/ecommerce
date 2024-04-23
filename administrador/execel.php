<?php
require 'conexion2.php';
$query = mysqli_query($con,"SELECT * FROM producto");
$docu="reportes.xls";
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename='.$docu);
header('Pagma: no-cache');
header('Expires: 0');
echo'<table border=1>';
echo'<tr>';
echo'<th colspan = 3>Reporte de detalle de productos<th>';
echo'</tr>';
echo'<tr><th>ID</th><th>NOMNRE</th> <th>cantidad</th> <th>precio</th></tr>';

while($row=mysqli_fetch_assoc($query)){
echo'<tr>';
echo'<td>'.$row['id_producto'] .'</td>';
echo'<td>'.$row['produc_nombre'] .'</td>';
echo'<td>'.$row['produc_precio'] .'</td>';
echo'<td>'.$row['produc_cantidad'] .'</td>';
echo'</tr>';
}
echo'</table>';



