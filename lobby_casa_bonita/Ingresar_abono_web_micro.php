<?PHP
error_reporting(0);    

include("datos.php");

if(isset($_COOKIE['cobrador'])){
$asesor0=$_COOKIE['cobrador'];
$fecha_prest="'".$_REQUEST['fecha_prest']."'";
$asesor1="'".trim($asesor0)."'";
$Cobro1=$_REQUEST['Cobro'];
$Cobro="'".$Cobro1."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}   

$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	

$buscar_imei="SELECT * FROM asesores where imei=$asesor1";
$get_asesor=mysqli_query($conexion,$buscar_imei);

if($get_asesor0=$get_asesor->fetch_array()){		

    $get_estado=$get_asesor0['unable'];
    $get_asesor=$get_asesor0['nombre'];		
	// BLOQUEO SEGUN HORA
	$if_blocked=$get_asesor0['time_blocked'];
	if($if_blocked==null){
	$if_blocked="25:00:00";	
	}
    
    $cedula=$_REQUEST['cedula'];
    	
    $verificar=strpos($get_estado, $Cobro1);
 
        if($verificar === false){
            
        $notificacion="En el momento no estas habilitado para ingresar informacion";
		$cedula2= base64_encode($cedula);
        header("Location: $url/Form_%20detalle_cuentas_todos_micro.php?dkfjas=$cedula2.&notificacion=$notificacion");
        } else {
			
			// inicio corchetes
						//BLOQUEO SEGUN HORA
						date_default_timezone_set('America/Bogota');
						$hora=date("H:i:s");
						 if($hora>$if_blocked){
							 $cedula2= base64_encode($cedula);
							 $notificacion="Horario limite para ingresos establecido hasta las: $if_blocked";
							 header("Location: $url/Form_%20detalle_cuentas_todos_micro.php?dkfjas=$cedula2.&notificacion=$notificacion"); 
						 }	else {

                 $asesor="'".$get_asesor."'";
                 $valor_abono=$_REQUEST['valor_abono'];
    
    
    
                        if(isset($_REQUEST['fecha'])){
        
        
        				 $fecha=$_REQUEST['fecha'];
                        }
                        
                        if($fecha==null){
    
    
    				    	date_default_timezone_set('America/Bogota');
    
    
    				    	$fecha=date("Y-m-d");
    
     
                        }
                        
                         $fecha="'".$fecha."'";
                         if($valor_abono==null){
            
            
            			 echo "Is there an income? ";
            
            
            			    }
    			    
    			$consulta="SELECT SUM(valor_abono), MAX(altura_cuota) from abonos_creditos_casa_bonita where fecha_prest=$fecha_prest and cedula=$cedula";

    			$resultado=mysqli_query($conexion,$consulta);
    
    
            			if($reg=$resultado->fetch_array()){
            
            
            				$get_total_abonado=$reg['SUM(valor_abono)'];
            				$alt_cuota=$reg['MAX(altura_cuota)'];
            				
                            } 
                            
                        if(isset($_REQUEST['altura_cuota'])){
                            $altura_cuota=$_REQUEST['altura_cuota'];
                                if($altura_cuota==null){
                                   
                                  $altura_cuota=$alt_cuota; 
                                  $altura_cuota=$altura_cuota + 1;
                                
                                }
                            
                        }  
                         
                $total_abonado= $get_total_abonado+$valor_abono;
                
                $consulta2="SELECT totalapagar FROM creditos_casa_bonita WHERE fecha_prest=$fecha_prest and CEDULA='{$cedula}'";
    
    
    			$resultado2=mysqli_query($conexion,$consulta2);
    
    
                			if($reg2=$resultado2->fetch_array()){
                
                
                				$get_total_saldo=$reg2['totalapagar'];
                
                
                		    }		
             
                
                $total_saldo=$get_total_saldo-$total_abonado;
             
              $insert_abono="INSERT INTO abonos_creditos_casa_bonita(cedula, fecha, altura_cuota, valor_abono, asesor, fingreso, Cobro, fecha_prest) VALUES ($cedula, $fecha, $altura_cuota, $valor_abono,$asesor, $get_global_fecha_hoy, $Cobro, $fecha_prest)";
    
    
    		    $actualizar_total="update creditos_casa_bonita set tt_abonos='$total_abonado', tt_saldo='$total_saldo'
    
    
    		    where fecha_prest=$fecha_prest and cedula=$cedula";
    
    
    		    $resultado_insert=mysqli_query($conexion,$insert_abono) or die ("Problems to insert!");
    
    
    	    	$resultado_actualizar=mysqli_query($conexion,$actualizar_total) or die ("Problems to update!");
                
                 	
                        	if($resultado_insert && $resultado_actualizar){
            
            
            				$notificacion="Se ha ingresado el abono";
            
							$cedula2= base64_encode($cedula);
            				header("Location:  $url/Form_%20detalle_cuentas_todos_micro.php?dkfjas=$cedula2");
            
                        } 	
                 	
                 	 }		
						
               // fin corchetes	
          	
                }
         
}                    
 
?>