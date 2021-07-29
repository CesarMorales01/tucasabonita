<?php
include("datos.php");
$cedula=$_REQUEST['cedula'];
$json=array();
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");if(isset($_REQUEST['fecha_prest'])){	$fecha_prest="'".$_REQUEST['fecha_prest']."'";	$registros=$mysql->query("SELECT * from creditos_casa_bonita where fecha_prest=$fecha_prest and cedula=$cedula") or die ("problemas en la consulta");}else{	$registros=$mysql->query("SELECT * from creditos_casa_bonita where cedula=$cedula") or die ("problemas en la consulta");}

if($get_datos=mysqli_fetch_array($registros)){
	$datos['fecha_prest']=$get_datos['fecha_prest'];
	$datos['valorprestamo']=$get_datos['valorprestamo'];
	$datos['tiempo_meses']=$get_datos['tiempo_meses'];
	$datos['periodicidad']=$get_datos['periodicidad'];
	$datos['n_cuotas']=$get_datos['n_cuotas'];
	$datos['valor_cuotas']=$get_datos['valor_cuotas'];
	$datos['totalapagar']=$get_datos['totalapagar'];
	$datos['vencimiento']=$get_datos['vencimiento'];
	//$datos['asesor']=$get_datos['asesor'];
	$datos['tt_abonos']=$get_datos['tt_abonos'];
	$datos['tt_saldo']=$get_datos['tt_saldo'];
	
	$fecha_prest_sincomis=$get_datos['fecha_prest'];
     $fecha_prest_comis="'".$fecha_prest_sincomis."'";
	
	 date_default_timezone_set('America/Los_Angeles');
	 $get_fecha=date("Y-m-d");
     $fecha_hoy_comis="'".$get_fecha."'";
     
     $calc_tiempo=$mysql->query("select datediff($fecha_hoy_comis, $fecha_prest_comis) as obt_fecha") or die 
     ("problemas en restando fecha hasta hoy");
     
     if($registro=mysqli_fetch_array($calc_tiempo))
          $datos['tiempo_hasta_hoy']=$registro['obt_fecha'];
    
     
    $json['datos'][]=$datos; 
	echo json_encode($json,JSON_UNESCAPED_UNICODE);
	
} else{
	$datos['valorprestamo']=0;
	$datos['valor_cuotas']=0;
	$datos['totalapagar']=0;
	$datos['tt_abonos']=0;
	$datos['tt_saldo']=0;
	$json['datos'][]=$datos;
	echo json_encode($json,JSON_UNESCAPED_UNICODE);
}
	
$mysql->close();
?>
