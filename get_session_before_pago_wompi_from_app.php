 <?php
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
// CREO COOKIE PARA SABER DATOS CUANDO RETORNO DE PAGOS WOMPI....
session_start();
 if (isset($_REQUEST['personal_identification'])){
	  $_SESSION['ced']=$_REQUEST['personal_identification'];
	  $cliente=$_REQUEST['personal_identification'];
	  $_SESSION['usuario']=$_REQUEST['usuario'];
	  $_SESSION['valor_compra_sin_comi']= $_REQUEST['amount-in-cents'];
	  $valor_compra=$_REQUEST['amount-in-cents'];
	  $ref_wompi=$_REQUEST['reference'];
	   $estado="Iniciada. Compra desde casa bonita app";
	   $estado="'".$estado."'";
	   $string_insert="insert into pagos_wompi_casabonita(ref_wompi, cliente, valor_compra, fecha, estado) values($ref_wompi, $cliente, $valor_compra, $get_global_fecha_hoy, $estado)";
		$resultado_insert=mysqli_query($conexion, $string_insert) or die ("Problems to insert!");
		if($resultado_insert){
			mysqli_close($conexion);
			$key="pub_prod_mm5Qq0EJtZhzNzjV4Vm6fLQx6aHhCbjS";
			$redi=$url."check_out_compra_from_app.php";
			$url_wompi="https://checkout.wompi.co/p/?public-key=".$key."&currency=COP&amount-in-cents=".$valor_compra."&reference=".$ref_wompi."&redirect-url=".$redi;
			header('Location: '.$url_wompi);
		}
 } 
 ?>