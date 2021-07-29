<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];$json=array();$conexion = mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
	$fecha_prest="'".$_REQUEST['fecha_prest']."'";
	$consulta="select * from abonos_creditos_casa_bonita where fecha_prest=$fecha_prest and cedula=$cedula";$resultado=mysqli_query($conexion,$consulta);while($registro=mysqli_fetch_array($resultado)){$json['abonos'][]=$registro;}mysqli_close($conexion);echo json_encode($json,JSON_UNESCAPED_UNICODE);
?>

