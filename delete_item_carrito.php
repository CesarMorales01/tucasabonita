<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
if(isset($_REQUEST['cod'])){
 $cod=$_REQUEST['cod'];
 $cedula=$_REQUEST['cedula'];
	$delete_carrito=$mysql->query("delete from carrito_compras_casabonita where cliente=$cedula and cod=$cod") or die ("problemas deleting item from carrito");
	if($mysql->affected_rows>0){
		echo "borrado";
	}
}				
?>	