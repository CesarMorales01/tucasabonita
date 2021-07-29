<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Cuadrando Caja</title> 

  </head> 
  <body>

    <?php 
echo $estilos;    
if(isset($_REQUEST['Cobro'])){
   $Cobro1=$_REQUEST['Cobro'];
	$Cobro="'".$Cobro1."'";
} 
$total_caja=null;
echo '<br>';
echo '  <h1>Caja '.$Cobro1.'</h1>'; 
include("datos.php");

date_default_timezone_set('America/Bogota');
$get_fecha=date("Y-m-d");

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
     
$registros=$mysql->query("select * from caja where Cobro=$Cobro") or die ("problemas en la consulta");


echo '<br>';



//TABLA CONSULTAR HISTORIAL CAJA
 echo '<table class="tablalistado1"style="margin: 0 auto;">';

    echo '<tr><th>Fecha</th><th>Ingresos</th><th>Otros ingresos</th><th>Observaciones</th><th>Total ingresos</th>

         <th>Prestado</th><th>Gastos</th><th>Observaciones</th><th>Total Egresos</th><th>Ingresos netos</th><th>Total caja</th><th>Ingresado por</th></tr>';

    while ($reg=$registros->fetch_array()) {
		
	  $id=$reg['id'];

      echo '<tr>';

      echo '<td>';

      echo $reg['fecha'];

      echo '</td>';      

      echo '<td>';

      echo number_format($reg['cobrado'],2,",",".");

      echo '</td>'; 
		
		echo '<td>';    
      echo $reg['otros_ingresos'];
      echo '</td>'; 
      
      echo '<td>';

      echo $reg['comentario_ingresos'];      

      echo '</td>'; 
      
      echo '<td>';
      
      echo number_format($reg['total_ingresos'],2,",",".");

      echo '</td>';
   
      echo '<td>';

      echo number_format($reg['prestado'],2,",",".");      

      echo '</td>';
      
      echo '<td>';
      
      echo number_format($reg['otros_gastos'],2,",",".");      

      echo '</td>';
	  
	  echo '<td>';
        
      echo $reg['comentario_egresos'];     

      echo '</td>';
      
      echo '<td>';
        
      echo number_format($reg['total_egresos'],2,",",".");     

      echo '</td>';
      
      echo '<td>';
      echo number_format($reg['entradas_neto'],2,",",".");      
      echo '</td>';
	  
	  echo '<td>';
	  $total_caja=$reg['total_caja'];
      echo number_format($reg['total_caja'],2,",",".");     
      echo '</td>';
	  
	  echo '<td>';
	  echo $reg['asesor'];  
	  if($get_fecha==$reg['fecha']){
	   echo '<br>';
	   echo '<a href="alerta_eliminar_caja_micro.php?id='.$reg['id'].'&Cobro='.$Cobro1.'" >Eliminar registro</a>';  
	 } 
      echo '</td>';
      echo '</tr>';      

    } 
	if($total_caja==null){
		echo 'No se han encontrado registros. Puedes ir a "Realizar nuevo registro" para efectuar el primer registro.';
		$total_caja=0;
	}

echo '</table>'; 
 //CONSULTAR NUMERO DE FILAS EN LA TABLA CAJA
$n_registros=mysqli_num_rows($registros);
 
 // CONSULTAR INGRESO MAS ANTIGUO PARA ELIMINARLO
 
$check_ufecha=$mysql->query("select min(id) from caja where Cobro=$Cobro") or die ("check_ufecha");

 if($get_ufecha=$check_ufecha->fetch_array()){
 $ufecha=$get_ufecha['min(id)'];  

 }
 

 if($n_registros>31){
$borrar_uid=$mysql->query("delete from caja where id=$ufecha") or die ("Problemas borrar primera fila");
 }
 echo '<br>';
echo '<form method="post" action="nuevo_ingreso_micro.php">';
echo '<input type="hidden" name="Cobro" value="'.$Cobro1.'">';
echo '<input type="checkbox" name="ifcaja" value="concaja" > Tener en cuenta valor de caja anterior.';
echo '<br>';
echo '<input type="hidden" name="total_caja" value="'.$total_caja.'">';   
echo '<input class="botonsubmit" type="submit" value="Realizar nuevo ingreso">';

echo '</table>';
echo '<br>';
echo '<br>';
echo '<a href="Cuadrar_cuentas_microcreditos.php">Ir a cuadrar cuentas</a>';

?>

   
</body>

</html>