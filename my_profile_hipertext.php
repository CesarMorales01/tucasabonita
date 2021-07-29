<?php
include("datos.php");
session_start();
if(isset($_SESSION['cedula'])){
	if($_SESSION['cedula']!=""){
		$id=$_SESSION['cedula'];
		$get_clave=$mysql->query("select * from crear_clave where id=$id");
		if($get_a=$get_clave->fetch_array()){
		 $correo= $get_a['correo'];
		 $usuario= $get_a['usuario'];
		 $clave= $get_a['clave'];
		 $cedula_bd= $get_a['cedula'];
		if($cedula_bd!=""){
			$get=$mysql->query("select * from clientes where cedula=$cedula_bd");
			if($get_c=$get->fetch_array()){
			 $nombre= $get_c['nombre'];
			 $apellidos= $get_c['apellidos'];
			 $ciudad= $get_c['ciudad'];
			$departamento= $get_c['departamento'];
			$info_dir= $get_c['info_direccion'];
			 $dir= $get_c['direccion'];
			 // me toco reemplazar los saltos de linea porque me genera error al leerlos en javascript...
			 $dir = preg_replace("[\n|\r|\n\r]", ". ", $dir);
			 $telefonos= $get_c['telefono'];
			}
		}			
	}
  }
}
if(isset($_SESSION['lacking'])){
	$lacking=$_SESSION['lacking'];
}
?>