<?php
$hostname_localhost ="localhost";

$database_localhost ="u629086351_mirey";

$username_localhost ="u629086351_cesar";

$password_localhost ="pokemongo";

$url="https://tucasabonita.site/";  
$tel_whatsapp="3163439744";
date_default_timezone_set('America/Bogota');
$get_global_fecha_hoy_comis=date("Y-m-d");
$get_global_fecha_hoy="'".$get_global_fecha_hoy_comis."'";

$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");	

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");


if(isset($_COOKIE['cobrador'])){
	$chequeando=$_COOKIE['cobrador'];
}


?>