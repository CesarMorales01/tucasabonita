<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Eliminar historial totales</title> 

  </head> 

  <body>

  <br>

  <h1>Eliminar historial totales?</h1>

  <?PHP
echo '<form method="post" action="Eliminar_historial_totales.php">';
if(isset($_POST['idTotales'])){
$idTotales=$_POST['idTotales'];
$size_array=count($idTotales, COUNT_RECURSIVE);
	for($x=0;$x<=$size_array-1;$x++){ 
	  echo '<input type="hidden" value='.$idTotales[$x].' name="id[]">';
	} 
}
echo '<input type="hidden" value='.$_REQUEST['Cobro'].' name="Cobro">';
echo '<input   type="submit" style="background-color:red" value="Eliminar historial totales">';	
  ?>

</body> 

</html>