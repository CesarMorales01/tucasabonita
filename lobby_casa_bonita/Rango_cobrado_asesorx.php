<html>


<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Rango cobrado asesor</title>
</head>  
<br>

<body>
<?php
include("datos.php");

$fecha_inicial="'".$_REQUEST['fecha_inicial']."'";
$fecha_final="'".$_REQUEST['fecha_final']."'";
$Cobro1=trim($_REQUEST['Cobro']);
$asesor1=$_REQUEST['nombre'];
$asesor="'".$_REQUEST['nombre']."'";
echo '<h1>Total cobrado '.$asesor1.'</h1>';
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
mysqli_set_charset($mysql,'utf8');
$get_asesores=$mysql->query("select nombre from asesores") or die ("problemas al consultar asesores");

// FILTRAR POR ASESORES	
echo '<h2 style=font-size:18px;> Filtrar asesor </h2>';
echo '<form action="Rango_cobrado_asesorx.php" method="post">';
echo '<input type="hidden" name="fecha_inicial" value="'.$_REQUEST['fecha_inicial'].'">';
echo '<input type="hidden" name="fecha_final" value="'.$_REQUEST['fecha_final'].'">';
echo '<input type="hidden" name="Cobro" value="'.$_REQUEST['Cobro'].'">';
echo '<select name="nombre">';
while ($get_ases=$get_asesores->fetch_array()) {
echo '<option value="'.$get_ases['nombre'].'">'.$get_ases['nombre'].'</option>';
} 
echo '</select>';
echo '<input type="submit" value="Filtrar">';
echo '</form>';
echo '<br>';

$registros=$mysql->query("SELECT nombre, clientes.cedula, fecha, valor_abono from abonos JOIN clientes on abonos.cedula=clientes.cedula where asesor=$asesor and ($fecha_inicial <= fecha AND fecha <= $fecha_final) and abonos.Cobro=$Cobro1 ORDER BY fecha");

$registros1=$mysql->query("SELECT sum(valor_abono) from abonos where asesor=$asesor and($fecha_inicial <= fecha AND fecha <= $fecha_final) and abonos.Cobro=$Cobro1")  or die ("problemas en la consulta sumatorissss");

$get_from_histo=$mysql->query("SELECT sum(valor_abono) from abonos_historial where asesor=$asesor and($fecha_inicial <= fecha AND fecha <= $fecha_final) and abonos_historial.Cobro=$Cobro1");

$get_from_histo_lista=$mysql->query("SELECT DISTINCT nombre, clientes_historial.cedula, fecha, valor_abono from abonos_historial JOIN clientes_historial on abonos_historial.cedula=clientes_historial.cedula where asesor=$asesor and ($fecha_inicial <= fecha AND fecha <= $fecha_final) and abonos_historial.Cobro=$Cobro1 ORDER BY fecha");

$reg1=$registros1->fetch_array();

$get_histo=$get_from_histo->fetch_array();

echo '<table class="tablalistado" style="margin: 0 auto;">';

echo '<tr>';
echo '<td>';
echo "Total abonos en cuentas activas entre $_REQUEST[fecha_inicial] y $_REQUEST[fecha_final] en cartera $_REQUEST[Cobro]";
echo '</td>';  
echo '<td>';
echo number_format($reg1['sum(valor_abono)'],2,",",".");
echo '</td>';  
echo '</tr>';
echo '</table>';
echo '<br>';


echo '<table class="tablalistado" style="margin: 0 auto;">';

echo '<tr>';
echo '<td>';
echo "Total abonos en historial entre $_REQUEST[fecha_inicial] y $_REQUEST[fecha_final] en cartera $_REQUEST[Cobro]";
echo '</td>';  
echo '<td>';
echo number_format($get_histo['sum(valor_abono)'],2,",",".");
echo '</td>';  
echo '</tr>';
echo '</table>';
echo '<br>';

echo '<table class="tablalistado" style="margin: 0 auto;">';

echo '<tr>';
echo '<td>';
echo "Total cobrado";
echo '</td>';  
echo '<td>';
$total_cobrado=$get_histo['sum(valor_abono)']+$reg1['sum(valor_abono)'];
echo number_format($total_cobrado,2,",",".");
echo '</td>';  
echo '</tr>';
echo '</table>';
echo '<br>';


echo '<table class="tablalistado1" style="margin: 0 auto;">';
echo '<tr><th colspan="5">LISTA COBRADO EN CUENTAS ACTIVAS</th></tr>';
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha abono</th><th>Valor abono</th><th>Ver detalles</th></tr>';	

$array_fechas_activas=[];
$n=0;

while ($reg=$registros->fetch_array()){
	  echo '<tr>';
      echo '<td>';
      echo $reg['nombre'];
      echo '</td>';  


	 echo '<td>';

     echo $reg['cedula'];
  
     echo '</td>';  

	 echo '<td>';
     $array_fechas_activas[$n]=$reg['fecha']."//".$reg['nombre'];		
     echo $reg['fecha'];
     $n++;    

      echo '</td>';  
	  
	 echo '<td>';
     echo number_format($reg['valor_abono'],2,",",".");
     echo '</td>';  
     
      echo '<td>';


     echo '<a href="Form_ detalle_cuentas_todos.php?cedula='.$reg['cedula'].'">Ver detalles</a>';


     echo '</td>';  

	 echo '</tr>';	


	 }  


	echo '</table>';
	
	echo "<br>";
	echo "<br>";	
echo '<table class="tablalistado1" style="margin: 0 auto;">';
echo '<tr><th colspan="5">LISTA COBRADO EN HISTORIAL</th></tr>';
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha abono</th><th>Valor abono</th><th>Ver detalles</th></tr>';	

$array_fechas_histo=[];
$n1=0;
while ($get_histo_lista=$get_from_histo_lista->fetch_array()){
	  echo '<tr>';
      echo '<td>';
      
      echo $get_histo_lista['nombre'];


      echo '</td>';  


	 echo '<td>';

    echo $get_histo_lista['cedula'];
  
     echo '</td>';  

	 echo '<td>';

     $array_fechas_histo[$n1]= $get_histo_lista['fecha']."//".$get_histo_lista['nombre'];   
     echo $get_histo_lista['fecha'];
     $n1++;

      echo '</td>';  

	 echo '<td>';

     echo number_format($get_histo_lista['valor_abono'],2,",",".");

     echo '</td>';  
     
      echo '<td>';


     echo '<a href="Ver_historial.php?cedula='.$get_histo_lista['cedula'].'&nombre='.$get_histo_lista['nombre'].'">Ver detalles</a>';


     echo '</td>';  

	 echo '</tr>';	


	 }  


	echo '</table>';
	
	echo "<br>";
	echo "<br>";
	
	// VERIFICAR SI HAY DUPLICADOS
	// ahora seria pasar el array a otra actividad para hacer un query y mostrar los resultados

$size_array=count($array_fechas_histo);
$fechas_duplicadas=[];

for($z=0;$z<$size_array;$z++){
  if (in_array($array_fechas_histo[$z], $array_fechas_activas)) {
 $fechas_duplicadas[$z]=$array_fechas_histo[$z];
    }
} 
if($fechas_duplicadas!=null){
	echo "<a href='cobrado_rango_duplicados.php?fechas_duplicadas=".serialize($fechas_duplicadas)."'>Revisar registros duplicados!!!</a>"; 
}	

echo "<br>";
echo "<br>"; 
?>


</body>


</html>