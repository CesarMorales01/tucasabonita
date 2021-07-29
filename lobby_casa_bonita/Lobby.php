<!DOCTYPE html>
<html>
<head>
<link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" />   
<title>Lobby</title>
</head>  
<body>
<script>
window.addEventListener('load', inicio, false);
 function inicio() {
		<?php
		if (isset($_COOKIE['baseDeDatos'])){
			 }else{
				 setcookie("baseDeDatos",$url,time()+60*60*24*365,"/");
			 }
		?>
  }
</script>
<br><br>

 <h1>Gestion de cartera Casa Bonita</h1> 

 <br><br>

  <?php

    echo '<table class="tablalistado" style="margin: 0 auto;" >';
	 echo '<tr>'; 	
      echo '<td >';

	  echo '<a href="Form_buscar_clientes_web.php">Buscar clientes</a>';

      echo '</td>';

	 echo '<td>';
	 echo '<a href="Form_lista_cotizacion.php">Precios productos</a>';
	 echo '</td>';

      echo '</tr>'; 

	  echo '<tr>';

	  echo  '<td>';

      echo '<a href="Form_Cuadrar_cuentas.php">Cuadrar cuentas</a>';

	  echo '</td>';

	  echo  '<td>';

      echo '<a href="http://tucasabonita.ga/ListaPromos.php">Promociones</a>';

	  echo '</td>'; 
	 

      echo '</tr>'; 
	 
	?> 	  	  
    </table>    
</body>
</html>