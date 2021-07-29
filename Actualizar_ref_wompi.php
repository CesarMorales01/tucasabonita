<?PHP
include("datos.php");
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
session_start();
$cliente1=$_SESSION['customer'];
$before_ref=$_SESSION['my_ref'];
$ref="'".$_REQUEST['ref']."'";
$valor_compra=$_REQUEST['valor_compra'];

$fecha="'".$_REQUEST['fecha']."'";
$estado="'".$_REQUEST['estado']."'";
$string_query="update pagos_wompi_casabonita set ref_wompi=$ref, fecha=$fecha, estado=$estado where cliente=$cliente1 and id=$before_ref";
$resultado_insert=mysqli_query($conexion,$string_query) or die ("Problems to upd!");
	if($resultado_insert){
		echo "updated";
		$_SESSION['customer']="";
		$_SESSION['my_ref']="";
	}
?>