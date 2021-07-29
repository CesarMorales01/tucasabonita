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
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha</th><th>Valor prestamo</th><th>Ver detalles</th></tr>';

for($i=0; $i<$longitud; $i++){
$fecha_comis="'".$array_fechas_actives[$i]."'";
$nombre_comis="'".$array_nombres_actives[$i]."'";
$get_from_actives=$mysql->query("SELECT nombre, clientes.cedula, fecha_prest, valorprestamo from clientes join prestamos on clientes.cedula=prestamos.cedula where prestamos.fecha_prest=$fecha_comis and clientes.nombre=$nombre_comis");

if($reg=$get_from_actives->fetch_array()){	
	echo '<tr>';
    echo '<td>';
    echo $reg['nombre'];
    echo '</td>';  
	
	echo '<td>';	
    echo $reg['cedula'];
    echo '</td>'; 
	
	echo '<td>';	
    echo $reg['fecha_prest'];
    echo '</td>';
	
	echo '<td>';	
    echo $reg['valorprestamo'];
    echo '</td>'; 
	
	echo '<td>';
    echo '<a href="Form_ detalle_cuentas_todos.php?cedula='.$reg['cedula'].'">Ver detalles</a>';
    echo '</td>';  

	 echo '</tr>';	
	}
}
echo '</table>';
echo '<br>';
echo '<br>';

echo '<table class="tablalistado1" style="margin: 0 auto;">';
echo '<tr><th colspan="5">REGISTROS EN HISTORIAL</th></tr>';
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha</th><th>Valor prestamo</th><th>Ver detalles</th></tr>';

for($i=0; $i<$longitud; $i++){
$fecha_comis="'".$array_fechas_actives[$i]."'";
$nombre_comis="'".$array_nombres_actives[$i]."'";
$get_from_histo=$mysql->query("SELECT DISTINCT nombre, clientes_historial.cedula, prestamos_historial.fecha_prest, valorprestamo from clientes_historial join prestamos_historial on clientes_historial.cedula=prestamos_historial.cedula where prestamos_historial.fecha_prest=$fecha_comis and clientes_historial.nombre=$nombre_comis");

if($reg1=$get_from_histo->fetch_array()){	
	echo '<tr>';
    echo '<td>';
    echo $reg1['nombre'];
    echo '</td>';  
	
	echo '<td>';	
    echo $reg1['cedula'];
    echo '</td>'; 
	
	echo '<td>';	
    echo $reg1['fecha_prest'];
    echo '</td>';
	
	echo '<td>';	
    echo $reg1['valorprestamo'];
    echo '</td>'; 
	
	echo '<td>';
    echo '<a href="Ver_historial.php?cedula='.$reg1['cedula'].'&nombre='.$reg1['nombre'].'">Ver detalles</a>';
    echo '</td>';  

	 echo '</tr>';	
	}
}
echo '</table>';

?>

</body>


</html>