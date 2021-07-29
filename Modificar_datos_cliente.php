<?php
include("datos.php");	
session_start();
	$id="'".$_SESSION['cedula']."'";
	$nombre= "'".$_REQUEST['nombre']."'";
	$apellidos= "'".$_REQUEST['apellidos']."'";
	$cedula= "'".$_REQUEST['cedula']."'";
	$dir= "'".$_REQUEST['direccion']."'";
	$tel= "'".$_REQUEST['telefono']."'";
	$ciudad= "'".$_REQUEST['ciudad']."'";
	$departamento= "'".$_REQUEST['departamento']."'";
	$info_direccion= "'".$_REQUEST['info_direccion']."'";
    $casabonita="Casabonita";
	$Cobro="'".$casabonita."'";
	$string_select="select * from clientes where cedula=$cedula";

	$get_cli=$mysql->query($string_select);
	if($get_a=$get_cli->fetch_array()){
		$string_update_cli="update clientes set nombre=$nombre, apellidos=$apellidos, direccion=$dir, telefono=$tel, ciudad=$ciudad, departamento=$departamento, info_direccion=$info_direccion where cedula=$cedula";
		$set=$mysql->query($string_update_cli) or die ("problemas updating");
		
	}else{
		$stringquery="insert into clientes (cedula, nombre, apellidos, direccion, telefono, ciudad, departamento, info_direccion, Cobro) values($cedula, $nombre, $apellidos, $dir, $tel, $ciudad, $departamento, $info_direccion, $Cobro)";
		$set=$mysql->query($stringquery) or die ("problemas");
	}
	if($set>0){
			$string_update="update crear_clave set cedula=$cedula, nombre=$nombre, cartera=$Cobro";
			$set_upd=$mysql->query($string_update) or die ("problemas");
			if($set_upd){
				if(isset($_SESSION['lacking'])){
					$lacking=$_SESSION['lacking'];
					if($lacking=="true"){
						$href=$url."Shopping_cart?checkin=true";
					}else{
						$href=$url."my_profile.php";
					}
				}else{
					$href=$url."my_profile.php";
				}
			}
		header("Location:  $href"); 
	}
	
?>