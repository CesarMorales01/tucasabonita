<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
session_start();
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
// ARRAY CATEGORIAS
$categorias=[];
$images_categorias=[];
$get_cates=$mysql->query("select * from categorias") or die ("problemas en la consulta cates");
while($get_categorias=$get_cates->fetch_array()){
$categorias[]= $get_categorias['nombre'];
$images_categorias[]=$get_categorias['imagen'];
}
// ARRAY PROMOCIONES PARA CAROUSEL
$descrip_promos=[];
$codigos_promos=[];
$get_promos=$mysql->query("select * from promociones_mercaya order by id desc") or die ("problemas en la consulta promos");
while($get_promociones=$get_promos->fetch_array()){
	   $descrip_promos[]= $get_promociones['imagen'];
	   $codigos_promos[]= $get_promociones['ref_producto'];
	   $descripciones_promos[]=$get_promociones['descripcion'];
}
// ARRAY PRODUCTOS PARA AUTOCOMPLETE
$productos=[];
$productos_id=[];
$get_productos=$mysql->query("select * from productos") or die ("problemas en la consulta productos");
while($get_products=$get_productos->fetch_array()){
   $productos[]= $get_products['nombre'];
   $productos_id[]= $get_products['id'];
}
// ARRAYS RESUMEN PRODUCTOS POR CATEGORIAS
for($a=0;$a<count($categorias);$a++){
  $cate_comis="'%".$categorias[$a]."%'";	 
   $first_select="select * from productos where categoria like $cate_comis or descripcion like $cate_comis order by ";
   $second_select=select_aleatorio();
   $limit_select=" limit 9";
   $select_united=$first_select.$second_select.$limit_select;
   $get_productos_by_c=$mysql->query($select_united) or die ("problemas...");	
	while($get_pts=$get_productos_by_c->fetch_array()){
		$productos_by_cates_nombres[$categorias[$a]][]= $get_pts['nombre'];
		$tok = strtok($get_pts['imagen'], "||");	
		$productos_by_cates_images[$categorias[$a]][]=$tok;
		$productos_by_cates_precios[$categorias[$a]][]= $get_pts['valor'];
		$productos_by_cates_codigos[$categorias[$a]][]= $get_pts['id'];	 
	} 
}
function select_aleatorio(){
	 $aleat=rand(0, 7);
	if($aleat==0){
		$select="id desc ";
		}
	if($aleat==1){ 
	$select="id asc ";
	}
	if($aleat==2){ 
	$select="nombre asc ";
	}
	if($aleat==3){ 
	$select="nombre desc ";
	}
	if($aleat==4){ 
	$select="descripcion asc ";
	}
	if($aleat==5){ 
	$select="descripcion desc ";
	}
	if($aleat==6){ 
	$select="valor asc ";
	}
	if($aleat==7){ 
	$select="valor desc ";
	}
	return $select;
}

// cargar numero de productos para badge icono carrito compras
$cedula=$_SESSION['cedula'];
if($cedula!=""){
	 $nums_carrito=$mysql->query("select count(cod) from carrito_compras_casabonita where cliente=$cedula") or die ("problemas en la consulta cargar carrito");;
	if($item=$nums_carrito->fetch_array()){
	  $numero_productos_carrito= $item['count(cod)'];
	}
}

//Variables globales
$url1=$url;
?>