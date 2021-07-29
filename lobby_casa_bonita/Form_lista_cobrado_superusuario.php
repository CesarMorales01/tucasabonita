<!DOCTYPE html>
<html>

<head>

 <link rel="StyleSheet" href="estilos.php" type="text/css">    

  <title>Lista cobrado</title>

</head>  

<body>
<br>

<?php  
include("datos.php");
if(isset($_REQUEST['cobro'])){
  $sinespaciocobro=trim($_REQUEST['cobro']);
	$cobro="'".$sinespaciocobro."'";
}
if(isset($_REQUEST['asesor'])){
$asesor1 = $_REQUEST['asesor'];
 $asesor="'".$asesor1."'";
}
echo '<h3>Lista cobrado '.$asesor1.' en '.$_REQUEST['cobro'].'</h3>';
date_default_timezone_set('America/Bogota');
$get_fecha=date("Y-m-d");

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
echo '<br>';
$consultar=$mysql->query("SELECT * FROM lista_cobrado where cobro=$cobro and asesor=$asesor ORDER BY fecha DESC") or die ("problemas en consulta");
echo '<table class="tabencabezado" style="margin: 0 auto;">';

echo '<tr><th>Fecha</th> <th>Total Cobrado</th><th>Total egreso</th><th>Efectivo neto</th><th>Lista</th><th>Asesor</th></tr>';
while($get_totales=$consultar->fetch_array()){
      echo '<tr>';

      echo '<td>';

      echo $get_totales['fecha'];

      echo '</td>'; 
	  
	  echo '<td>';

      echo $get_totales['total_cobrado'];

      echo '</td>';
	  
	  echo '<td>';

      echo $get_totales['total_egresos'];

      echo '</td>';
	  
	  echo '<td>';

      echo $get_totales['total_neto'];

      echo '</td>';

	  echo '<td>';

      echo "<textarea id='text_area' rows='1' cols='30'>";
	  $var=$get_totales['lista'];
	  $token = strtok($var, ",");

		while ($token !== false){
		echo "$token\n";
		$token = strtok(",");
		}
	  echo '</textarea>';
	  echo '<br>';	
	  $id=$get_totales['id'];
      echo '<a href="ver_lista_cobrado_xdia_movil.php?id='.$id.'">Ver lista</a>';
      echo '</td>'; 
	  
	  echo '<td>';

      echo $get_totales['asesor'];

      echo '</td>';
	  echo '</tr>';
	}
   
      echo '</table>';
	  
	 
?>

</body>

</html>	  
