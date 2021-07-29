 <?PHP
include("datos.php");
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$ref_wompi="'".$_REQUEST['ref']."'";
$cliente1=$_REQUEST['cliente'];
$cliente="'".$cliente1."'";
$valor_compra=$_REQUEST['valor_compra'];
date_default_timezone_set('America/Bogota');
$fecha=date("Y-m-d");
$fecha="'".$fecha."'";
$estado="'".$_REQUEST['estado']."'";
	$insert="insert into pagos_wompi_casabonita(cliente, valor_compra, fecha, estado) values($cliente, '$valor_compra', $fecha, $estado)";
	$resultado_insert=mysqli_query($conexion,$insert) or die ("Problems to insert!");
	if($resultado_insert){
		$get_ref=$mysql->query("select id from pagos_wompi_casabonita where cliente=$cliente and valor_compra=$valor_compra order by id desc") or die ("problemas en la consulta info ref");
		if($reference=$get_ref->fetch_array()){
			session_start();
			$_SESSION['customer'] = $cliente1;
			$_SESSION['my_ref'] = $reference['id'];
			echo "registra";
		}
		mysqli_close($conexion);
	}
?>