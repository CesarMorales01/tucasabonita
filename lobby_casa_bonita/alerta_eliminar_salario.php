<html> 
  <head> 
   <link rel="StyleSheet" href="estilos.php" type="text/css">
  <title>Formulario de entrada del dato</title> 
  </head> 
  <body>
  <br>
  <h1>Eliminar entrada?</h1>
  <?PHP
$id=$_REQUEST['id'];
  echo '<a href="Eliminar_entrada_salario.php?id='.$id.'">Si. Eliminar entrada.</a>';
  ?>
</body> 
</html>
