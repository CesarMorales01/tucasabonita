<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$ref=$_REQUEST['ref'];
$texto="ref_wompi=".$ref;
$get_cliente=$mysql->query("select cliente from lista_compras where comentarios like '$texto%'") or die ("problemas en la consulta info cliente");
		if($cliente=$get_cliente->fetch_array()){			
			echo $clie=$cliente['cliente'];
			session_start();
			$_SESSION['cedula'] = $clie;
		}
?>