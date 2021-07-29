<html> 
  <head> 
   <link rel="StyleSheet" href="estilos.php" type="text/css">
  <title>Formulario de entrada del dato</title> 
  </head> 
  <body>
  <br>
  <h1>Eliminar abono?</h1>
  <?PHP
$id=$_REQUEST['id'];
$cedula=$_REQUEST['cedula'];
  echo '<a href="Eliminar_abono_web.php?id='.$id.'&cedula='.$cedula.'">Si. Eliminar el abono.</a>';
  ?>
</body> 
</html>
