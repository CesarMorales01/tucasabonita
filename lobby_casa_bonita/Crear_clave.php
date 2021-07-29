<?php
include("datos.php");
$json=array();
if(isset($_REQUEST['cedula'])){
$cedula=$_REQUEST['cedula'];

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
    if ($mysql->connect_error)
     die("Problemas con la conexión a la base de datos");

$consultar=$mysql->query("select * from crear_clave where cedula=$cedula") or die ("problemas en la consulta");
if($get_datos=mysqli_fetch_array($consultar)){
	$datos['nombre']=$get_datos['nombre'];
	$datos['cedula']=$get_datos['cedula'];
	$datos['lugarexp']=$get_datos['lugarexp'];
	$datos['fechaexp']=$get_datos['fechaexp'];
	$json['datos'][]=$datos;
	echo json_encode($json);
	$mysql->close();
	
}else{
	$datos['nombre']='no registra';
	$datos['cedula']='no registra';
	$datos['lugarexp']='no registra';
	$datos['fechaexp']='no registra';
	$json['datos'][]=$datos;
	echo json_encode($json);
	$mysql->close();
}
}else{
	$datos['nombre']='no conecta';
	$datos['cedula']='no conecta';
	$datos['lugarexp']='no conecta';
	$datos['fechaexp']='no conecta';
	$json['datos'][]=$datos;
	echo json_encode($json);
	

	
}







								  

