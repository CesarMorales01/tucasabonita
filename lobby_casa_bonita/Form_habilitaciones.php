<html>

<head>

 <link rel="StyleSheet" href="estilos.php" type="text/css">

 <title>Habilitaciones</title>

</head>  

<body>
<script>
function toggle(source) {
  checkboxes = document.getElementsByName('carteras[]');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;	
  }
  if (document.getElementById('select_all').checked){
	   document.getElementById('deshabilitar').checked=false;
  } else {
	  document.getElementById('deshabilitar').checked=true;
  }
}

</script>
 <br>  

  <h1>Modificar Carteras habilitadas</h1>  

<?php

include("datos.php");
$imei=$_REQUEST['imei'];

echo '<form name"prueba" method="post" action="Habilitar_asesor.php">';

echo '<br><br>';
echo '<table class="tablalistado"style="margin: 0 auto;">';
echo '<tr><th>Habilitar Carteras para ';
echo $_REQUEST['nombre'];
echo '</th></tr>';
echo '</table>'; 
echo '<br>';
echo '<table class="tablalistado"style="margin: 0 auto;">';
echo '<tr>';
echo '<td>';
echo "Seleccionar/Deseleccionar todos";
echo '<input type="checkbox" id="select_all" onClick="toggle(this)"/>';
echo '</td>';
echo '</tr>'; 
while($ver_carteras=$obt_carteras->fetch_array()){	
echo '<tr>';
echo '<td>';
echo $ver_carteras['Nombre'];

echo "<input type='checkbox' name='carteras[]' value='".$ver_carteras['Nombre']."'/>";
echo '<br>';
echo '</td>';
echo '</tr>';          
 
}
echo '<tr>';
echo '<td>';
echo 'Deshabilitar asesor';
echo "<input type='checkbox' id='deshabilitar' name='deshabilitar' value='Deshabilitado'/>";
echo '<br>';
echo '</td>';
echo '</tr>';   
echo '</table>';  
echo '<br>';
echo '<input type="hidden" name="imei" value="'.$imei.'">'; 
echo '<input  class="botonsubmit" type="submit" value="Habilitar">'; 

echo '</form>';


?>


</body>

</html>
