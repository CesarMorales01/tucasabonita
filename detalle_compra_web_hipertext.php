<?php
include("datos.php");
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
session_start();
if(isset($_REQUEST['compra_n'])){
	 $compra_n=$_REQUEST['compra_n'];
     $compra_n= base64_decode(urldecode($compra_n));
		$id=$_SESSION['cedula'];
		$get_ced=$mysql->query("select cedula from crear_clave where id=$id");
				if($get_c=$get_ced->fetch_array()){
					$cedula_bd= $get_c['cedula'];
					$query_string="select * from lista_compras where cliente=$cedula_bd and compra_n=$compra_n";
					$get_compra=$mysql->query($query_string) or die ("problemas al consultar");
						if($compra=$get_compra->fetch_array()){
							$id_compra=$compra['id'];
							$fecha_compra=$compra['fecha'];
							$valor_total=$compra['total_compra'];
						}
						
					$getCliente=$mysql->query("select * from clientes where cedula=$cedula_bd") or die ("problemas al consultar cliente");
							if($info=$getCliente->fetch_array()){
							   $nombre=$info['nombre'];
							   $dir=$info['direccion'];
							   $tel =str_replace("//"," ",$info['telefono']);
							}
				}
}	
 ?>