<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];$json=array();$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

if(isset($_REQUEST['fecha_prest'])){
	$fecha_prest="'".$_REQUEST['fecha_prest']."'";
	$consulta="select * from abonos_creditos_casa_bonita where cedula=$cedula and fecha_prest=$fecha_prest";
}else{
	$consulta="select * from abonos_creditos_casa_bonita where cedula=$cedula";
}$resultado=mysqli_query($conexion,$consulta);while($registro=mysqli_fetch_array($resultado)){$json['abonos'][]=$registro;
$check=$registro['fecha'];}
if($check==null){
	$datos['fecha']="";
	$datos['valor_abono']="0";
	$datos['altura_cuotas']="0";
	$json['abonos'][]=$datos;
}
mysqli_close($conexion);echo json_encode($json,JSON_UNESCAPED_UNICODE);
?>

