<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
$medio_pago=$_REQUEST['e_pay'];
session_start();
if(isset($_SESSION['cedula'])){
	$id=$_SESSION['cedula'];
	$cargar_carrito=$mysql->query("select * from carrito_compras_casabonita where cliente=$id") or die ("problemas en la consulta cargar carrito");
						while($cargar_c=$cargar_carrito->fetch_array()){	
						 $productos[]=$cargar_c['producto'];
						 $imagenes[]=$cargar_c['imagen'];
						 $valores[]=$cargar_c['valor'];
						 $cantidades[]=$cargar_c['cantidad'];
						}
						
		$get_ced=$mysql->query("select cedula from crear_clave where id=$id");
				if($get_c=$get_ced->fetch_array()){
					$ced= $get_c['cedula'];
					if($ced!=""){
					$info_cliente=$mysql->query("select * from clientes where cedula=$ced") or die ("problemas en la consulta info cliente");
					if($cargar_info=$info_cliente->fetch_array()){	
						$dir=$cargar_info['direccion']." ".$cargar_info['info_direccion']." ".$cargar_info['ciudad']." ".$cargar_info['departamento'];
						$cliente=$cargar_info['nombre'];
						$cedula=$cargar_info['cedula'];
						$tel=$cargar_info['telefono'];
						$ciudad=$cargar_info['ciudad'];
						$departamento=$cargar_info['departamento'];
						// REVISAR SI CLIENTE TIENE DATOS DE DIRECCION Y PERSONALES
						   if($dir=="" || $cliente=="" || $cedula=="" || $tel=="" || $ciudad=="" || $departamento==""){
							   $_SESSION['lacking']="true";
							   $url1=$url."Registrarse_1.php";
							   header("Location: $url1");
						   }else{
							   $_SESSION['lacking']="";  
						   }
						}
					}else{
						 $_SESSION['lacking']="true";
						 $url1=$url."Registrarse_1.php";
						 header("Location: $url1");
					}	
				}else{
					$url1=$url."my_profile.php?message=lacking";
					header("Location: $url1");	
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
}else{
		header("Location: http://tucasabonita.site/Login.php");
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
	
// Leer data-reference desde bd.
$select_ref=$mysql->query("select max(id) from pagos_wompi_casabonita") or die ("problemas en la consulta ref pagos wompi");	  
if($get_r=$select_ref->fetch_array()){
	 $ref=$get_r['max(id)']+1;
}else{
	$ref=0;
}	
	// id devuelto por wompi despues de un pago
if(isset($_REQUEST['id'])){
	$id_trans=$_REQUEST['id'];
}
 ?>