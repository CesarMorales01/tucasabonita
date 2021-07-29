<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Formulario Eliminar asesor</title> 

  </head> 

  <body>

  <br>

  <h1>Eliminar registro?</h1>

  <?PHP
$id=$_REQUEST['id'];
  echo '<a href="Eliminar_registro_lista_cobrado_superusuario.php?id='.$id.'&cartera='.$_REQUEST['cartera'].'">Si. Eliminar este registro.</a>';

  ?>

</body> 

</html>
