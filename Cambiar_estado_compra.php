<?php
include("datos.php");
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
$id=$_REQUEST['id'];
$estado=$_REQUEST['estado'];
$estadoLetra;
if($estado=="0"){
    $estadoLetra="Recibida";
} 

if($estado=="1"){
    $estadoLetra="Preparando";
}

if($estado=="2"){
    $estadoLetra="En camino";
}
if($estado=="3"){
    $estadoLetra="Entregada";
}
$estadoLetra="'".$estadoLetra."'";
$update=$mysql->query("update lista_compras set estado=$estadoLetra where id=$id") or die ("problems update");
if($update){
echo "actualizado";
}
$mysql->close();
?>