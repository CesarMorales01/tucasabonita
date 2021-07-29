<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
if(isset($_REQUEST['cedula'])){
$cedula=$_REQUEST['cedula'];
$check_0_art=true;
$cargar_carrito=$mysql->query("select * from carrito_compras_casabonita where cliente=$cedula") or die ("problemas en la consulta cargar carrito");
					while($cargar_c=$cargar_carrito->fetch_array()){
						$check_0_art=false;
					 $carrito['check'][]="1";	
					 $carrito['cods'][]=$cargar_c['cod'];
					 $carrito['productos'][]=$cargar_c['producto'];
					 $carrito['imagenes'][]=$cargar_c['imagen'];
					 $carrito['valores'][]=$cargar_c['valor'];
					 $carrito['cantidades'][]=$cargar_c['cantidad'];
					}
	if($check_0_art){
	$carrito['check'][]="0";
	}
	echo json_encode($carrito,JSON_FORCE_OBJECT);	
}				
?>				