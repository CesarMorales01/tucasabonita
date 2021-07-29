<html>
<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Lista cobrado hoy</title>
</head>  
<body>
<br>
<h2 >Lista cobrado en el dia todo</h2>
<br>
<form method="post" action="mostrar_cobrado_hoy_all_carteras.php">
<input  class="botonsubmit" type="submit" value="Mostrar cobrado en todas las carteras">
<br><br>
<?php
include("datos.php");
$Cobro= $_REQUEST['Cobro'];
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
mysqli_set_charset($mysql,'utf8');
$registros=$mysql->query("SELECT nombre, fecha, valor_abono, fingreso, asesor from abonos_creditos_casa_bonita JOIN clientes on abonos_creditos_casa_bonita.cedula=clientes.cedula where fingreso=$get_global_fecha_hoy") or die ("problemas en la consulta lista clientes");


$registros1=$mysql->query("SELECT sum(valor_abono) from abonos_creditos_casa_bonita WHERE fingreso=$get_global_fecha_hoy") or die ("problemas en la consulta sumatoria");

$reg1=$registros1->fetch_array();

echo '<table class="tablalistado1"style="margin: 0 auto;">';


echo '<tr><th>Fecha</th><th>Abono</th><th>Nombre cliente</th><th>Asesor</th><th>F. Ingreso</th></tr>';	

while ($reg=$registros->fetch_array()){

	  echo '<tr>';

      echo '<td>';

      echo $reg['fecha'];

      echo '</td>';  

	 echo '<td>';

    echo number_format($reg['valor_abono'],2,",",".");

     echo '</td>';  

	 echo '<td>';

      echo $reg['nombre'];

      echo '</td>';  

	 echo '<td>';

     echo $reg['asesor'];


     echo '</td>'; 

      echo '<td>';


     echo $reg['fingreso'];


     echo '</td>';

	 echo '</tr>';	

	 }  

	  echo '<tr>';

      echo '<td>';


      echo "Total";


      echo '</td>';  

	 echo '<td>';

     echo number_format($reg1['sum(valor_abono)'],2,",",".");    
    
     echo '</td>';  

     echo '</tr>';	 


    echo '</tr>';


  	echo '</table>';
?>
</body>
</html>