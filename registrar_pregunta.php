<?php
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$cedula="'".$_REQUEST['cedula']."'";
$producto="'".$_REQUEST['producto']."'";
$pregunta="'".$_REQUEST['pregunta']."'";
date_default_timezone_set('America/Bogota');
$get_fecha=date("Y-m-d");
$get_fecha="'".$get_fecha."'";
$insert=$mysql->query("insert into preguntas_sobre_productos (fecha, cliente, producto, pregunta) values ($get_fecha, $cedula, $producto, $pregunta) ") or die ("problemas insert");
if($insert){
echo "insert";	
}
?>