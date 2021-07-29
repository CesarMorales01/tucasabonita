<?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$cedula=$_REQUEST['cedula'];
$compra_n=$_REQUEST['compra_n'];
// cargar gson
$data=$_REQUEST['data'];
$newArray=json_decode($data, true);
$response=null;
$total_compra=0;

foreach($newArray as $row){
	$codigo=$row['codigo'];
	$producto="'".$row['nombre']."'";
	$descripcion="'".$row['descripcion']."'";
	$cantidad=$row['cantidad'];
	$precio=$row['valor'];
	$mult=$precio*$cantidad;
	$total_compra=$total_compra+$mult;
	$insert=$mysql->query("insert into lista_productos_comprados (cliente, compra_n, codigo, producto, descripcion, cantidad, precio) VALUES ($cedula, $compra_n, $codigo, $producto, $descripcion, $cantidad, $precio)") or die ("problemas al insertar");
	if($insert){
		$response = "registrada"; 	
	}
}

$fecha="'".$_REQUEST['fecha']."'";
$domicilio="'".$_REQUEST['domicilio']."'";
$medio_de_pago="'".$_REQUEST['medio_de_pago']."'";
$descripcion_credito="'".$_REQUEST['descripcion_credito']."'";
$n_cuotas=$_REQUEST['n_cuotas'];
$n_cuotas1="'".$n_cuotas."'";
$periodicidad=$_REQUEST['periodicidad'];
$periodicidad1="'".$periodicidad."'";
$comentarios="'".$_REQUEST['comentarios']."'";
$cambio="'".$_REQUEST['cambio']."'";
$estado="Recibida";
$estado="'".$estado."'";
$vendedor="App";
$vendedor="'".$vendedor."'";
$insert1=$mysql->query("insert into lista_compras (cliente, compra_n, fecha, total_compra, descripcion_credito, n_cuotas, periodicidad, domicilio, medio_de_pago, comentarios, cambio, estado, vendedor) VALUES ($cedula, $compra_n, $fecha, $total_compra, $descripcion_credito, $n_cuotas1, $periodicidad1, $domicilio, $medio_de_pago, $comentarios, $cambio, $estado, $vendedor)") or die ("problemas al insertar lista compras");
	if($insert1){
		$response = "registrada1"; 
		notificar();	
	}
	
echo $response;	


function notificar(){
	$subject=utf8_decode("Nueva compra!"); 
	$texto= "https://tucasabonita.site/ListaCompras.php";
    $message=$texto;
    $from="Tucasabonita";
    $correo= "cezar_mh86@hotmail.com";
    mail($correo, $subject, $message, $from);
}

if($periodicidad=="No aplica"){}else{
		// REGISTRAR CREDITO
		if($periodicidad=="quincenales"){
			$resp= $n_cuotas/2;
		}
		if($periodicidad=="semanales"){
			$resp= $n_cuotas/4;
		}
		if($periodicidad=="mensuales"){
			$resp= $n_cuotas/1;
		}
		$tiempo_meses=$resp;
		$interes=0.1;
		$interes1="'".$interes."'";
		$Casabonita="Casabonita";
		$Cobro="'".$Casabonita."'";
		$interes_mes=$total_compra*$interes;
		$tt_interes=$tiempo_meses*$interes_mes;	
		$totalapagar=$total_compra+$tt_interes;	
		$valor_cuotas=$totalapagar/$n_cuotas;
		$tt_abonos=0;
		$tt_saldo=$totalapagar;
		$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	
		$insert="INSERT INTO creditos_casa_bonita(cedula, fecha_prest, valorprestamo, tiempo_meses, interes, periodicidad, n_cuotas, valor_cuotas, totalapagar, compra_n, tt_abonos, tt_saldo, Cobro) VALUES ($cedula, $fecha, $total_compra, $tiempo_meses, $interes1, $periodicidad1, $n_cuotas1, $valor_cuotas, $totalapagar, $compra_n, $tt_abonos, $tt_saldo, $Cobro)";
		 $resultado_insert=mysqli_query($conexion,$insert) or die("problemas al insertar");
			
				if($resultado_insert){
					
					$consulta="select adddate($fecha,interval $tiempo_meses month) as sumarfecha";
					
					$resultado=mysqli_query($conexion,$consulta);
					
					if($registro=mysqli_fetch_array($resultado)){
					
					$sumarfecha=$registro['sumarfecha'];
					
					$insert1="update creditos_casa_bonita set vencimiento='$sumarfecha' where cedula='$cedula'";
					
					$resultado1=mysqli_query($conexion,$insert1);  
					}
					mysqli_close($conexion);
				
				} 
}   
?>