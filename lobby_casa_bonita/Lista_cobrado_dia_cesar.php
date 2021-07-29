<html>
<head>
  <title>Detalle cuenta</title>
  <style>
  .tablalistado {
    border-collapse: collapse;
    box-shadow: 0px 0px 8px #000;
    margin:20px;
  }
  .tablalistado th{  
    border: 3px solid #FF5722;
    padding: 5px;
    background-color:#5D4037;      
  }  
  .tablalistado td{  
    border: 1px solid #000;
    padding: 5px;
    background-color:#D7CCC8;      
  }
</style>
<style>
  .tablalistado1 {
    border-collapse: collapse;
    box-shadow: 0px 0px 8px #000;
    margin:20px;
  }
  .tablalistado1 th{  
    border: 3px solid #FF5722;
    padding: 5px;
    background-color:#5D4037;      
  }  
  .tablalistado1 td{  
    border: 1px solid #000;
    padding: 5px;
    background-color:#03A9F4;      
  }
</style>
</head>  
<body>
<br>
<?php
include("datos.php");


$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
    if ($mysql->connect_error)
     die("Problemas con la conexión a la base de datos");
mysqli_set_charset($mysql,'utf8');
$registros=$mysql->query("SELECT nombre, fecha, valor_abono, asesor from abonos JOIN clientes on abonos.cedula=clientes.cedula where fecha=CURRENT_DATE and asesor='Cesar Morales'") or die ("problemas en la consulta lista clientes");

$registros1=$mysql->query("SELECT sum(valor_abono) from abonos WHERE asesor='Cesar Morales' and fecha=current_date") or die ("problemas en la consulta sumatoria");
$reg1=$registros1->fetch_array();

echo '<table class="tablalistado1">';
echo '<tr><th>Fecha</th><th>Abono</th><th>Nombre cliente</th><th>Asesor</th></tr>';	

while ($reg=$registros->fetch_array()){
	  echo '<tr>';
      echo '<td>';
      echo $reg['fecha'];
      echo '</td>';  
	  
	 echo '<td>';
     echo $reg['valor_abono'];
     echo '</td>';  
	 
	 echo '<td>';
      echo $reg['nombre'];
      echo '</td>';  
	  
	 echo '<td>';
     echo $reg['asesor'];
     echo '</td>';  
	 
	 
	 echo '</tr>';	
	 }  
	  echo '<tr>';
      echo '<td>';
      echo "Total";
      echo '</td>';  
	  
	 echo '<td>';
     echo $reg1['sum(valor_abono)'];
     echo '</td>';  
	 
     echo '</tr>';	 
    echo '</tr>';
  	echo '</table>';

?>
</body>
</html>