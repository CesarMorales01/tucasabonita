<html>


<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Rango vendido</title>
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
echo '<h1>Total vendido '.$asesor1.'</h1>';
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
mysqli_set_charset($mysql,'utf8');
$registros=$mysql->query("SELECT nombre, clientes.cedula, fecha_prest, valorprestamo from creditos_casa_bonita JOIN clientes on creditos_casa_bonita.cedula=clientes.cedula where asesor=$asesor and ($fecha_inicial <= fecha_prest AND fecha_prest <= $fecha_final) ORDER BY fecha_prest");
$registros1=$mysql->query("SELECT sum(valorprestamo) from creditos_casa_bonita where asesor=$asesor and ($fecha_inicial <= fecha_prest AND fecha_prest <= $fecha_final)")  or die ("problemas en la consulta sumatorissss");
$get_from_histo=$mysql->query("SELECT sum(valorprestamo) from prestamos_historial where asesor=$asesor and ($fecha_inicial <= fecha_prest AND fecha_prest <= $fecha_final) and prestamos_historial.Cobro=$Cobro1");
$get_from_histo_lista=$mysql->query("SELECT DISTINCT prestamos_historial.fecha_prest, clientes_historial.cedula, nombre, valorprestamo from prestamos_historial JOIN clientes_historial on prestamos_historial.cedula=clientes_historial.cedula where asesor=$asesor and ($fecha_inicial <= prestamos_historial.fecha_prest AND prestamos_historial.fecha_prest <= $fecha_final) and prestamos_historial.Cobro=$Cobro1 ORDER BY fecha_prest");
$contado="contado";
$contado="'".$contado."'";
$get_contado_total=$mysql->query("select sum(total_compra) from lista_compras where comentarios=$asesor and medio_de_pago=$contado and ($fecha_inicial <= fecha AND fecha <= $fecha_final)") or die ("problemas al consultar total contados");
$get_total_contado=$get_contado_total->fetch_array();

$reg1=$registros1->fetch_array();

$get_histo=$get_from_histo->fetch_array();

echo '<table class="tablalistado" style="margin: 0 auto;">';

echo '<tr>';
echo '<td>';
echo "Total creditos en cuentas activas entre $_REQUEST[fecha_inicial] y $_REQUEST[fecha_final] en cartera $_REQUEST[Cobro]";
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
echo "Total creditos en historial entre $_REQUEST[fecha_inicial] y $_REQUEST[fecha_final] en cartera $_REQUEST[Cobro]";
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
echo "Total ventas de contado entre $_REQUEST[fecha_inicial] y $_REQUEST[fecha_final]";
echo '</td>';  
echo '<td>';
echo number_format($get_total_contado['sum(total_compra)'],2,",",".");
echo '</td>';  
echo '</tr>';
echo '</table>';

echo '<br>';
echo '<table class="tablalistado" style="margin: 0 auto;">';

echo '<tr>';
echo '<td>';
echo "Total creditos";
echo '</td>';  
echo '<td>';
$total_prestado=$get_histo['sum(valorprestamo)']+$reg1['sum(valorprestamo)']+$get_total_contado['sum(total_compra)'];
echo number_format($total_prestado,2,",",".");
echo '</td>';  
echo '</tr>';
echo '</table>';
echo '<br>';

echo '<table class="tablalistado1" style="margin: 0 auto;">';
echo '<tr><th colspan="5">LISTA CREDITOS EN CUENTAS ACTIVAS</th></tr>';
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha credito</th><th>Valor credito</th><th>Ver detalles</th></tr>';	

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


     echo '<a href="Form_ detalle_cuentas_todos_micro.php?cedula='.$reg['cedula'].'">Ver detalles</a>';


     echo '</td>';  

	 echo '</tr>';	


	 }  


	echo '</table>';
	
	echo "<br>";
	echo "<br>";
	
echo '<table class="tablalistado1" style="margin: 0 auto;">';	
echo '<tr><th colspan="5">LISTA VENDIDO EN HISTORIAL</th></tr>';
echo '<tr><th>Cliente</th><th>Cedula</th><th>Fecha abono</th><th>Valor abono</th><th>Ver detalles</th></tr>';	

$array_fechas_histo=[];
$n1=0;
/*
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


     echo '<a href="Ver_historial_micro.php?cedula='.$get_histo_lista['cedula'].'&nombre='.$get_histo_lista['nombre'].'">Ver detalles</a>';


     echo '</td>';  

	 echo '</tr>';	


	 }  

*/
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
	echo "<a href='prestado_rango_duplicados_micro.php?fechas_duplicadas=".serialize($fechas_duplicadas)."'>Revisar registros duplicados!!!</a>"; 
}	

echo "<br>";
echo "<br>"; 
$get_detalle_contado=$mysql->query("select * from lista_compras where comentarios=$asesor and medio_de_pago=$contado and ($fecha_inicial <= fecha AND fecha <= $fecha_final)") or die ("problemas al consultar detalle contados");
echo '<table class="tablalistado1" style="margin: 0 auto;">';
echo '<tr><th colspan="3">LISTA VENTAS DE CONTADO</th></tr>';
echo '<tr><th>Cliente</th><th>Fecha venta</th><th>Valor venta</th></tr>';
while ($items=$get_detalle_contado->fetch_array()){  
   $cedula=$items['cliente']; 
    echo '<tr class="table-success" >';
    echo '<td>';
        $getCliente=$mysql->query("select * from clientes where cedula=$cedula") or die ("problemas al consultar cliente");
        if($info=$getCliente->fetch_array()){
            echo '<a href="http://tucasabonita.ga/lobby_casa_bonita/Form_%20detalle_cuentas_todos_micro.php?cedula=';
            echo $info['cedula'];
            echo '">';
            echo  $info['nombre'];
            echo '</a>';
        }
    echo '</td>';
    echo '<td>';
    echo  $items['fecha'];
    echo '</td>';
    echo '<td>';   
			echo number_format($items['total_compra'],2,",",".");
    echo '</td>';
    echo '</tr>';
    }
?>

</body>


</html>