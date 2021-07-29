<html>

<head>

     <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Detalle cuenta</title>

</head>  

<body>
<script>
function toggle(source) {
  checkboxes = document.getElementsByName('fechas[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;	
  }
}

</script>
<br>

<?php

include("datos.php");
$cedula=$_REQUEST['cedula'];

echo '<br>';

echo '<table class="tabencabezado"style="margin: 0 auto;">';

	 echo '<tr><th colspan="3">HISTORIAL </th>  </tr>';	

	 echo '<tr>';

     echo '<td>';

      echo $_REQUEST['nombre'];

     echo '</td>';  

     echo '<td>';

      echo $_REQUEST['cedula'];

     echo '</td>'; 

	 echo '</tr>';

	 echo '</table>';



$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

mysqli_set_charset($mysql,'utf8');
$registros11=$mysql->query("select * from clientes where cedula=$cedula") or die ("No hay datos para mostrar");	  
$reg=$registros11->fetch_array();

echo '<br>';
echo '<table class="tablalistado"style="margin: 0 auto;">';
	 echo '<tr><th colspan="4">Datos Fiador</th>  </tr>';	
	 echo '<tr>';
     echo '<td>';
      echo 'Nombre fiador';
     echo '</td>';  

	  

     echo '<td>';

      echo $reg['nombre_fiador'];

     echo '</td>'; 
     
     echo '<td>';

      echo 'Direccion fiador';

     echo '</td>';  

	  

     echo '<td>';

      echo $reg['dir_fiador'];

     echo '</td>'; 

	 echo '</tr>';
	 

	 
	 echo '<tr>';

     echo '<td>';

      echo 'Telefono fiador';

     echo '</td>';  

	  

     echo '<td>';

      echo $reg['tel_fiador'];

     echo '</td>'; 
     
     echo '<td>';

      echo 'Valor letra';

     echo '</td>';  

	  

     echo '<td>';

      echo $reg['valor_letra'];

     echo '</td>'; 

	 echo '</tr>';
	 

	 echo '</table>';





echo '<br>';

echo '<br>';

$registros1=$mysql->query("select * from creditos_casa_bonita_historial where cedula=$cedula") or die ("No hay datos para mostrar");	  

echo '<table class="tablalistado"style="margin: 0 auto;">';

echo '<tr><th>Fecha de prestamo</th> <th>Valor del prestamo</th> <th>Vencimiento</th> <th>Fecha de cancelacion</th> <th>Meses vencidos</th> <th>Ver detalles</th><th>';
echo '<input type="checkbox" id="select_all" onClick="toggle(this)"/>';
echo "Seleccionar todos";
echo '</th><th>CCM</th></tr>';	
 echo '<form method="post" action="Alerta_eliminar_historial.php" id"Alerta_eliminar_historial">';
	

while ($reg=$registros1->fetch_array()){

	  echo '<tr>';

	  

      echo '<td>';

	  $fechaprestamo=$reg['fecha_prest'];

      echo $fechaprestamo;

	 echo '</td>';  

	  

	 echo '<td>';

	 echo number_format($reg['valorprestamo'],2,",",".");

     echo '</td>';  

	 

	 echo '<td>';

	 $fecha_vencimiento=$reg['vencimiento'];

     echo $fecha_vencimiento ;

	 $fecha_venci_comi="'".$fecha_vencimiento."'";

     echo '</td>';  

	 

	 echo '<td>';

	 $fecha_cancelacion=$reg['fecha_cancel'];

     echo $fecha_cancelacion;

	 $fecha_cancel_comi="'".$fecha_cancelacion."'";

     echo '</td>';  

	 

	 echo '<td>';

	 $regis=$mysql->query("SELECT datediff($fecha_cancel_comi, $fecha_venci_comi) as difer");

	 $obt=$regis->fetch_array();	

	 $obt0= $obt['difer']/30;

	 echo round($obt0,2);

     echo '</td>';

	 

	 echo '<td>';

	  echo '<a href="Historial_detalles_web.php?cedula='.$cedula.'&fecha_prest='.$reg['fecha_prest'].'">Ver detalles</a>';

      echo '</td>';	

      

      echo '<td>';
	  echo '<input type="hidden" value='.$cedula.' name="cedula">';
	  echo '<input type="hidden" value='.$_REQUEST['nombre'].' name="nombre">';
	  echo '<input type="checkbox" name="fechas[]" value="'.$reg['fecha_prest'].'"/>';
      echo '<input type="submit" style="background-color:red" value="Eliminar seleccionados">';	  
      echo '</td>';	

      

      echo '<td>';

	  echo '<a href="Form_CCM.php?cedula='.$cedula.'&fecha_vencimiento='.$fecha_vencimiento.'&nombre='.$_REQUEST['nombre'].'&fecha_cancel='.$fecha_cancelacion.'&tiempo_mora='.$obt0.'">Ir a CCM</a>';

      echo '</td>';	
	 }  
   echo '</form>';
  	echo '</table>'; 
?>

</body>

</html>