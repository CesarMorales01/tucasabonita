<?php
include("datos.php");	
// lo dañe pero igual me toca implementar lo nuevo....
if(isset($_REQUEST['id'])){
	$id=$_REQUEST['id'];
	$nombre= "'".$_REQUEST['nombre']."'";
	$apellidos= "'".$_REQUEST['apellidos']."'";
	$cedula= $_REQUEST['cedula'];
	$dir= "'".$_REQUEST['direccion']."'";
	$tel= "'".$_REQUEST['telefono']."'";
	date_default_timezone_set('America/Bogota');
	$fecha=date("Y-m-d");
	$fecha="'".$fecha."'";
	$casabonita="Casabonita";
	$cartera="'".$casabonita."'";
	$select_ced=$mysql->query("select cedula from crear_clave where id=$id") or die ("problemas id");
	if($get_ced=$select_ced->fetch_array()){
		$cedula1=$get_ced['cedula'];
		if($cedula1==""){
			$string_query="insert into clientes (nombre, apellidos, cedula, direccion, telefono, fecha_ingreso, Cobro) values ($nombre, $apellidos, $cedula, $dir, $tel, $fecha, $cartera)";
			$insert=$mysql->query($string_query) or die ("problemas2");
			if($insert){
				$string_update="update crear_clave set cedula=$cedula where id=$id";
				$upd=$mysql->query($string_update) or die ("problemas upd");
			}
		}else{
				echo $string_update="update clientes set nombre=$nombre, apellidos=$apellidos, direccion=$dir, telefono=$tel where cedula=$cedula1";
				$upd=$mysql->query($string_update) or die ("problemas upd clientes");
		}
		$href=$url."my_profile.php";
		header("Location:  $href");
	}
}

?>