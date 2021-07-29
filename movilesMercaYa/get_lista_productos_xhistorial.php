<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
$compra_n=$_REQUEST['compra_n'];
$cliente=$_REQUEST['cliente'];
$registros=$mysql->query("select * from lista_productos_comprados where compra_n=$compra_n and cliente=$cliente") or die ("problemas en la consulta");
while($reg=$registros->fetch_array()){
  $json['productos'][]=$reg;
}	
echo json_encode($json,JSON_UNESCAPED_UNICODE);
?>