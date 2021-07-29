<?php
include("datos.php");
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$id=$_REQUEST['id'];
if($id==""){
    $producto1=$_REQUEST['producto'];
	$producto="'".$producto1."'";
	$precio="'".$_REQUEST['precio']."'";
	$descripcion="'".$_REQUEST['descripcion']."'";
	$proveedor="'".$_REQUEST['proveedor']."'";
	$insert="INSERT INTO cotizaciones(producto, descripcion, precio, proveedor) VALUES ($producto, $descripcion, $precio, $proveedor)";
	$resultado_insert=mysqli_query($conexion,$insert) or die ("Problems to insert!");
	if($resultado_insert){
		header("Location:  $url/Form_lista_cotizacion.php?producto=$producto1");
	}		
}else{
	$del="delete from cotizaciones where id=$id";
	$borrar=mysqli_query($conexion,$del) or die ("Problems to delete!");
	if($borrar){
		header("Location:  $url/Form_lista_cotizacion.php");
	}
}
mysqli_close($conexion);
?>