<?php
include("datos.php");
$json=array();
if(isset($_REQUEST['clave'])){
	$cedula=$_REQUEST['cedula'];
	$clave1=$_REQUEST['clave'];
	
	$clave="'".$clave1."'";

	$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		if ($mysql->connect_error)
		 die("Problemas con la conexión a la base de datos");

	$consultar=$mysql->query("select cedula, usuario, clave from crear_clave where cedula=$cedula and clave=$clave") or die ("problemas en la consulta");
	if($get_datos=mysqli_fetch_array($consultar)){
		$datos['cedula']=$get_datos['cedula'];
		$datos['usuario']=$get_datos['usuario'];
		$datos['clave']=$get_datos['clave'];
		$json['datos'][]=$datos;
		echo json_encode($json);
		$mysql->close();
		
	}else{
		$datos['clave']=$get_datos['clave'];
		$json['datos'][]=$datos;
		echo json_encode($json);
		$mysql->close();
		echo "conecta pero no hay datos";
		}
 }
  else{
	echo " no conecta";
	
}







								  

