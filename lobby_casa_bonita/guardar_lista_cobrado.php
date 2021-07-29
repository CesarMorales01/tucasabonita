<?php
include("datos.php");
date_default_timezone_set('America/Bogota');

if(isset($_REQUEST['fecha'])){
$fecha=$_REQUEST['fecha'];
}else {	
$fecha=date("Y-m-d");
}
$cobro=$_REQUEST['cobro'];
$total_cobrado=$_REQUEST['total_cobrado'];
$total_egresos=$_REQUEST['total_egresos'];
$total_neto=$_REQUEST['total_neto'];
$lista=$_REQUEST['lista'];
$imei=$_REQUEST['imei'];

$fecha="'".$fecha."'";
$cobro="'".$cobro."'";
$total_cobrado="'".$total_cobrado."'";
$total_egresos="'".$total_egresos."'";
$total_neto="'".$total_neto."'";
$lista="'".$lista."'";
$imei="'".$imei."'";

$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	

$buscar_imei="SELECT nombre FROM asesores where imei=$imei";
$get_asesor=mysqli_query($conexion,$buscar_imei);
if($get_asesor0=$get_asesor->fetch_array()){
$get_nombre_asesor=$get_asesor0['nombre'];
}
$asesor="'".$get_nombre_asesor."'";
    
$insert="INSERT INTO lista_cobrado(fecha, cobro, total_cobrado, total_egresos, total_neto, lista, asesor) VALUES ($fecha, $cobro, $total_cobrado, $total_egresos, $total_neto, $lista, $asesor)";
$resultado_insert=mysqli_query($conexion,$insert) or die("problemas al insertar");
if($resultado_insert){
echo "registra";
} else {
echo " no registra";
}


?>