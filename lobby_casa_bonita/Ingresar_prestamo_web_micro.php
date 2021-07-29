<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];
$check_box=$_REQUEST['check_credito'];

if(isset($_REQUEST['fecha_prest'])){
	$fecha_prest1=$_REQUEST['fecha_prest'];	
} 
$fecha_prest="'".$fecha_prest1."'";
$compra_n=$_REQUEST['compra_n'];
$asesor="'".$_REQUEST['asesor']."'";
$cartera="Casabonita";
$Cobro="'".$cartera."'";
$descripcion_credito="";
$medio_de_pago="";
$valorprestamo=$_REQUEST['valorprestamo'];	
$n_cuotas=$_REQUEST['n_cuotas'];
$periodicidad1=$_REQUEST['periodicidad'];
if(isset($_COOKIE['cobrador'])){
$asesor0=$_COOKIE['cobrador'];
$asesor0="'".$asesor0."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}   			
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	 
// GUARDAR LISTA PRODUCTOS COMPRADOS
	$get_carrito="SELECT * FROM carrito_compras WHERE cliente=$cedula";
	$carrito=mysqli_query($conexion,$get_carrito) or die ("problemas al consultar carrito");
	while($carr=$carrito->fetch_array()){
	      $producto="'".$carr['producto']."'";
		  $codigo=$carr['cod'];
		$descripcion="'".$carr['descripcion']."'";
		$cantidad=$carr['cantidad'];
		$precio=$carr['valor'];
	
		$insert_comprados=$mysql->query("insert into lista_productos_comprados (cliente, compra_n, codigo, producto, descripcion, cantidad, precio) VALUES ($cedula, $compra_n, $codigo, $producto, $descripcion, $cantidad, $precio)") or die ("problemas al insertar lista productos");
				if($insert_comprados){
				echo	$response = "registrada"; 	
				}	
				
		}


if($check_box!=""){
	$tiempo_meses=$_REQUEST['tiempo_meses'];
	$interes1="'".$_REQUEST['interes']."'";
	$periodicidad="'".$_REQUEST['periodicidad']."'";
	$valor_cuotas=$_REQUEST['valor_cuotas'];
	$totalapagar=$_REQUEST['totalapagar'];
	$total_meses=$_REQUEST['tiempo_meses'];
	$tt_abonos=0;
	$interes=$interes1/100;
	$texto_descr=" cuotas de ";
	$de=" de ";
	$descripcion_credito=$n_cuotas.$texto_descr.$periodicidad1.$de.$valor_cuotas;
	$medio_de_pago="credito";
	$insert="INSERT INTO creditos_casa_bonita(cedula, fecha_prest, valorprestamo, tiempo_meses, interes, periodicidad, n_cuotas, valor_cuotas, totalapagar, compra_n, tt_abonos,tt_saldo, Cobro, asesor) VALUES ($cedula, $fecha_prest, $valorprestamo, $tiempo_meses, $interes, $periodicidad, $n_cuotas, $valor_cuotas, $totalapagar, $compra_n, $tt_abonos, $totalapagar, $Cobro, $asesor)"; 
	$resultado_insert=mysqli_query($conexion,$insert)or die ("problemas al insert credito");
	if($resultado_insert){
		$consulta="select adddate($fecha_prest,interval $total_meses month) as sumarfecha";
		$resultado=mysqli_query($conexion,$consulta);
		if($registro=mysqli_fetch_array($resultado)){
							$sumarfecha=$registro['sumarfecha'];
							$insert_venci="update creditos_casa_bonita set vencimiento='$sumarfecha' where cedula='$cedula'";
							$resultado1=mysqli_query($conexion,$insert_venci);
							
						}					
		}
	
}	
//INSERT COMPRA
if($descripcion_credito==""){
$descripcion_credito="'".$valorprestamo."'";
$medio_de_pago="contado";
$periodicidad="No aplica";
$periodicidad="'".$periodicidad."'";	
}else{
	$descripcion_credito="'".$descripcion_credito."'";
	$periodicidad="'".$periodicidad1."'";
}
$medio_de_pago="'".$medio_de_pago."'";
$domicilio="Registrado por asesor.";
$domicilio="'".$domicilio."'";
$insert1=$mysql->query("insert into lista_compras (cliente, compra_n, fecha, total_compra, descripcion_credito, n_cuotas,periodicidad, domicilio, medio_de_pago, comentarios)
										VALUES ($cedula, $compra_n, $fecha_prest, $valorprestamo, $descripcion_credito,  $n_cuotas, $periodicidad, $domicilio, $medio_de_pago, $asesor)") or die ("problemas al insertar lista compras");
	if($insert1){
			// borra carrito compras
			$borrar_carrito=$mysql->query("delete from carrito_compras where cliente=$cedula") or die ("problemas borrar carrito");
			if($borrar_carrito){
				$string_comparar_medio_pago="contado";
				$string_comparar_medio_pago_comis="'".$string_comparar_medio_pago."'";
				if($medio_de_pago==$string_comparar_medio_pago_comis){
					header("Location: $url/Cuadrar_cuentas_microcreditos.php");	
				}else{
					header("Location: $url/Form_%20detalle_cuentas_todos_micro.php?cedula=$cedula");
				}
			}		
	}
mysqli_close($conexion);
?>