<?php
include("datos.php");
session_start();
if(isset($_REQUEST['nombre'])){	
	$nombre1=$_REQUEST['nombre'];
	$nombre= "'".$_REQUEST['nombre']."'";
	$mail= "'".$_REQUEST['mail']."'";
	$contra="'".$_REQUEST['contraseña']."'";
	$casabonita="Casabonita";
	$cartera="'".$casabonita."'";
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
	$fecha="'".$fecha."'";
	
	$select_m=$mysql->query("select correo from crear_clave where correo=$mail") or die ("problemas mail");
	if($m=$select_m->fetch_array()){
		// OJO CAMBIAR ESTO CUANDO SE ACTUALICE EL DOMINIO.
		header("Location: https://tucasabonita.site/Registrarse.php?message=repeated_mail");
	}else{
		$string_query="insert into crear_clave (correo, usuario, clave, cartera, fecha_ingreso) values ($mail, $nombre, $contra, $cartera, $fecha)";
		$insert=$mysql->query($string_query) or die ("problemas2");
		if($insert){
					$select=$mysql->query("select id from crear_clave where correo=$mail") or die ("problemas select email");
					if($id=$select->fetch_array()){
					  $ide= $id['id'];
					  session_start();
						$_SESSION['cedula']=$ide;
						$_SESSION['usuario']=$nombre1;
						if($_SESSION['producto']!=""){
							$url=$url."Productos?producto=".$_SESSION['producto'];
							header("Location: $url");
						}else{
							header("Location: $url");
						}
					}
		}
	}
}
?>