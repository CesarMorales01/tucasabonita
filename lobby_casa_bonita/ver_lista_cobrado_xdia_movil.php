<!DOCTYPE html>
<html>

<head>

 <link rel="StyleSheet" href="estilos.php" type="text/css">    

  <title>Lista cobrado dia</title>

</head>  

<body>
<br><br>

<?php  
include("datos.php");
if(isset($_REQUEST['id'])){
	$id="'".$_REQUEST['id']."'";
}

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexiÃ³n a la base de datos");

$consultar=$mysql->query("SELECT * FROM lista_cobrado where id=$id") or die ("problemas en consultar totales");
echo '<table class="tabencabezado" style="margin: 0 auto;">';


if($get_totales=$consultar->fetch_array()){
	echo '<h1>Lista cobrado '.$get_totales['fecha'].'</h1>';
	 echo '<tr>';
	  echo  '<th>Total Cobrado</th>';
	  echo '</tr>';
	  
	  echo '<tr>';
	  echo '<td>';
      echo $get_totales['total_cobrado'];
      echo '</td>';
	  echo '</tr>';
	  
	  echo '<tr>';
	  echo  '<th>Total Gastado</th>';
	  echo '</tr>';
	  
	  echo '<tr>';
	  echo '<td>';
      echo $get_totales['total_egresos'];
      echo '</td>';
	  echo '</tr>';
	  
	  echo '<tr>';
	  echo  '<th>Efectivo neto</th>';
	  echo '</tr>';
	  
	  echo '<tr>';
	  echo '<td>';
      echo $get_totales['total_neto'];
      echo '</td>';
	 echo '</tr>';	
	  
		
	 echo '<tr>';
	  echo  '<th>Lista</th>';
	  echo '</tr>';	
  
	echo '<tr>';
	echo '<td>';
	  $var=$get_totales['lista'];
	  $token = strtok($var, ",");

		while ($token !== false){
		echo "$token";
		echo '<br>';
		$token = strtok(",");
		}
	  echo '</td>';
	  echo '</tr>';
	}
   
      echo '</table>';
	  
	 
?>

</body>

</html>	  
