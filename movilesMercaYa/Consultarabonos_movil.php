<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];

if(isset($_REQUEST['fecha_prest'])){
	$fecha_prest="'".$_REQUEST['fecha_prest']."'";
	$consulta="select * from abonos_creditos_casa_bonita where cedula=$cedula and fecha_prest=$fecha_prest";
}else{
	$consulta="select * from abonos_creditos_casa_bonita where cedula=$cedula";
}
$check=$registro['fecha'];
if($check==null){
	$datos['fecha']="";
	$datos['valor_abono']="0";
	$datos['altura_cuotas']="0";
	$json['abonos'][]=$datos;
}

?>
