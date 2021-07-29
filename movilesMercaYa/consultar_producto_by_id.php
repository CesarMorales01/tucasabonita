<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
$id=$_REQUEST['id'];
$registros=$mysql->query("select *  from productos where id=$id") or die ("problemas en la consulta");
while($reg=$registros->fetch_array()){
$json['productos'][]=$reg;
}	
echo json_encode($json,JSON_UNESCAPED_UNICODE);		
?>