<html> 
  <head> 
   <link rel="StyleSheet" href="estilos.php" type="text/css">
  <title>Formulario Eliminar asesor</title> 
  </head> 
  <body>
  <br>
  <h1>Eliminar asesor?</h1>
  <?PHP
$imei=$_REQUEST['imei'];
  echo '<a href="Eliminar_asesor.php?imei='.$imei.'">Si. Eliminar este asesor.</a>';
  ?>
</body> 
</html>
