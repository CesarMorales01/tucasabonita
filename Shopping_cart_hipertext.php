<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
session_start();
if(isset($_SESSION['cedula'])){
	$cedula=$_SESSION['cedula'];
}else{
header("Location: https://tucasabonita.site/Login.php");	
}
// PARA ARREGLAR EL PROBLEMA DE QUE SI LE DOY ATRAS DESDE CHECK OUT ME PIDE REENVIAR FORMULARIO
if(isset($_REQUEST['checkin'])){}else{
	$url=$url.'Shopping_cart.php?checkin=true';
	header("Location: $url");
}
if(isset($_REQUEST['id_producto'])){
	// Si llega un producto procedo a comparar si hay otro igual ya en el carrito si no guardar.
  $cod_producto=$_REQUEST['id_producto'];
  $cantidad=$_REQUEST['cantidad'];
  $get_producto=$mysql->query("select * from productos where id=$cod_producto") or die ("problemas en la consulta producto");
	if($get_p=$get_producto->fetch_array()){
		 $nombre_producto= "'".$get_p['nombre']."'";
		 $descripcion_producto= "'".$get_p['descripcion']."'";
		 $tok = strtok($get_p['imagen'], "||");	
		 $imagen_p= "'".$tok."'";
		 $precio_producto= "'".$get_p['valor']."'";
		 	$get_carrito=$mysql->query("select * from carrito_compras_casabonita where cliente=$cedula") or die ("problemas en la consulta carrito");
				$cods_p=[];
				$if_new_product=true;
				while($get_c=$get_carrito->fetch_array()){
					$code=$get_c['cod'];
					$cods_p[]=$get_c['cod'];
					if($cod_producto==$get_c['cod']){
						$if_new_product=false;
						$cantidad=$get_c['cantidad']+$cantidad;
						if($cantidad>=4){$cantidad=4;}
						$update_carrito=$mysql->query("update carrito_compras_casabonita set cantidad=$cantidad where cod=$code") or die("problems updating");
					}
					
				}
				if($if_new_product){
					$insert_carrito=$mysql->query("insert carrito_compras_casabonita (cod, producto, descripcion, imagen, valor, cantidad, cliente) VALUES ($cod_producto, $nombre_producto, $descripcion_producto, $imagen_p, $precio_producto, $cantidad, $cedula)") or die ("problems insert new");	
				}
				$reps=count($cods_p);
			if($reps<=0){
				//$insert_carrito=$mysql->query("insert carrito_compras_casabonita (cod, producto, descripcion, imagen, valor, cantidad, cliente) VALUES ($cod_producto, $nombre_producto, $descripcion_producto, $imagen_p, $precio_producto, $cantidad, $cedula)") or die ("problems insert");	
			}
	}

}
// CARGAR CARRITO
$cargar_carrito=$mysql->query("select * from carrito_compras_casabonita where cliente=$cedula") or die ("problemas en la consulta cargar carrito");
				$codigos=[];
				$productos=[];
				$descripciones=[];
				$imagenes=[];
				$valores=[];
				$cantidades=[];
				while($cargar_c=$cargar_carrito->fetch_array()){
				 $codigos[]=$cargar_c['cod'];
				 $productos[]=$cargar_c['producto'];
				 $descripciones[]=$cargar_c['descripcion'];
				 $imagenes[]=$cargar_c['imagen'];
				 $valores[]=$cargar_c['valor'];
				 $cantidades[]=$cargar_c['cantidad'];
				}



?>