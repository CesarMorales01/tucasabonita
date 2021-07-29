<html>
<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Lista cobrado</title>
</head>  
<body>
<br>
<?php
include("datos.php");
$fecha1=$_REQUEST['fecha'];
$Cobro=$_REQUEST['Cobro'];
if($fecha1==null){
date_default_timezone_set('America/Los_Angeles');
$get_fecha=date("Y-m-d");
$fecha1=$get_fecha;
}
 // variable para usar en filtrar
 $fecha0= $fecha1;
 $fecha="'".$fecha1."'";
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");

$mysql->set_charset("utf8");
$registros=$mysql->query("SELECT nombre, fecha, valor_abono, asesor,fingreso from abonos_creditos_casa_bonita JOIN clientes on abonos_creditos_casa_bonita.cedula=clientes.cedula where fingreso=$fecha") or die ("problemas en la consulta lista clientes");
$registros1=$mysql->query("SELECT sum(valor_abono) from abonos_creditos_casa_bonita WHERE fingreso=$fecha") or die ("problemas en la consulta sumatoria");
$reg1=$registros1->fetch_array();
echo '<table class="tablalistado1" style="margin: 0 auto;">';
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
	echo '</table>';
	
	echo "<br>";
	echo "<br>";	
	
// FILTRAR POR ASESORES	
echo '<h1> Filtrar asesor </h1>';
echo '<form action="Lista_cobrado_dia_asesorx.php" method="post">';
echo '<input type="hidden" name="fecha" value="'.$fecha0.'">';
echo '<input type="hidden" name="Cobro" value="'.$Cobro.'">';
echo '<select name="nombre">';
while ($reg=$registros0->fetch_array()) {
echo '<option value="'.$reg['nombre'].'">'.$reg['nombre'].'</option>';
} 
echo '</select>';
echo '<input type="submit" value="Filtrar">';
echo '</form>';
echo '<br>';
?>

</body>


</html>