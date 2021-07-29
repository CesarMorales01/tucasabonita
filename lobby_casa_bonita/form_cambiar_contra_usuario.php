<?php 
include("datos.php");
 //  CONFIRMAR INICIO DE SESION             
if(isset($_COOKIE['cobrador'])){
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  
//REVISAR TIPO DE USUARIO
if(isset($_COOKIE['tipo_usuario'])){
$tipo_usuario1 = $_COOKIE['tipo_usuario'];
$tipo_usuario="'".$tipo_usuario1."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  

// REVISANDO TIPO DE USUARIO 	 
$check_tipousuario=$mysql->query("select * from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta asesores");
if($revisar_usu=$check_tipousuario->fetch_array()){
	$type_usu=$revisar_usu['tipo_usuario'];
}
if($type_usu!="administrador"){
$notificacion="Se requiere iniciar sesión!";
header("Location:  $url/Form_login.php?notificacion=$notificacion");  		
}  
?>
<!DOCTYPE html>
<html> 
<head>
<link rel="StyleSheet" href="estilos.php" type="text/css"> 

<title>Cambiar contraseña</title> 
</head> 
<body>
<script>
 window.addEventListener('load', inicio, false);
  function inicio(){  
  document.getElementById("cambiar_contra_usu").addEventListener('submit',validar,false); 
  } 
  
  function validar(evt){
	 var contraseña=prompt('Ingresa tu contraseña actual:','');
	 var contra_vieja= '<?php echo $revisar_sesion;?>';
	 if (contraseña != contra_vieja){
      alert("Contraseña incorrecta");
	  evt.preventDefault();  
	  location.href ="https://financieramireyapp.000webhostapp.com/financieramirey/Form_login.php?notificacion=Se%20requiere%20iniciar%20sesi%C3%B3n!";
       }    
  } 
  
  

</script>

  <br>

  <h1>Cambiar contraseña</h1>
  <div id="contenedor"> 
   <form method="post" action="cambiar_contra_usu.php" id="cambiar_contra_usu"> 

    <?php 

$imei=$revisar_sesion; 

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

   ?>
 Escribe tu nueva contraseña: 
   <br> 
<input type="text" name="nueva_contra" size="30"> 

<br> <br> 
<input type="hidden" name="contra_vieja" value="<?php echo $imei;?>">

  <input type="submit" class="botonsubmit" value="Cambiar contraseña"> 

  </form>

 </div>  

</body> 

</html>