
<!doctype html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

     <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Configurar boqueo</title>

</head>  
<body>
<h1> Configurar hora de bloqueo de asesores </h1>
<br>

<?php
include("datos.php");

// BLOQUEO SEGUN HORA
$get_if_time_blocked="SELECT * FROM asesores";
$get_time_b=mysqli_query($conexion,$get_if_time_blocked);

echo '<table class="tablalistado"style="margin: 0 auto;">';
echo '<tr><th>Nombre asesor</th><th>Hora de bloqueo</th><th>Modificar</th><th>Eliminar</th></tr>';
 while ($reg=$get_time_b->fetch_array()){
echo '<form  id="bloqueo_hora" method="post" action="bloqueo_hora.php">';
echo '<input type="hidden" name="id" value="'.$reg['id'].'">'; 
echo '<td>';
echo $reg['nombre'];
echo '</td>';
echo '<td>';
echo '<input id="hora" type="text" size="8" list="listalimitestiempo" name="hora" value="'.$reg['time_blocked'].'">'; 
echo '<datalist id="listalimitestiempo">';
for($i=0;$i<24;$i++){
	if($i<10){
		$x="0".$i;
	}else{
		$x=$i;
	}
echo '<option value="'.$x.':00:00">';
}
echo '</datalist>';
echo '</td>';
echo '<td>';
echo '<input  class="botonsubmit" type="submit" value="Modificar">'; 
echo '</th>';
echo '<td>';
echo '<a href="eliminar_bloqueo.php?id='.$reg['id'].'">Eliminar bloqueo</a>';
echo '</td></tr>';
echo '</form>';
 }

echo '</table>'; 
  ?>  
</body>
</html>