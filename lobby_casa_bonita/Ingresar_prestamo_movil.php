<?PHPinclude("datos.php");$json=array();$cedula=$_REQUEST['cedula'];$n_cuotas=$_REQUEST['n_cuotas'];$fecha_prest1=$_REQUEST['fecha_prest'];$fecha_prest="'".$fecha_prest1."'";$valorprestamo=$_REQUEST['valorprestamo'];$tiempo_meses=$_REQUEST['tiempo_meses'];$interes=$_REQUEST['interes'];$periodicidad=$_REQUEST['periodicidad'];$Cobro1=$_REQUEST['Cobro'];$Cobro="'".$Cobro1."'";$asesor0="'".$_REQUEST['asesor']."'";$buscar_imei="SELECT nombre, unable FROM asesores where imei=$asesor0";$get_asesor=mysqli_query($conexion,$buscar_imei);if($get_asesor0=$get_asesor->fetch_array()){   $get_estado=$get_asesor0['unable'];   $Cobro;   $verificar=strpos($get_estado, $Cobro1);       if($verificar === false){    echo 'Deshabilitado';    } else {                    $get_nombre_asesor=$get_asesor0['nombre'];        $asesor="'".$get_nombre_asesor."'";    $interes_mes=$valorprestamo*$interes;        $tt_interes=$tiempo_meses*$interes_mes;	        $totalapagar=$valorprestamo+$tt_interes;	        $valor_cuotas=$totalapagar/$n_cuotas;        $tt_abonos=0;        $tt_saldo=$totalapagar;             // TOTAL MESES INCLUYENDO GRATIS PARA CALCULAR VENCIMIENTO                if($periodicidad==1){                                $total_meses=$n_cuotas/30;				}if($periodicidad==2){					 $total_meses=$n_cuotas/4;				}if($periodicidad==3){					 $total_meses=$n_cuotas/2;				}if($periodicidad==4){				 $total_meses=$n_cuotas/1;				}				        $conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	     $insert="INSERT INTO prestamos(cedula, fecha_prest, valorprestamo, tiempo_meses, interes, periodicidad, n_cuotas, valor_cuotas, totalapagar, asesor, tt_abonos, tt_saldo, Cobro) VALUES ($cedula, $fecha_prest, $valorprestamo, $tiempo_meses, $interes, $periodicidad, $n_cuotas, $valor_cuotas, $totalapagar, $asesor, $tt_abonos, $tt_saldo, $Cobro)";        $resultado_insert=mysqli_query($conexion,$insert) or die("problemas al insertar");            if($resultado_insert){                        $consulta="select adddate($fecha_prest,interval $total_meses month) as sumarfecha";                        $resultado=mysqli_query($conexion,$consulta);                        if($registro=mysqli_fetch_array($resultado)){                        $sumarfecha=$registro['sumarfecha'];                        $insert1="update prestamos set vencimiento='$sumarfecha' where cedula='$cedula'";                        $resultado1=mysqli_query($conexion,$insert1);                                        }            mysqli_close($conexion);                     	echo "registra";                } else {        echo " no registra";        }    }} else {echo 'Deshabilitado'; }     ?>