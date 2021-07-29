<?php
 
 header('Content-type: text/html; charset=utf-8');

include("datos.php");
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

$cedula1=$_REQUEST['cedula'];
$cedula="'".$cedula1."'";
$contraseña1=$_REQUEST['contraseña'];
$contraseña="'".$contraseña1."'";

$getdatos=$mysql->query("select * from crear_clave where cedula=$cedula and clave=$contraseña");
         
if($registro=mysqli_fetch_array($getdatos)){
$cedula1= $registro['cedula'];
$usuario= $registro['usuario']; 
$clave=$registro['clave'];  
	if(strcmp($clave, $contraseña1) != 0){
	$notificacion="Contraseña incorrecta!";
	header("Location:  $url./Microcreditos_bd/index.php?notificacion=$notificacion");  
	 } else {
		if(isset($_REQUEST['save_index'])){
            setcookie("save_index",$_REQUEST['cedula'],time()+60*60*24*365,"/");
            setcookie("contra_index",$_REQUEST['contraseña'],time()+60*60*24*365,"/");            
			header("Location:  $url./Microcreditos_bd/Lobby_clientes.php?cedula=$cedula1");
			} else {
			  setcookie("save_index","","0","/"); 
			  header("Location:  $url./Microcreditos_bd/Lobby_clientes.php?cedula=$cedula1");			  
			}	
	} 

} else {
		$notificacion="Contraseña incorrecta!";
		header("Location:  $url./Microcreditos_bd/index.php?notificacion=$notificacion");  
	}

?>