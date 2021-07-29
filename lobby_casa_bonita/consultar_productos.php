<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
$nombre=$_REQUEST['producto'];
$registros=$mysql->query("select *  from productos where (nombre like '%$nombre%' or categoria like '%$nombre%')") or die ("problemas en la consulta");
while($reg=$registros->fetch_array()){
	$datos[]=$reg;
}	
$cad=json_encode($datos);
echo $cad;		
?>