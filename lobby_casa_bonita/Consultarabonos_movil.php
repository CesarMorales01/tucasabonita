<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];
	$fecha_prest="'".$_REQUEST['fecha_prest']."'";
	$consulta="select * from abonos_creditos_casa_bonita where fecha_prest=$fecha_prest and cedula=$cedula";
?>
