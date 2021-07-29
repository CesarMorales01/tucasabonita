<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];
$fecha_prest="'".$_REQUEST['fecha']."'";

$registros=$mysql->query("select * from clientes_historial where cedula=$cedula and fecha_prest=$fecha_prest") or die ("problemas en la consulta");
$reg=$registros->fetch_array();

$nombre="'".$reg['nombre']."'";
$direccion="'".$reg['direccion']."'";
$telefono="'".$reg['telefono']."'";
$dir_trabajo="'".$reg['direccion_trabajo']."'";
$tel_trabajo="'".$reg['tel_trabajo']."'";

if(isset($_COOKIE['cobrador'])){	
$revisar_sesion = "'".$_COOKIE['cobrador']."'";
$check_tipousuario=$mysql->query("select * from asesores where imei=$revisar_sesion") or die ("problemas en la consulta asesores");
	if($revisar_usu=$check_tipousuario->fetch_array()){
	$autor_registro="'".$revisar_usu['nombre']."'";
	}
}

$get_prest=$mysql->query("select * from prestamos_historial where cedula=$cedula and fecha_prest=$fecha_prest") or die ("problemas en la consulta");
$reg1=$get_prest->fetch_array();

$fecha_prestamo="'".$reg1['fecha_prest']."'"; 
$valor_prestamo="'".$reg1['valorprestamo']."'"; 
$n_cuotas="'".$reg1['n_cuotas']."'"; 
$n_meses="'".$reg1['tiempo_meses']."'"; 
$valor_cuotas="'".$reg1['valor_cuotas']."'";
$periodicidad="'".$reg1['periodicidad']."'";  
$tt_abonos="'".$reg1['tt_abonos']."'"; 
$tt_saldo="'".$reg1['tt_saldo']."'"; 
$tt_pagar="'".$reg1['totalapagar']."'";
$vencimiento="'".$reg1['vencimiento']."'";  
$fecha_prestamo="'".$reg1['fecha_prest']."'";

$get_cancel=$mysql->query("select MAX(fecha) from abonos_historial where cedula=$cedula and fecha_prest=$fecha_prest") or die ("problemas con hallar la fecha de cancelacion");

$get_fecha_cancelacion=$get_cancel->fetch_array();
$fecha_cancelacion="'".$get_fecha_cancelacion['MAX(fecha)']."'";


$get_info_abonos=$mysql->query("select * from abonos_historial where cedula=$cedula and fecha_prest=$fecha_prest") or die($mysql->error);
$dates = [];
$altura_cuota=[];
$valor_abonos=[];
while($get_abons=$get_info_abonos->fetch_array()){
	$dates[]=$get_abons['fecha'];
	$altura_cuota[]=$get_abons['altura_cuota'];
	$valor_abonos[]=$get_abons['valor_abono'];
}

$contar=count($dates);

$mysql = new mysqli("localhost", "u629086351_usuario", "pokemongo", "u629086351_ClientesMora");
if ($mysql->connect_error) die('Problemas con la conexion a la base de datos'); 

$resultado=$mysql->query("INSERT INTO clientesCCM(cedula, nombre, direccion, telefono, direccion_trabajo, tel_trabajo, autor_registro, 
fecha_prestamo, valor_prestamo, n_cuotas,n_meses, valor_cuotas, periodicidad, tt_abonos,tt_saldo, 
tt_pagar, vencimiento, fecha_cancelacion) VALUES ($cedula, $nombre, $direccion, $telefono, $dir_trabajo, $tel_trabajo,
$autor_registro, $fecha_prestamo, $valor_prestamo, $n_cuotas, $n_meses, $valor_cuotas, $periodicidad, $tt_abonos, $tt_saldo,
$tt_pagar, $vencimiento, $fecha_cancelacion)") or die($mysql->error);

for ($row = 0;$row< $contar; $row ++){
$fecha="'".$dates[$row]."'";
$mysql->query("insert into abonosCCM(cedula, fecha, altura_cuota, valor_abono, autor_registro) values($cedula,
$fecha, $altura_cuota[$row],$valor_abonos[$row], $autor_registro)") or die($mysql->error);

}

$mysql->close();
mysqli_close($conexion);
if($resultado){
setcookie("baseDeDatos",$url,time()+60*60*24*365,"/");	
$notificacion="Cliente con tendencia morosa reportado exitosamente.";
header("Location: http://consultatusaldomirey.site/CCM/Detalle_cuentas_CCM.php?cedula=$cedula.&notificacion=$notificacion");	
}
?>