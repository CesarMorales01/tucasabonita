<html> 
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030"> 
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
<title>Login</title> 
</head> 
<body>
<style>
body {
  margin: 0;
  padding: 0;
  background-size: cover;
  font-family: sans-serif;
  height: 100vh;
}

.login-box {
  width: 420px;
  height: 560px;
  background: #f0e094;
  color: #fff;
  top: 50%;
  left: 50%;
  position: absolute;
  transform: translate(-50%, -50%);
  box-sizing: border-box;
  padding: 70px 30px;
}

.login-box .avatar {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  position: absolute;
  top: -1px;
  left: calc(50% - 50px);
}

.login-box h1 {
  margin: 0;
  padding: 0 0 20px;
  text-align: center;
  font-size: 22px;
}


.login-box input[type="text"], .login-box input[type="password"] {
  border: none;
  border-bottom: 1px solid #fff;
  background: transparent;
  outline: none;
  height: 40px;
  width: 240px;
  color: #fff;
  font-size: 16px;
  color:#0B0A0A;
}



.login-box input[type="submit"]:hover {
  cursor: pointer;
  background: #ffc107;
  color: #000;
}
</style>   
<?php
 if (isset($_COOKIE['usuario_cliente'])){
 $usuario=$_COOKIE['usuario_cliente'];
 $clave=$_COOKIE['clave_cliente'];
} else {
    $usuario=""; 
    $clave="";
}

// uso notificacion luego en javascript para saber a donde redireccion luego de iniciar sesion
if(isset($_REQUEST['inbox'])){
	$inbox=$_REQUEST['inbox'];
	if($inbox=="question"){
		$notificacion="Para preguntar debes identificarte!";
		$producto=$_REQUEST['producto'];
	}
}
if(isset($_REQUEST['from'])){	
  $from=$_REQUEST['from'];
  $producto=$_REQUEST['producto'];
   session_start();
  $_SESSION['producto'] =$_REQUEST['producto'];
}


?>  
<nav style="background-color:#FF0000;" class="navbar navbar-expand-md">
<div style="height:100;">
</div>
</nav>    
 <div style="border-style: double; border-color:red;" class="login-box">
 <img src="Imagenes_config/ico_app_foreground.png" class="avatar">
  <br>
  <h2 style="color:black; text-align: center;" >Hooola! Bienvenid@!</h2>
  <br>
  <p style="text-align: center; color:red;" id="alerIncorrect"><?php echo $notificacion; ?></p>
  <form style="text-align: center;">
 <br> <br>  
  <input type="text" id="usuario" name="user1" required size="50" placeholder="E-mail o cédula" value="<?php echo $usuario ?>"> 
  <br> <br> 
  <input type="password" id="clave" name="contra1" required size="50" placeholder="Clave" value="<?php echo $clave ?>" > 
  <br> <br>
 <label style="color:black;">Mantener contraseña:</label>
  <input id="checkbox" type="checkbox" name="save"
   <?php
    if ($usuario!=null){
     echo 'checked';  
    } 
  ?>
  >
 <br> <br>
  <input  style="background-color:green" class="btn btn-success btn-lg" type="button" onClick="enviarFormulario()" value="Ingresar"> 
  <br> <br>
  <input  class="btn btn-outline-primary" onclick="ir_crear_cuenta()"  type="button"  value="o crear una cuenta">
  </form>
  </div>
  <script>
var conexion1;
function enviarFormulario() {
 var correo=document.getElementById('usuario').value;
 var contraseña=document.getElementById('clave').value;
	 if(correo=="" || contraseña==""){
	   var p_alert=document.getElementById('alerIncorrect');
	   p_alert.innerText="Ingresa tus datos!";
	 }else{
		conexion1=new XMLHttpRequest();
		conexion1.onreadystatechange = procesarEventos;
		conexion1.open('POST','Revisar_login.php', true);
		conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		conexion1.send(codif_datos());
	 }	    
}

function ir_crear_cuenta(){
		location.href ="https://tucasabonita.site/Registrarse.php";
}

 function codif_datos(){
  var cadena='';
  var correo=document.getElementById('usuario').value;
  var contraseña=document.getElementById('clave').value;
  if(document.getElementById('checkbox').checked){
	var check='true'; 
	cadena='user1='+encodeURIComponent(correo)+'&contra1='+encodeURIComponent(contraseña)+'&save_index='+encodeURIComponent(check); 
  }else{
	 cadena='user1='+encodeURIComponent(correo)+'&contra1='+encodeURIComponent(contraseña); 
  } 
  return cadena;
}

function procesarEventos(){
  if(conexion1.readyState == 4){
    var datos=JSON.parse(conexion1.responseText);	
    var cedula = datos.cedula;
	var usuario = datos.usuario;
		if(cedula=="0"){
		   var p_alert=document.getElementById('alerIncorrect');
			p_alert.innerText="Datos incorrectos!";
		}else{
			var from="<?php echo $from; ?>";
			var producto="<?php echo $producto ?>";
			if(from=="producto"){
				location.href ="https://tucasabonita.site/Productos.php?producto="+producto;
			}else{
				location.href ="https://tucasabonita.site/";	
			}
		}
  } 
}

$(document).keydown(function(event) { 
  var key = (event.keyCode);
  if(key==13){
    enviarFormulario();
  }
});
 
</script> 
</body> 
</html>