<?php 
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$correo="'".$_REQUEST['correo']."'";
$contraseña="'".$_REQUEST['contrasena']."'";
$consultar=$mysql->query("SELECT * FROM crear_clave where cedula=$correo and clave=$contraseña") or die ("problemas en consulta");
$android=$_REQUEST['android_menor'];
if($android=="menor"){
		if($get=$consultar->fetch_array()){
		 $json['cliente'][]=$get;
		}
	   echo json_encode($json,JSON_UNESCAPED_UNICODE);
}else{
		if($get=$consultar->fetch_array()){	
		echo $get['cedula'];
		}else{
			echo 'incorrecta';
		}	
}	
 ?>  