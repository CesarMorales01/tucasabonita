<html>


<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Rango prestado</title>
<br>
</head>  
<body>

<?php


include("datos.php");

$fecha_inicial="'".$_REQUEST['fecha_inicial']."'";
$fecha_final="'".$_REQUEST['fecha_final']."'";
$Cobro1=trim($_REQUEST['Cobro']);
$asesor1=$_REQUEST['nombre'];
$asesor="'".$_REQUEST['nombre']."'";
echo '<h1>Total prestado '.$asesor1.'</h1>';
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
mysqli_set_charset($mysql,'utf8');
$get_asesores=$mysql->query("select nombre from asesores") or die ("problemas al consultar asesores");

// FILTRAR POR ASESORES	
echo '<h2 style=font-size:18px;> Filtrar asesor </h2>';
echo '<form action="Rango_prestado_asesorx_superusuario.php" method="post">';
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

$registros=$mysql->query("SELECT nombre, clientes.cedula, fecha_prest, valorprestamo from prestamos JOIN clientes on prestamos.cedula=clientes.cedula where asesor=$asesor and ($fecha_inicial <= fecha_prest AND fecha_prest <= $fecha_final) and prestamos.Cobro=$Cobro1 ORDER BY fecha_prest");

$registros1=$mysql->query("SELECT sum(valorprestamo) from prestamos where asesor=$asesor and ($fecha_inicial <= fecha_prest AND fecha_prest <= $fecha_final) and prestamos.Cobro=$Cobro1")  or die ("problemas en la consulta sumatorissss");

$get_from_histo=$mysql->query("SELECT sum(valorprestamo) from prestamos_historial where asesor=$asesor and ($fecha_inicial <= fecha_prest AND fecha_prest <= $fecha_final) and prestamos_historial.Cobro=$Cobro1");

$get_from_histo_lista=$mysql->query("SELECT DISTINCT prestamos_historial.fecha_prest, clientes_historial.cedula, nombre, valorprestamo from prestamos_historial JOIN clientes_historial on prestamos_historial.cedula=clientes_historial.cedula where asesor=$asesor and ($fecha_inicial <= prestamos_historial.fecha_prest AND prestamos_historial.fecha_prest <= $fecha_final) and prestamos_historial.Cobro=$Cobro1 ORDER BY fecha_prest");


$reg1=$registros1->fetch_array();

$get_histo=$get_from_histo->fetch_array();

echo '<table class="tablalistado" style="margin: 0 auto;">';

echo '<tr>';
echo '<td>';
echo "Total prestado en cuentas activas entre $_REQUEST[fecha_inicial] y $_REQUEST[fecha_final] en cartera $_REQUEST[Cobro]";
echo '</td>';  
echo '<td>';
echo number_format($reg1['sum(valorprestamo)'],2,",",".");
echo '</td>';  
echo '</tr>';
echo '</table>';
echo '<br>';

echo '<table class="tablalistado" style="margin: 0 auto;">';

echo '<tr>';
echo '<td>';
echo "Total prestado en historial entre $_REQUEST[fecha_inicial] y $_REQUEST[fecha_final] en cartera $_REQUEST[Cobro]";
echo '</td>';  
echo '<td>';
echo number_format($get_histo['sum(valorprestamo)'],2,",",".");
echo '</td>';  
echo '</tr>';
echo '</table>';
echo '<br>';

echo '<table class="tablalistado" style="margin: 0 auto;">';

echo '<tr>';
echo '<td>';
echo "Total prestado";
echo '</td>';  
echo '<td>';
$total_prestado=$get_histo['sum(valorprestamo)']+$reg1['sum(valorprestamo)'];
echo number_format($total_prestado,2,",",".");
echo '</td>';  
echo '</tr>';
echo '</table>';
echo '<br>';

echo '<table class="tablalistado1" style="margin: 0 auto;">';
echo '<tr><th colspan="5">LISTA PRESTADO EN CUENTAS ACTIVAS</th></tr>';
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha prestamo</th><th>Valor prestamo</th><th>Ver detalles</th></tr>';	

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

	$array_fechas_activas[$n]=$reg['fecha_prest']."//".$reg['nombre'];	
      echo $reg['fecha_prest'];
	$n++; 

      echo '</td>';  

	 echo '<td>';

     echo number_format($reg['valorprestamo'],2,",",".");

     echo '</td>';  
     
      echo '<td>';


     echo '<a href="Form_ detalle_cuentas_todos_superusuario.php?cedula='.$reg['cedula'].'">Ver detalles</a>';


     echo '</td>';  

	 echo '</tr>';	


	 }  


	echo '</table>';
	
	echo "<br>";
	echo "<br>";
	
echo '<table class="tablalistado1" style="margin: 0 auto;">';	
echo '<tr><th colspan="5">LISTA PRESTADO EN HISTORIAL</th></tr>';
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

	$array_fechas_histo[$n1]= $get_histo_lista['fecha_prest']."//".$get_histo_lista['nombre'];	
      echo $get_histo_lista['fecha_prest'];
	 $n1++;

      echo '</td>';  

	 echo '<td>';

     echo number_format($get_histo_lista['valorprestamo'],2,",",".");

     echo '</td>';  
     
      echo '<td>';


     echo '<a href="Ver_historial_superusuario.php?cedula='.$get_histo_lista['cedula'].'&nombre='.$get_histo_lista['nombre'].'">Ver detalles</a>';


     echo '</td>';  

	 echo '</tr>';	


	 }  


	echo '</table>';
	
	echo "<br>";
	echo "<br>";
	
	// VERIFICAR SI HAY DUPLICADOS

$size_array=count($array_fechas_histo);
$fechas_duplicadas=[];

for($z=0;$z<$size_array;$z++){
  if (in_array($array_fechas_histo[$z], $array_fechas_activas)) {
 $fechas_duplicadas[$z]=$array_fechas_histo[$z];
    }
} 
if($fechas_duplicadas!=null){
	echo "<a href='prestado_rango_duplicados_superusuario.php?fechas_duplicadas=".serialize($fechas_duplicadas)."'>Revisar registros duplicados!!!</a>"; 
}	

echo "<br>";
echo "<br>"; 

?>

</body>


</html>