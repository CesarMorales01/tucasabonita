<?php
include("datos.php");
$json=array();
if(isset($_REQUEST['imei'])){
	$imei1=$_REQUEST['imei'];
	$nombre1=$_REQUEST['nombre'];
	
	$nombre="'".$nombre1."'";
	$imei="'".$imei1."'";

	$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		if ($mysql->connect_error)
		 die("Problemas con la conexión a la base de datos");
	$consultar=$mysql->query("select * from asesores where imei=$imei and nombre=$nombre") or die ("problemas en la consulta");
	if($get_datos=mysqli_fetch_array($consultar)){
		$datos['imei']=$get_datos['imei'];
		$datos['nombre']=$get_datos['nombre'];
		$json['datos'][]=$datos;
		echo json_encode($json);
		$mysql->close();
		
	}else{
		$mysql->close();
		echo "conecta pero no hay datos";
		}
 }
  else{
	echo " no conecta";
	
}




