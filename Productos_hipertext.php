<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");

if(isset($_REQUEST['producto'])){
	$producto=$_REQUEST['producto'];
	$cod_prod= base64_decode(urldecode($producto));
}

$get_producto_promo=$mysql->query("select * from productos where id=$cod_prod") or die ("problemas en la consulta promos");
if($get_promo_producto=$get_producto_promo->fetch_array()){
	 $nombre_producto= $get_promo_producto['nombre'];
	 $images_p= $get_promo_producto['imagen'];
	 $precio_producto= $get_promo_producto['valor'];
	 $descripcion_producto= $get_promo_producto['descripcion'];
	 // get categoria para div sugerencias x categoria...
	 $categoria_producto= $get_promo_producto['categoria'];
}
   
$token = strtok($images_p, "||");
$imagenes_producto=[];
while ($token !== false) {
	$imagenes_producto[]=$token;
	 $token = strtok("||");
}
// get fecha x calcular entrega
date_default_timezone_set('America/Bogota');
$get_fecha=date("Y-m-d");
$get_fecha1="'".$get_fecha."'";
$dias_a_transcurrir="2";
$get_f=$mysql->query("select adddate($get_fecha1, interval $dias_a_transcurrir day) as fecha1") or die ("problemas en la consulta fecha");
if($get_date=$get_f->fetch_array()){
	$fecha_entrega=$get_date['fecha1'];
}
if($fecha_entrega!=null){
	$dia_entrega_min=substr($get_fecha, 8, 2);
	$mes_entrega_min=mes_español($get_fecha);
	$mes_entrega_max=mes_español($fecha_entrega);
	$dia_entrega_max=substr($fecha_entrega, 8, 2);
}
function mes_español($fecha_in){
	$mes_español="";
	$mes = substr($fecha_in, 5, 2);
	if($mes=="01"){ $mes_español="Enero";}
	if($mes=="02"){ $mes_español="Febrero";}
	if($mes=="03"){ $mes_español="Marzo";}
	if($mes=="04"){ $mes_español="Abril";}
	if($mes=="05"){ $mes_español="Mayo";}
	if($mes=="06"){ $mes_español="Junio";}
	if($mes=="07"){ $mes_español="Julio";}
	if($mes=="08"){ $mes_español="Agosto";}
	if($mes=="09"){ $mes_español="Septiembre";}
	if($mes=="10"){ $mes_español="Octubre";}
	if($mes=="11"){ $mes_español="Noviembre";}
	if($mes=="12"){ $mes_español="Diciembre";}
	return $mes_español;
}


// consultar productos por categoria para div sugerencias
$cate_comis="'".$categoria_producto."'";
$get_nums_by_c=$mysql->query("SELECT COUNT(*) from productos where categoria=$cate_comis")or die ("problemas nums...");
  if($get_ns=$get_nums_by_c->fetch_array()){
	 $max_num=nums_aleatorio1($get_ns['COUNT(*)']);
  }	
$get_sugestions=$mysql->query("select * from productos where categoria=$cate_comis limit $max_num, 6") or die ("problemas en la consulta prodos by cates");
while($get_s=$get_sugestions->fetch_array()){
	 $nombre_s[]= $get_s['nombre'];
	 $tok = strtok($get_s['imagen'], "||");	
	 $images_s[]="Imagenes_productos/".$tok;
	 $precio_s[]= $get_s['valor'];
	 $cod_s[]= $get_s['id'];
}

// FUNCION PARA ELEGIR UN NUMERO ALEATORIO Y OBTENER DIFERENTES PRODUCTOS EN QUERY MYSL LIMIT 
function nums_aleatorio1($count_array){
	$aleat=rand(0, $count_array);
	if($aleat==$count_array){$aleat=0;}
	$menos_de6=$count_array-6;
	if($aleat>=$menos_de6){ $aleat=0;}
	return $aleat;
}

?>