<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Total Cobrado</title> 

  </head> 

  <body>

  <br>
 
  <h1>Ingresa el rango de fecha a consultar</h1>
<div id="contenedor"> 
   <form method="post" action="Rango_cobrado_micro.php"> 

   Fecha inicial:
<?PHP    
date_default_timezone_set('America/Bogota');
$fecha=date("Y-m-d"); 
$finicial = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
$finicial = date ("Y-m-d" , $finicial );
?>
  <input type="date" size="8" name="fecha_inicial" value="<?PHP
  echo $finicial ?>"> 
  <br> <br> 
 Fecha final:

  <input type="date" size="8" name="fecha_final" value="<?PHP
  echo $fecha ?>"> 

  <br> <br> 
   <input type="hidden" name="Cobro" value="<?php
  echo $_REQUEST['Cobro'];?>">
  <input type="hidden" name="nombre" value="<?php
  echo $_REQUEST['nombre'];?>">
  

  <input type="submit" class="botonsubmit" value="Consultar"> 

  </form>
</div>
</body> 

</html>