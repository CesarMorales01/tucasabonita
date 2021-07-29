<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$cedula=$_REQUEST['cedula'];
$cedula="'".$cedula."'";
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
$registros=$mysql->query("SELECT * from clientes where cedula=$cedula") or die ("problemas en la consulta");
if($get_datos=mysqli_fetch_array($registros)){
    $nombre=$get_datos['nombre'];
	$direccion=$get_datos['direccion'];
    $telefonos=$get_datos['telefono'];
}
$valorprestamo="";
$periodicidad="";
if($nombre!=""){
    $reg=$mysql->query("SELECT * from prestamos_historial where cedula=$cedula ORDER BY fecha_prest DESC");
     if($get_histo=mysqli_fetch_array($reg)){
        $valorprestamo=$get_histo['valorprestamo'];
         $periodicidad=$get_histo['periodicidad'];
     }
}

echo "{
    \"nombre\":\"$nombre\",
    \"direccion\":\"$direccion\",
    \"tel_fijo\":\"$telefonos\",
    \"valorprestamo\":\"$valorprestamo\",
    \"periodicidad\":\"$periodicidad\"
  }";

$mysql->close();
?>