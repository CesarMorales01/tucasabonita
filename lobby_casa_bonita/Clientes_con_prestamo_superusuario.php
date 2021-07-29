<html>

<head>

<link rel="StyleSheet" href="estilos.php" type="text/css">

<title>Lista Clientes con prestamo</title>

  <br>

</head>  

<body>
<?php

include("datos.php");
$Cobro=$_REQUEST['Cobro'];
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
mysqli_set_charset($mysql,'utf8');
$regist1=$mysql->query("SELECT COUNT(*) from clientes JOIN prestamos on clientes.cedula=prestamos.cedula where prestamos.Cobro=$Cobro");
$regist=$mysql->query("SELECT nombre, prestamos.cedula, fecha_prest, valorprestamo from clientes JOIN prestamos on clientes.cedula=prestamos.cedula where prestamos.Cobro=$Cobro");
$read1=$regist1->fetch_array();
echo '<h2>Clientes con prestamo: '.$read1['COUNT(*)'].'</h2>';

echo '<table class="tablalistado1"style="margin: 0 auto;">';
echo '<tr><th>Nombre</th><th>Cedula</th><th>Fecha prestamo</th><th>Valor prestamo</th><th>Ver detalles</th></tr>';

      
while($read=$regist->fetch_array()){
echo '<tr>';   
   echo '<td>';
    echo $read['nombre'];  
    echo '</td>'; 
    
    echo '<td>';
    echo $read['cedula'];  
    echo '</td>'; 
    
     echo '<td>';
    echo $read['fecha_prest'];  
    echo '</td>'; 
	
	echo '<td>';
	echo number_format($read['valorprestamo'],2,",",".");  
    echo '</td>'; 
    
    echo '<td>';
    echo '<a href="Form_ detalle_cuentas_todos_superusuario.php?cedula='.$read['cedula'].'">Ver Detalles</a>';
    echo '</td>'; 
	
	 echo '</tr>';
    }
    
   


 
echo '</table>';

?>

</body>

</html>