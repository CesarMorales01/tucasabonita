<?PHP
//error_reporting(0);
include("datos.php");

$Cobro1=$_REQUEST['Cobro'];
$Cobro="'".$Cobro1."'";

$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	
 
 if(isset($_COOKIE['cobrador'])){
$asesor0 ="'".$_COOKIE['cobrador']."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}   

$buscar_imei="SELECT nombre, unable FROM asesores where imei=$asesor0";

$get_asesor=mysqli_query($conexion,$buscar_imei);

if($get_asesor0=$get_asesor->fetch_array()){

$get_estado=$get_asesor0['unable'];

$cedula=$_REQUEST['cedula'];
$verificar = strpos($get_estado, $Cobro1);

if($verificar === false){
$cedula2= base64_encode($cedula);        
$notificacion="En el momento no estas habilitado para ingresar informacion";
header("Location: $url/Form_%20detalle_cuentas_todos_micro.php?dkfjas=$cedula2.&notificacion=$notificacion");
    } else {
	
	$asesor3=$get_asesor0['nombre'];	

   $asesor="'".$asesor3."'";

	$fecha_prest=$_REQUEST['fecha_prest'];

	$valorprestamo=$_REQUEST['valorprestamo'];

	$tiempo_meses=$_REQUEST['tiempo_meses'];

	$interes1=$_REQUEST['interes'];

	$periodicidad=$_REQUEST['periodicidad'];

	$n_cuotas=$_REQUEST['n_cuotas'];


	if($fecha_prest==null){

			date_default_timezone_set('America/Los_Angeles');

			$get_fecha=date("Y-m-d");

            $fecha_prest=$get_fecha;

			}

			$fecha_prest="'".$fecha_prest."'";


			if($tiempo_meses==null){

			$tiempo_meses=2;

			}

			if($interes1==null){

			$interes1=10;

			}
			$interes=$interes1/100;
			
				if($periodicidad=="diario"){

		    $periodicidad=1;

		    }if ($periodicidad=="semanal"){

			$periodicidad=2;

		    }if ($periodicidad=="quincenal"){

			$periodicidad=3;

		    }if($periodicidad=="mensual"){

			$periodicidad=4;

		    }

			

			if($n_cuotas==null){

			    if($periodicidad==1){

					$tt_cuotas=30;

				}if($periodicidad==2){

					$tt_cuotas=4;

				}if($periodicidad==3){

					$tt_cuotas=2;

				}if($periodicidad==4){

					$tt_cuotas=1;

				}

				$n_cuotas=$tiempo_meses*$tt_cuotas;

			    }
				
				   
                // TOTAL MESES INCLUYENDO GRATIS PARA CALCULAR VENCIMIENTO
                if($periodicidad==1){
                
                $total_meses=$n_cuotas/30;

				}if($periodicidad==2){

					 $total_meses=$n_cuotas/4;

				}if($periodicidad==3){

					 $total_meses=$n_cuotas/2;

				}if($periodicidad==4){

				 $total_meses=$n_cuotas/1;

				}	
				$interes_mes=$valorprestamo*$interes;

			$tt_interes=$tiempo_meses*$interes_mes;	

			$totalapagar=$valorprestamo+$tt_interes;	

			$valor_cuotas=$totalapagar/$n_cuotas;

			$tt_abonos=0;

			$tt_saldo=$totalapagar;

		$insert="INSERT INTO prestamos(cedula, fecha_prest, valorprestamo, tiempo_meses, interes, periodicidad, n_cuotas, valor_cuotas, totalapagar, asesor, tt_abonos,tt_saldo, Cobro) VALUES (

		$cedula, $fecha_prest, $valorprestamo, $tiempo_meses, $interes, $periodicidad, $n_cuotas, $valor_cuotas, $totalapagar, $asesor, $tt_abonos, $tt_saldo, $Cobro)"; 

		

		$resultado_insert=mysqli_query($conexion,$insert);
		
		if($resultado_insert){

		$consulta="select adddate($fecha_prest,interval $total_meses month) as sumarfecha";

		$resultado=mysqli_query($conexion,$consulta);

		if($registro=mysqli_fetch_array($resultado)){

					$sumarfecha=$registro['sumarfecha'];

					$insert1="update prestamos set vencimiento='$sumarfecha' where cedula='$cedula'";

					$resultado1=mysqli_query($conexion,$insert1);

					$notificacion="Se ha ingresado el prestamo";
					 $cedula2= base64_encode($cedula);
					header("Location: $url/Form_%20detalle_cuentas_todos_superusuario.php?dkfjas=$cedula2");	

				}

				mysqli_close($conexion);

				

			}

	
	}	
}

?>