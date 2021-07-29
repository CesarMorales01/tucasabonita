<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
session_start();
if(isset($_SESSION['cedula'])){
 $id=$_SESSION['cedula'];
 $get_ced=$mysql->query("select cedula from crear_clave where id=$id");
 if($get_c=$get_ced->fetch_array()){
	$cedula=$get_c['cedula'];
 
 
	 // cargar datos compra por entregar
	$entregada="Entregada";
	$entregada="'".$entregada."'";
	$compras_recibida=$mysql->query("select * from lista_compras where cliente=$cedula and estado!=$entregada") or die ("problemas en la consulta arts");
		while($compra_reci=$compras_recibida->fetch_array()){
			$compras_por_entregar="true";
			$num_compra= $compra_reci['compra_n'];
			$fecha= $compra_reci['fecha'];
			$total_compra= $compra_reci['total_compra'];
			$articulos_sin_entregar_medio_pago= $compra_reci['medio_de_pago'];
			$articulos_sin_entregar_domicilio=$compra_reci['domicilio'];
			$estado= $compra_reci['estado'];
			if($num_compra!=""){
				$cargar_articulos=$mysql->query("select * from lista_productos_comprados where cliente=$cedula and compra_n=$num_compra") or die ("problemas en la consulta arts");
				while($cargar_art=$cargar_articulos->fetch_array()){
				  $articulos_sin_entregar_cods[]=$cargar_art['codigo'];
				  $cod=$cargar_art['codigo'];
					$cargar_img=$mysql->query("select imagen from productos where id=$cod") or die ("problemas cargar img");
					if($img=$cargar_img->fetch_array()){
						$articulos_img=$img['imagen'];
						$tok = strtok($articulos_img, "||");
						if($tok !== false) {
							$articulos_sin_entregar_img[]=$tok;
							$tok = strtok("||");
						}
					}
				  $articulos_sin_entregar_productos[]=$cargar_art['producto'];
				  $articulos_sin_entregar_descripciones[]=$cargar_art['descripcion'];
				  $articulos_sin_entregar_cant[]=$cargar_art['cantidad'];
				  $articulos_sin_entregar_precios[]=$cargar_art['precio'];
				}
			}
	}

	 // cargar historial compras
	$entregada="Entregada";
	$entregada="'".$entregada."'";

	$compras_entregadas=$mysql->query("select * from lista_compras where cliente=$cedula and estado=$entregada order by fecha desc") or die ("problemas en la consulta histo");
		while($compra_entre=$compras_entregadas->fetch_array()){
			$num_compra_entre[]= $compra_entre['compra_n'];
			$fecha_entre[]= $compra_entre['fecha'];
			$total_compra_entre[]= $compra_entre['total_compra'];
			$medio_pago_entre[]= $compra_entre['medio_de_pago'];
			$num_compra=$compra_entre['compra_n'];
			if($num_compra!=""){
				$cargar_articulos_entre=$mysql->query("select * from lista_productos_comprados where cliente=$cedula and compra_n=$num_compra") or die ("problemas en la consulta arts histo");
				if($cargar_art_entre=$cargar_articulos_entre->fetch_array()){
				  $articulos_entre_cods[]=$cargar_art_entre['codigo'];
				  $cod=$cargar_art_entre['codigo'];
					$cargar_img=$mysql->query("select imagen from productos where id=$cod") or die ("problemas cargar img histo");
					if($img=$cargar_img->fetch_array()){
						$articulos_img=$img['imagen'];
						$tok = strtok($articulos_img, "||");
						if($tok !== false) {
							$articulos_entre_img[]=$tok;
							$tok = strtok("||");
						}
					}
				  $articulos_entre_productos[]=$cargar_art_entre['producto'];
				  $articulos_entre_descripciones[]=$cargar_art_entre['descripcion'];
				  $articulos_entre_cant[]=$cargar_art_entre['cantidad'];
				  $articulos_entre_precios[]=$cargar_art_entre['precio'];
				}
			}
		}		
 }		
		
	// verificar if error transaccion desde app
	if(isset($_REQUEST['error'])){
		$error=$_REQUEST['error'];	
	}
}
?>
						 