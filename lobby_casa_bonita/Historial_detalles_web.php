<html>
<head>
     <link rel="StyleSheet" href="estilos.php" type="text/css">
  <title>Detalle cuenta</title>
</head>  
<body>
<br>
<?php
include("datos.php");
$cedula=$_REQUEST['cedula'];
$fecha_prest1=$_REQUEST['fecha_prest'];
$fecha_prest="'".$fecha_prest1."'";
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$registros=$mysql->query("select * from clientes_historial where cedula=$cedula and fecha_prest=$fecha_prest") or die ("problemas en la consulta");
$reg=$registros->fetch_array();
	  echo '<tr>';
      echo '<td>';
      echo "Nombre";
      echo '</td>';  
      echo $reg['nombre'];
      echo '</td>'; 
	  echo '<td>';
      echo "Cedula";
      echo '</td>';  
      echo '<td>';
      echo $reg['cedula'];
      echo '</td>'; 
	  echo '</tr>';	
	  echo '<tr>';
      echo '<td>';
      echo "Direccion domicilio";
      echo '</td>';  
      echo '<td>';
      echo $reg['direccion'];
      echo '</td>'; 
$registros1=$mysql->query("select * from creditos_casa_bonita_historial where cedula=$cedula and fecha_prest=$fecha_prest") or die ("problemas en la consulta1");	  
$reg1=$registros1->fetch_array();	  
	  echo '<td>';
      echo "Fecha de prestamo";
      echo '</td>';  
      echo '<td>';
      echo $reg1['fecha_prest'];
      echo '</td>'; 
	  echo '</tr>';
	  echo '<td>';
      echo "Telefonos";
      echo '</td>';  
      echo '<td>';
      echo $reg['telefono'];
      echo '</td>';
	  echo '<td>';
      echo "Valor del prestamo";
      echo '</td>';  
      echo '<td>';
	  echo number_format($reg1['valorprestamo'],2,",",".");
      echo '</td>';
	  echo '</tr>';
	  echo '<td>';
      echo "Direccion del trabajo";
      echo '</td>';  
      echo '<td>';
      echo $reg['direccion_trabajo'];
      echo '</td>'; 
	  echo '<td>';
      echo "Tiempo(Meses)";
      echo '</td>';  
      echo '<td>';
      echo $reg1['tiempo_meses'];
      echo '</td>'; 
	  echo '</tr>';
	  echo '<td>';
      echo "Telefono del trabajo";
      echo '</td>';  
      echo '<td>';
      echo $reg['telefono_trabajo'];
      echo '</td>'; 
	  echo '<td>';
      echo "Periodicidad";
      echo '</td>';  
      echo '<td>';
      echo $reg1['periodicidad'];
      echo '</td>'; 
	  echo '<td>';
      echo "Numero cuotas";
      echo '</td>';  
      echo '<td>';
      echo $reg1['n_cuotas'];
      echo '</td>'; 
	  echo '<td>';
      echo "Total a pagar";
      echo '</td>';  
      echo '<td>';
	  echo number_format($reg1['totalapagar'],2,",",".");
      echo '</td>';
	  echo '</tr>';
      echo "Valor de las cuotas";
      echo '</td>';  
      echo '<td>';
	  echo number_format($reg1['valor_cuotas'],2,",",".");
      echo '</td>'; 
	  echo '<td>';
      echo "Vencimiento";
      echo '</td>';  
      echo '<td>';
      echo $reg1['vencimiento'];
      echo '</td>'; 
	 echo '</tr>';
	 echo '<td>';
     echo "Total abonos";
     echo '</td>';  
     echo '<td>';
	 echo number_format($reg1['tt_abonos'],2,",",".");
     echo '</td>'; 
	 echo '<td>';
     echo "Saldo";
     echo '</td>';	  
	 echo '<td>';
	 echo number_format($reg1['tt_saldo'],2,",",".");
     echo '</td>';
	 echo '</tr>';
	 echo '</table>';
    $registros2=$mysql->query("select * from abonos_historial_casa_bonita where cedula=$cedula and fecha_prest=$fecha_prest") or die ("problemas en la consulta");	
    // TABLA ABONOS	
    echo '<br>';
echo '<br>';
    echo '<table class="tablalistado1" style="margin: 0 auto;">';
    echo '<tr><th>Fecha</th><th>Abono</th><th>Altura cuota</th><th>Asesor</th></tr>';	
    $sumar_abonos=0;
    while ($reg2=$registros2->fetch_array()){
	 echo '<tr>';
     echo '<td>';
     echo $reg2['fecha'];
     echo '</td>';  
	 echo '<td>';
	 echo number_format($reg2['valor_abono'],2,",",".");
     echo '</td>';  
	 echo '<td>';
     echo $reg2['altura_cuota'];
     echo '</td>';  
     echo $reg2['asesor'];
     echo '</td>';  
	 echo '</tr>';	
	 }  
     echo '</tr>';	 
     echo '</tr>';
  	 echo '</table>';
?>
</body>
</html>