<?php 
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");

if($_REQUEST['correo']){
$correo="'".$_REQUEST['correo']."'";
$consultar=$mysql->query("SELECT * FROM crear_clave where cedula=$correo") or die ("problemas en consulta");
	if($get=$consultar->fetch_array()){	
        $json['cliente'][]=$get;
    }   
}	
echo json_encode($json,JSON_UNESCAPED_UNICODE);	
 ?>  