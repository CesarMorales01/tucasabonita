<?php
header('Content-Type: text/html; charset=utf-8');
include("datos.php");
if(isset($_COOKIE['cobrador'])){
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'";
} else {
 $notificacion="Se requiere iniciar sesi�n!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
} 


//REVISAR TIPO DE USUARIO
if(isset($_COOKIE['tipo_usuario'])){
$tipo_usuario1 = $_COOKIE['tipo_usuario'];
$tipo_usuario="'".$tipo_usuario1."'";
} else {
 $notificacion="Se requiere iniciar sesi�n!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  
	 
$check_tipousuario=$mysql->query("select * from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta asesores");
if($revisar_usu=$check_tipousuario->fetch_array()){
	$type_usu=$revisar_usu['tipo_usuario'];
}
if($type_usu!="administrador"){
$notificacion="Se requiere iniciar sesi�n!";
header("Location:  $url/Form_login.php?notificacion=$notificacion");  		
}        

echo '<a href="Cerrar_sesion.php" style="float:right">Cerrar sesion</a>';

?>
<!doctype html>

<html>

<head>

  <title>Opciones</title>
  <link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" /> 

</head> 

<body>

<br><br>

 <h1>Opciones de configuracion</h1> 

 <br><br>

  <?php

    echo '<table class="tabencabezado" style="margin: 0 auto;" >';
	echo '<tr>';
	  echo '<td >';

	  echo '<a href="form_cambiar_valores_ingreso_prede.php">Valores predeterminados ingreso de prestamos</a>';

      echo '</td>';

	 echo '</tr>';
	 
	 echo '<tr>';
      echo '<td >';

	  echo '<a href="settings.php">Cambiar tema y estilo</a>';

      echo '</td>';
	  echo '</tr>';
	 
	  echo '<tr>';

	  echo '<td>';

	  echo '<A href="form_cambiar_contra_usuario.php">Cambiar Contraseña</A>';

      echo '</td>'; 

	  echo '</tr>';

     echo '</table>';    
     


  ?>  

</body>

</html>