<?php
header('Content-type: text/html; charset=utf-8');include("datos.php");
$cedula=$_REQUEST['cedula'];
$usuario=$_REQUEST['usuario'];
$clave=$_REQUEST['clave'];

$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas al conectar");
$conexion->query("SET NAMES 'utf8'");

$actualizar_datos="update crear_clave set usuario='$usuario', clave='$clave' where cedula='$cedula'";

$query_actualizar=mysqli_query($conexion,$actualizar_datos) or die ("problemas al actualizar");	;

if($query_actualizar){
	
   
			$consulta="SELECT * FROM crear_clave WHERE cedula = '{$cedula}'";
			$resultado=mysqli_query($conexion,$consulta);
	
	if($get_datos=mysqli_fetch_array($resultado)){
		$datos['cedula']=$get_datos['cedula'];
		$datos['usuario']=$get_datos['usuario'];
		$datos['clave']=$get_datos['clave'];
		$json['datos'][]=$datos;
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
		mysqli_close($conexion);
	

	}else{
	echo " no registra";
    }
}    
   
?>