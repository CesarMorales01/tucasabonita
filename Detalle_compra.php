<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css" type="text/css">
  <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!-- Este boostrap es necesario para cargar la barra de acciones -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="funciones.js"></script>
 </head>  
<body>    
<title>Detalle compra</title>
<br>
<br>
<br>
<div class="container"> 
<?php
include("datos.php");
$compra_n=$_REQUEST['compra_n'];
echo '<h1 align="center">Compra numero ';
echo $compra_n;
echo '</h1>';
echo '<br>';
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$cedula=$_REQUEST['cedula'];
$get=$mysql->query("select * from lista_productos_comprados where cliente=$cedula and compra_n=$compra_n") or die ("problemas al consultar");
$total;
echo '<table class="table">';
echo '<tr><th>Cliente</th><th>Producto</th><th>Cantidad</th><th>Precio unitario</th><th>Subtotal</th></tr>';	
while($nombres=$get->fetch_array()){
echo '<tr class="table-success" >';
echo '<td>';
$cedula=$nombres['cliente'];
$getCliente=$mysql->query("select * from clientes where cedula=$cedula") or die ("problemas al consultar cliente");
if($info=$getCliente->fetch_array()){
    echo  $info['nombre'];
    echo " ";
    echo  $info['apellidos'];
}
echo '</td>';
echo '<td>';
    echo '<a href="FormIngresarProductos.php?id=';
    echo $nombres['codigo'];
    echo '">';
    echo  $nombres['producto'];
    echo '<br>';
    echo  $nombres['descripcion'];
    echo '</a>';

echo '</td>';
echo '<td>';
echo  $nombres['cantidad'];
echo '</td>';
echo '<td>';
echo number_format($nombres['precio'],2,",",".");
echo '</td>';  
echo '<td>';
$precio = $nombres['precio'];
$cant= $nombres['cantidad'];
$subtotal = $precio*$cant;
$total=$total+$subtotal;
echo number_format($subtotal,2,",",".");
echo '</td>'; 
echo '</tr>';
}
echo '<tr class="table-danger">';
echo '<td>';
echo "Total compra";
echo '</td>'; 
echo '<td>';
echo number_format($total,2,",",".");
echo '</td>';
echo '</tr>';
echo '</table>';
?>
</div>
<script>

</script>
</body>
</html>