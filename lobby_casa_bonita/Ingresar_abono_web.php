<?phperror_reporting(0);include("datos.php");$fecha_prest="'".$_REQUEST['fecha_prest']."'";$cedula=$_REQUEST['cedula'];$valor_abono=$_REQUEST['valor_abono'];$Cobro1=$_REQUEST['Cobro'];$Cobro="'".$Cobro1."'";if(isset($_REQUEST['fecha'])){	$fecha=$_REQUEST['fecha'];	if($fecha==null){	date_default_timezone_set('America/Bogota');	$fecha=date("Y-m-d");	}}			$fecha="'".$fecha."'";			$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);				$consulta="SELECT SUM(valor_abono), MAX(altura_cuota) from abonos_creditos_casa_bonita where fecha_prest=$fecha_prest and cedula=$cedula";			$resultado=mysqli_query($conexion,$consulta);if($reg=mysqli_fetch_array($resultado)){ $get_total_abonado=$reg['SUM(valor_abono)'];} $total_abonado= $get_total_abonado+$valor_abono;							if(isset($_REQUEST['altura_cuota'])){				$altura_cuota=$_REQUEST['altura_cuota'];					if($altura_cuota==null){					$cal_altura_cuota=$reg['MAX(altura_cuota)'];					$altura_cuota=$cal_altura_cuota + 1;							}							}					$cedula1="'".$cedula."'";	  $consulta2="SELECT totalapagar FROM creditos_casa_bonita WHERE fecha_prest=$fecha_prest and CEDULA=$cedula1";	  $resultado2=mysqli_query($conexion,$consulta2);	  if($reg2=mysqli_fetch_array($resultado2)){		 $get_total_saldo=$reg2['totalapagar'];		}	$total_saldo=$get_total_saldo-$total_abonado;if(isset($_COOKIE['cobrador'])){$asesor0=$_COOKIE['cobrador'];$asesor0="'".$asesor0."'";} else { $notificacion="Se requiere iniciar sesión!"; header("Location:  $url/Form_login.php?notificacion=$notificacion");  }  /*$buscar_imei="SELECT nombre FROM asesores where imei=$asesor0";     $get_asesor=mysqli_query($conexion,$buscar_imei);        if($get_asesor0=mysqli_fetch_array($get_asesor)){       $get_nombre_asesor=$get_asesor0['nombre'];      }$asesor="'".$get_nombre_asesor."'";*/$asesor="Cesar_CPU";$asesor="'".$asesor."'";echo $insert_abono="INSERT INTO abonos_creditos_casa_bonita(cedula, fecha, altura_cuota, valor_abono, asesor, fingreso, Cobro, fecha_prest) VALUES (		$cedula, $fecha, $altura_cuota, $valor_abono,$asesor, $get_global_fecha_hoy, $Cobro, $fecha_prest)";		$actualizar_total="update creditos_casa_bonita set tt_abonos='$total_abonado', tt_saldo='$total_saldo'		where fecha_prest=$fecha_prest and cedula=$cedula";		$resultado_insert=mysqli_query($conexion,$insert_abono) or die ("Problems to insert!");		$resultado_actualizar=mysqli_query($conexion,$actualizar_total) or die ("Problems to update!");				if($resultado_insert && $resultado_actualizar){                header("Location:  $url/Form_%20detalle_cuentas_todos.php?cedula=$cedula");				}?>