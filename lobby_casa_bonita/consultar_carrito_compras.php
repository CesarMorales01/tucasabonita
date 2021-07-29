<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
$cliente=$_REQUEST['cliente'];
$registros=$mysql->query("select *  from carrito_compras where cliente=$cliente") or die ("problemas en la consulta");
while($reg=$registros->fetch_array()){
	$datos[]=$reg;
}	
$cad=json_encode($datos);
echo $cad;		
?>