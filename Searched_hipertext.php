<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");

if(isset($_REQUEST['lookingfor'])){
   $word= base64_decode(urldecode($_REQUEST['lookingfor']));
}

$get_list=$mysql->query("SELECT * FROM productos WHERE nombre LIKE '%$word%' or categoria LIKE '%$word%' or descripcion LIKE '%$word%'") or die ("problemas en la consulta");
$nombre_producto=[];
$imagen_producto=[];
$precio_producto=[];
$codigos_producto=[];
while($get_l=$get_list->fetch_array()){
	 $codigos_producto[]=$get_l['id'];
	 $nombre_producto[]= $get_l['nombre'];
	 $token = strtok($get_l['imagen'], "||");
	 $imagen_producto[]=$token;
	 $precio_producto[]= $get_l['valor'];
}


?>