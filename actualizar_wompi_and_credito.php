 <?PHP
include("datos.php");
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$ref_wompi="'".$_REQUEST['ref']."'";
$id_trans="'".$_REQUEST['id_trans']."'";
$cliente1=$_REQUEST['cliente'];
$cliente="'".$cliente1."'";
$valor_compra=$_REQUEST['valor_compra'];
$fecha="'".$_REQUEST['fecha']."'";
$tok = strtok($_REQUEST['fecha'], "T");
$fingreso= "'".$tok."'";
$fecha_credito="'".$_REQUEST['fecha_credito']."'";
$estado="'".$_REQUEST['estado']."'";
$wompi="Wompi";
$asesor="'".$wompi."'";
$casabonita="Casabonita";
$Cobro="'".$casabonita."'";
$insert="update pagos_wompi_casabonita set ref_wompi=$id_trans, fecha=$fecha, estado=$estado where id=$ref_wompi";
$resultado_insert=mysqli_query($conexion,$insert) or die ("Problems to insert!");
if($resultado_insert){

		$consulta="SELECT SUM(valor_abono), MAX(altura_cuota) FROM abonos_creditos_casa_bonita WHERE CEDULA=$cliente and fecha_prest=$fecha_credito";
		$resultado=mysqli_query($conexion,$consulta);
		if($reg=$resultado->fetch_array()){
		  $get_total_abonado=$reg['SUM(valor_abono)'];
		  $cal_altura_cuota=$reg['MAX(altura_cuota)'];
		}
		$total_abonado= $get_total_abonado+$valor_compra;
		$altura_cuota=$cal_altura_cuota + 1;		

		$consulta2="SELECT totalapagar FROM creditos_casa_bonita WHERE CEDULA=$cliente and fecha_prest=$fecha_credito";
		$resultado2=mysqli_query($conexion,$consulta2);
		if($reg2=$resultado2->fetch_array()){
			 $get_total_saldo=$reg2['totalapagar'];
		}	
		$total_saldo=$get_total_saldo-$total_abonado;
		$insert_abono="INSERT INTO abonos_creditos_casa_bonita(cedula, fecha, altura_cuota, valor_abono, asesor, fingreso, Cobro, fecha_prest) VALUES ($cliente, $fingreso, $altura_cuota, $valor_compra, $asesor, $fingreso, $Cobro, $fecha_credito)";
		 $actualizar_total="update creditos_casa_bonita set tt_abonos='$total_abonado', tt_saldo='$total_saldo' where cedula=$cliente and fecha_prest=$fecha_credito";
		$resultado_insert=mysqli_query($conexion,$insert_abono) or die ("problemas al insertar");
		if($resultado_insert){
			$resultado_actualizar=mysqli_query($conexion,$actualizar_total);
			if($resultado_actualizar){
				echo 'updated';
			}
		}	
}
	
?>