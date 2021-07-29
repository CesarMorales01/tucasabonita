<?php
include("datos.php");
session_start();
if(isset($_SESSION['cedula'])){
	$id=$_SESSION['cedula'];
	$contra="'".$_REQUEST['contraseña']."'";	
	$stringquery="update crear_clave set clave=$contra where id=$id";
	$set=$mysql->query($stringquery) or die ("problemas");
	if($set>0){
	   $href=$url."my_profile.php";
       header("Location:  $href"); 
	}
}
?>