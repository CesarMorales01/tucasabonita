<html> 
  <head> 
   <link rel="StyleSheet" href="estilos.php" type="text/css">
  <title>Alerta eliminar</title> 
  </head> 
  <body>
  <br>
  <h1>Eliminar registros?</h1>
  <?PHP
echo '<form method="post" action="eliminar_caja.php">';  
if(isset($_POST['ids'])){
  $ids=$_POST['ids'];
  $size_array= count($ids, COUNT_RECURSIVE);
    for($x=0;$x<=$size_array-1;$x++){   
        echo '<input type="hidden" value='.$ids[$x].' name="ids[]">';
    }
    echo '<input type="hidden" value='.$_REQUEST['Cobro'].' name="Cobro">';  
    echo '<input   type="submit" style="background-color:red" value="Eliminar">';   	 
  }else{
    echo "<h4>No hay registros seleccionados...</h4>";
  }
?>
</body> 
</html>