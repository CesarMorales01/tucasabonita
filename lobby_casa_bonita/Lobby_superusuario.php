<?php
include("datos.php");
echo '<a href="Cerrar_sesion.php" style="float:right"></a>';
?>
<!doctype html>

<html>

<head>
<link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" />  
  <title>Gestion de Cartera</title>



</head> 

<body>

<br><br>

 <h1>Gestion de cartera</h1> 

 <br><br>

  <?php

    echo '<table class="tablalistado" style="margin: 0 auto;" >';

      echo '<td >';

	  echo '<a href="Form_buscar_clientes_web_superusuario.php">Buscar clientes</a>';

      echo '</td>';

	  echo '<td>';

	  echo '<A href="Form_Ingresar_clientes_superusuario.php">Registrar clientes</A>';

      echo '</td>'; 
	  
      echo '</tr>'; 

      

	  echo '<tr>';

	  echo  '<td colspan="2">';

      echo '<a href="Form_Cuadrar_cuentas_superusuario.php">Cuadrar cuentas</a>';

	  echo '</td>';

	  echo  '</tr>';

    echo '<table>';    

  ?>  

</body>

</html>