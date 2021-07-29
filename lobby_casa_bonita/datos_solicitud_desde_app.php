<?php

header('Content-type: text/html; charset=utf-8');

include("datos.php");



$cedula=$_REQUEST['cedula'];
$cedula="'".$cedula."'";

$json=array();



$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

    if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

$mysql->set_charset("utf8");

$registros=$mysql->query("SELECT * from prestamos_historial where cedula=$cedula ORDER BY fecha_prest DESC") or die ("problemas en la consulta");

if($get_datos=mysqli_fetch_array($registros)){

	$datos['valorprestamo']=$get_datos['valorprestamo'];

	$datos['periodicidad']=$get_datos['periodicidad'];

} else{

	$get_info["nombre"]='No se encuentran datos';

	$get_info["cedula"]='No se encuentran datos';

	$json['datos'][]=$get_info;

	echo json_encode($json);

}

$get_max=$mysql->query("SELECT MAX(valorprestamo) from prestamos_historial where cedula=$cedula") or die ("problemas en la consulta");

if($get_date=mysqli_fetch_array($get_max)){
$datos['max_prest']= $get_date['MAX(valorprestamo)'];
}

$json['datos'][]=$datos;
echo json_encode($json,JSON_UNESCAPED_UNICODE);	

$mysql->close();



?>
