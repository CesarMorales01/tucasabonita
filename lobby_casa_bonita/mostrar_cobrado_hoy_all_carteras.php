<html>
<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Lista cobrado todas las carteras hoy</title>
</head>  
<body>
<br>
<h2 >Lista cobrado en el dia todas las carteras</h2>
<form method="post" action="mostrar_cobrado_hoy_all_carteras.php">
<strong>Elegir fecha:</strong> 
<br><br>
<?PHP    
date_default_timezone_set('America/Bogota');
$fecha_hoy=date("Y-m-d"); 
?>
<input type="date" size="8" name="fecha" value="<?PHP echo $fecha_hoy ?>">
<br><br> 
<input type="submit" class="botonsubmit" value="Filtrar">
</form> 
<a href="Form_Cuadrar_cuentas.php">Regresar a cuadrar cuentas</a>
<br><br>
<?php
include("datos.php");
$Cobro= $_REQUEST['Cobro'];
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
mysqli_set_charset($mysql,'utf8');
$get_carte=$mysql->query("SELECT * from Carteras") or die ("problemas en la consulta carteras");
$carteras=[];
while ($getC=$get_carte->fetch_array()){
     $carteras[]=$getC['Nombre'];   
}
$fecha=$_REQUEST['fecha'];
if($fecha==""){
    $fecha=$get_global_fecha_hoy_comis;
}
$fecha="'".$fecha."'";
$num=count($carteras);
for($i=0;$i<$num;$i++){
$carte_comi="'".$carteras[$i]."'";
$registros=$mysql->query("SELECT nombre, fecha, valor_abono, fingreso,  asesor from abonos JOIN clientes on abonos.cedula=clientes.cedula where fingreso=$fecha and abonos.Cobro=$carte_comi") or die ("problemas en la consulta lista clientes");
echo '<table class="tablalistado1"style="margin: 0 auto;">';
echo '<tr>';
echo '<th colspan="5">';
echo $carteras[$i];
echo '</th>';
echo '</tr>';  
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

$registros1=$mysql->query("SELECT sum(valor_abono) from abonos WHERE fingreso=$fecha and abonos.Cobro=$carte_comi") or die ("problemas en la consulta sumatoria");
$reg1=$registros1->fetch_array();
echo '<tr>';
echo '<td>';
echo "Total";
echo '</td>';  
echo '<td>';
echo number_format($reg1['sum(valor_abono)'],2,",",".");    
echo '</td>';   
echo '</tr>';
}

// CONSULTAR ABONOS INGRESADO CASA BONITA
$registros_casa=$mysql->query("SELECT nombre, fecha, valor_abono, fingreso,  asesor from abonos_creditos_casa_bonita JOIN clientes on abonos_creditos_casa_bonita.cedula=clientes.cedula where fingreso=$fecha") or die ("problemas en la consulta casab");
echo '<table class="tablalistado1"style="margin: 0 auto;">';
echo '<tr>';
echo '<th colspan="5">';
echo "Casa bonita";
echo '</th>';
echo '</tr>'; 
echo '<tr><th>Fecha</th><th>Abono</th><th>Nombre cliente</th><th>Asesor</th><th>F. Ingreso</th></tr>';	
    while ($reg_c=$registros_casa->fetch_array()){  
        echo '<tr>';
        echo '<td>';
        echo $reg_c['fecha'];
        echo '</td>';  
        echo '<td>';
        echo number_format($reg_c['valor_abono'],2,",",".");
        echo '</td>';  
        echo '<td>';
        echo $reg_c['nombre'];
        echo '</td>';  
        echo '<td>';
        echo $reg_c['asesor'];
        echo '</td>'; 
        echo '<td>';
        echo $reg_c['fingreso'];
        echo '</td>';
        echo '</tr>';	
    } 

$registros_casa_b=$mysql->query("SELECT sum(valor_abono) from abonos_creditos_casa_bonita WHERE fingreso=$fecha") or die ("problemas en la consulta sumatoria casa");
$reg_ca=$registros_casa_b->fetch_array();
echo '<tr>';
echo '<td>';
echo "Total";
echo '</td>';  
echo '<td>';
echo number_format($reg_ca['sum(valor_abono)'],2,",",".");    
echo '</td>';  
echo '</tr>';	 
echo '</tr>';
?>    
</body>
</html>