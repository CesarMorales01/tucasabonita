<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
$id_trans=$_REQUEST['id_trans'];
$cliente=trim($_REQUEST['cliente']);
$valor_compra=$_REQUEST['valor_compra'];
$fecha=$_REQUEST['fecha'];
$tok = strtok($fecha, "T");
$fecha="'".$tok."'";
$estado=$_REQUEST['estado'];
$ref=$_REQUEST['ref'];
$texto="ref_wompi=".$ref;
$texto="'".$texto."%'";
$string_get_coment="select comentarios from lista_compras where cliente=$cliente and comentarios like $texto";
$get_coment=$mysql->query($string_get_coment) or die ("problemas en la consulta coment");
	if($cargar_c=$get_coment->fetch_array()){	
		$coment=$cargar_c['comentarios'];
		 $cut_coment = strtok($coment, "//");
		 $cut_coment = strtok("//");
		 $cut_coment = strtok("//");
			$reportar="ref_wompi=".$ref."// Pago por PSE ".$estado;
			$comentarios=$reportar.$cut_coment;
			 $comentarios="'".$comentarios."'";
			$medio_pago="Pago realizado por wompi. Ref:".$id_trans;
			$medio_pago="'".$medio_pago."'";	
			 $string_update="update lista_compras set comentarios=$comentarios, medio_de_pago=$medio_pago where cliente=$cliente and comentarios like $texto";
			$update=$mysql->query($string_update) or die ("problemas update coment");
			if($update){
				echo "updated";
			}
	}


?>