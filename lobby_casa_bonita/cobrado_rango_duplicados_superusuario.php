<html>


<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Registros duplicados</title>
</head>  
<br>
<?php

echo '<h1>Registros duplicados!!!</h1>';

echo '<br>';
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
$fechas_duplicadas=unserialize($_GET['fechas_duplicadas']);
$fechas_duplicadas1 = array_values($fechas_duplicadas);
$longitud= count($fechas_duplicadas1);

$array_fechas_actives=[];
$array_nombres_actives=[];

for($i=0; $i<$longitud; $i++){
$tok = strtok($fechas_duplicadas1[$i], "//");
$array_fechas_actives[$i]= "$tok";
$tok = strtok("//");
$array_nombres_actives[$i]="$tok";  
 }

for($i=0; $i<$longitud; $i++){
$array_fechas_actives[$i];
$array_nombres_actives[$i];
 }
 
echo '<table class="tablalistado1" style="margin: 0 auto;">';
echo '<tr><th colspan="5">REGISTROS EN CUENTAS ACTIVAS</th></tr>';
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha abono</th><th>Valor abono</th><th>Ver detalles</th></tr>';

for($i=0; $i<$longitud; $i++){
$fecha_comis="'".$array_fechas_actives[$i]."'";
$nombre_comis="'".$array_nombres_actives[$i]."'";
$get_from_actives=$mysql->query("SELECT nombre, clientes.cedula, fecha, valor_abono from clientes join abonos on clientes.cedula=abonos.cedula where abonos.fecha=$fecha_comis and clientes.nombre=$nombre_comis");

if($reg=$get_from_actives->fetch_array()){	
	echo '<tr>';
    echo '<td>';
    echo $reg['nombre'];
    echo '</td>';  
	
	echo '<td>';	
    echo $reg['cedula'];
    echo '</td>'; 
	
	echo '<td>';	
    echo $reg['fecha'];
    echo '</td>';
	
	echo '<td>';	
    echo $reg['valor_abono'];
    echo '</td>'; 
	
	echo '<td>';
    echo '<a href="Form_ detalle_cuentas_todos_superusuario.php?cedula='.$reg['cedula'].'">Ver detalles</a>';
    echo '</td>';  

	 echo '</tr>';	
	}
}
echo '</table>';
echo '<br>';
echo '<br>';

echo '<table class="tablalistado1" style="margin: 0 auto;">';
echo '<tr><th colspan="5">REGISTROS EN HISTORIAL</th></tr>';
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha abono</th><th>Valor abono</th><th>Ver detalles</th></tr>';

for($i=0; $i<$longitud; $i++){
$fecha_comis="'".$array_fechas_actives[$i]."'";
$nombre_comis="'".$array_nombres_actives[$i]."'";
$get_from_histo=$mysql->query("SELECT nombre, clientes_historial.cedula, fecha, valor_abono from clientes_historial join abonos_historial on clientes_historial.cedula=abonos_historial.cedula where abonos_historial.fecha=$fecha_comis and clientes_historial.nombre=$nombre_comis");

if($reg1=$get_from_histo->fetch_array()){	
	echo '<tr>';
    echo '<td>';
    echo $reg1['nombre'];
    echo '</td>';  
	
	echo '<td>';	
    echo $reg1['cedula'];
    echo '</td>'; 
	
	echo '<td>';	
    echo $reg1['fecha'];
    echo '</td>';
	
	echo '<td>';	
    echo $reg1['valor_abono'];
    echo '</td>'; 
	
	echo '<td>';
    echo '<a href="Ver_historial_superusuario.php?cedula='.$reg1['cedula'].'&nombre='.$reg1['nombre'].'">Ver detalles</a>';
    echo '</td>';  

	 echo '</tr>';	
	}
}
echo '</table>';

?>

</body>


</html>

