<?php 
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexiÃ³n a la base de datos");

$get_settings=$mysql->query("select * from settings") or die ("problemas en la consulta");		 
$get1=$get_settings->fetch_array();  		

?>
<!DOCTYPE html>
<html> 
<head>
<link rel="StyleSheet" href="estilos.php" type="text/css"> 

<title>Cambiar valores predeterminados</title> 
</head> 
<body>
  <br>

  <h1>Cambiar valores predeterminados de ingreso de prestamos</h1>
  
 <?php 
if(isset($_REQUEST['notificacion'])){
echo '<p>'.$_REQUEST['notificacion'].'</p>';
}

?> 
  <div id="contenedor"> 
   <form method="post" action="cambiar_valores_ingreso_prede.php" id="cambiar_contra_usu"> 
 Valor de prestamo: 
   <br> 
<input type="number" min="1" max="999999999" name="valor prestamo" value="<?php echo $get1['valor_prestamo'];?>"> 

<br> <br> 
 Tiempo en meses: 
    <br> 
<input type="number" min="1" max="99" name="tiempo_meses" value="<?php echo $get1['tiempo_meses'];?>"> 
<br> <br> 
 Periodicidad: 
    <br> 
<select name="periodicidad"> 
 <?php
 $valor=$get1['periodicidad'];
 echo "<option value='$valor'";
 echo 'selected="true"';
echo ">$valor</option>";        
?>
  <option value="diario">diario</option> 

  <option value="semanal">semanal</option> 

  <option value="quincenal">quincenal</option> 

  <option value="mensual">mensual</option> 

  </select> 
  <br> <br> 
 Numero de cuotas: 
    <br> 
<input type="number" min="1" max="99" name="n_cuotas" value="<?php echo $get1['n_cuotas'];?>">
<br> <br> 
Interes: 
   <br> 
<input type="number" min="1" max="99" name="interes" value="<?php echo $get1['interes'];?>">  
 %
<br> <br>
  <input type="submit" class="botonsubmit" value="Actualizar valores"> 
   <br>    <br> 
  </form>
  <br> 
<a href="Lobby.php">Ir a Lobby</a>
 </div>  

</body> 

</html>