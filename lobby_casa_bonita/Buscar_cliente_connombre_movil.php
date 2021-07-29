<?php

header('Content-type: text/html; charset=utf-8');

include("datos.php");

$nombre=$_REQUEST['nombre'];
$asesor1=$_REQUEST['asesor'];
$asesor="'".$asesor1."'";

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

if ($mysql->connect_error) die ("Problemas con la conexión a la base de datos");

$mysql->set_charset("utf8");

$get_carte=$mysql->query("select unable from asesores where imei=$asesor") or die ("problemas en la consulta de asesor");

if($get_carteras=$get_carte->fetch_array()){
   $get_cartes=$get_carteras['unable'];	
}	

$tok = strtok($get_cartes, ",");
$n=0;
$nombres=[];
while ($tok !== false) {
   $n++;
  $nombres[$n]= "$tok";
   $tok = strtok(",");
}
$size_array= count($nombres, COUNT_RECURSIVE);

for($x=1;$x<=$size_array;$x++){
   $cobro="'".trim($nombres[$x])."'";
   $registros=$mysql->query("select nombre, cedula from clientes where (nombre like '%$nombre%' or direccion like '%$nombre%') and Cobro=$cobro") or die ("problemas en la consulta");

	while($reg=$registros->fetch_array()){
      $json['clientes'][]=$reg;
	}

}
	
echo json_encode($json,JSON_UNESCAPED_UNICODE);	

$mysql->close();

?>