<html> 
  <head> 
   <link rel="StyleSheet" href="estilos.php" type="text/css">
  <title>Alerta eliminar</title> 
  </head> 
  <body>
  <br>
  <h1>Eliminar registro?</h1>
  <?PHP
$id=$_REQUEST['id'];
$Cobro=$_REQUEST['Cobro'];
echo '<a href="eliminar_caja_superusuario.php?id='.$id.'&Cobro='.$Cobro.'">Si. Eliminar registro.</a>';
  ?>
</body> 
</html>