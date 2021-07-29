<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
if(isset($_REQUEST['producto'])){
$producto=$_REQUEST['producto'];
$cliente=$_REQUEST['cedula'];
$cantidad=$_REQUEST['cantidad'];
$cargar=$mysql->query("update carrito_compras_casabonita set cantidad=$cantidad where cliente=$cliente and cod=$producto") or die ("problemas updating");
	if($cargar){
		echo 'editado';
	}
}				
?>	