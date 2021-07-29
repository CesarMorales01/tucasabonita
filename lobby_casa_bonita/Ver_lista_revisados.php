<html>
<head>
<script src="Chart.min.js"></script>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!-- Este boostrap es necesario para cargar la barra de acciones -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>
    <link rel="StyleSheet" href="estilos.php" type="text/css">
 <link rel="StyleSheet" href="estilos.php" type="text/css">
 </head>  
<body>    
  <title>Revisados</title>
<?php
include("datos.php");
if(isset($_REQUEST['Cobro'])){
   $cobro= $_REQUEST['Cobro'];
}
if(isset($_REQUEST['inicio'])){
  $inicio= $_REQUEST['inicio'];
}else{
  $inicio=0;
}
echo "<h1>Lista clientes revisados en ".$_REQUEST['Cobro']."</h1>";
echo '<a style="padding:5px;" class="botonsubmit" href="Form_Cuadrar_cuentas.php">Ir a cuadrar cuentas</a>';
echo '<br>';
echo '<br>';
$cobro1="'".$cobro."'";
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$get_revi=$mysql->query("select cedula, nombre, revisado from clientes where Cobro=$cobro1 order by revisado asc limit $inicio, 20") or die ("problemas al actualizar");
$strings=[];
$nombres=[];
$cedulas=[];
$impresos = 0;
while($get=$get_revi->fetch_array()){ 
  $impresos++;
$cedulas[]=$get['cedula'];   
$nombres[]=$get['nombre'];  
$strings[]= $get['revisado'];
}
$reps=count($strings);
date_default_timezone_set('America/Bogota');
$fecha_hoy=date("Y-m-d");
echo '<table class="tabencabezado""  style="margin: 0 auto;"  >';
echo '<tr><th>Nombre cliente</th><th>Revisado por</th><th>Fecha revisado</th><th>Tarjeta</th><th>Comentarios</th><th>Ver cuenta</th></tr>';	
for($i=0;$i<$reps;$i++){
  $tok = strtok($strings[$i], "/");
  $fecha=$tok;
  $asesor= $tok = strtok("/");
  $tarjeta= $tok = strtok("/");
  $comentarios= $tok = strtok("/");

echo '<tr>';
echo '<td>';
echo  $nombres[$i];
echo '</td>';
echo '<td>';
echo  $asesor;
echo '</td>';
// establecer color fondo de acuerdo a fecha
$aux_fecha;
if($fecha==""){
   $aux_fecha="2000-01-01";
}else{
  $aux_fecha=$fecha;
}
$date1 = new DateTime($aux_fecha);
$date2 = new DateTime($fecha_hoy);
$diff = $date1->diff($date2);
$dias= $diff->days;
if($dias<30){
  echo '<td>';
}
if($dias>30 && $dias<60){
  echo '<td  style="background-color:#daf87d">';
}
if($dias>=60 && $dias<=120){
  echo '<td  style="background-color:#ffa040">';
}
if($dias>120){
  echo '<td  style="background-color:#ff7b5a">';
}

echo  $fecha;
echo '</td>';
echo '<td>';
echo  $tarjeta;
echo '</td>';  
echo '<td>';
echo  $comentarios;
echo '</td>';
echo '<td>';
echo '<div id="enlaces">';    
echo '<a href="Form_ detalle_cuentas_todos.php?cedula='.$cedulas[$i].'">Ver detalles</a>';
echo '</div>';
 echo '</td>';
echo '</tr>';
}
echo '</table>';
echo '<br>';
// PAGINACION
echo "<div class='container'>";
echo "<div class='row justify-content-center'>";
echo "<div class='col-3'>";
if ($inicio == 0){
    echo "Anteriores ";
 } else {
    $anterior = $inicio - 20;
    echo "<a style=\"padding:5px;\" class=\"botonsubmit\" href=\"Ver_lista_revisados.php?inicio=$anterior&Cobro=$cobro\">Anteriores </a>";
  }
  echo "</div>";
  echo "<div class='col-3'>"; 
  if ($impresos == 20) {
    $proximo = $inicio + 20;
    echo "<a style=\"padding:5px;\" class=\"botonsubmit\" href=\"Ver_lista_revisados.php?inicio=$proximo&Cobro=$cobro\">Siguientes</a>";
  } else{
    echo "Siguientes";
  }
  echo "</div>";
echo "</div>";   
echo "</div>";  
?>
<br><br>
</body>
</html>