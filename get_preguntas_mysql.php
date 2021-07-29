<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
if(isset($_REQUEST['producto'])){
$producto=$_REQUEST['producto'];
$cargar=$mysql->query("select * from preguntas_sobre_productos where producto=$producto order by fecha desc") or die ("problemas en la consulta ");
					while($cargar_c=$cargar->fetch_array()){
					 $array['fecha'][]=$cargar_c['fecha'];
					 $array['cliente'][]=$cargar_c['cliente'];
					 $array['producto'][]=$cargar_c['producto'];
					 $array['pregunta'][]=$cargar_c['pregunta'];
					 $array['respuesta'][]=$cargar_c['respuesta'];
					}
	echo json_encode($array,JSON_FORCE_OBJECT);	
}				
?>	