<?php
include("datos.php");
session_start();
if(isset($_SESSION['cedula'])){
	$id=$_SESSION['cedula'];
	$mail="'".$_REQUEST['mail']."'";
	$usu="'".$_REQUEST['usuario']."'";	
	$stringquery="update crear_clave set usuario=$usu, correo=$mail where id=$id";
	$set=$mysql->query($stringquery) or die ("problemas");
	if($set>0){
	   $_SESSION['usuario']=$_REQUEST['usuario'];
	   $href=$url."my_profile.php";
       header("Location:  $href"); 
	}
}
?>