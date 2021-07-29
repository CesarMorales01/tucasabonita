	<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Salarios</title> 

  </head> 
  <body>

    <?php 
echo '<br>';
echo '  <h1>Salarios</h1>'; 
include("datos.php");
$total=null;

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexiÃ³n a la base de datos");
     
$registros=$mysql->query("select * from salarios") or die ("problemas en la consulta");

//TABLA SALARIOS
 echo '<table class="tablalistado1"style="margin: 0 auto;">';

echo '<tr><th>Fecha</th><th>Ingresos</th><th>Retiros</th><th>Comentarios</th><th>Ingreso neto </th><th>Total</th></tr>';

    while ($reg=$registros->fetch_array()) {
		
	  $id=$reg['id'];

      echo '<tr>';

      echo '<td>';
      echo $reg['Fecha'];

      echo '</td>';      

      echo '<td>';

      echo number_format($reg['Ingresos'],2,",",".");

      echo '</td>';   
      
      echo '<td>';    
      echo $reg['Retiros'];
      echo '</td>'; 
	  echo '<td>';
	
      echo $reg['Comentarios'];      

      echo '</td>'; 
      
      echo '<td>';
      
      echo number_format($reg['Ingreso_neto'],2,",",".");

      echo '</td>';
   
      echo '<td>';
      echo number_format($reg['Total'],2,",",".");      	  
      echo '</td>';
      echo '</tr>';      

    } 

echo '</table>'; 

?>

   
</body>

</html>