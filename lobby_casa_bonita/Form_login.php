<html> 
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030"> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Login</title> 
</head> 
<body style="background-image: url('Imagenes/fondo_blanco.jpg'); background-position: center center;	  
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;" >
<?php 
include("datos.php");
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	
$get_settings="SELECT * FROM settings";
$get=mysqli_query($conexion,$get_settings);
if($get_settings0=$get->fetch_array()){}
?>
<style>
body {
  margin: 0;
  padding: 0;
  background: url(../img/bg.jpeg) no-repeat center top;
  background-size: cover;
  font-family: sans-serif;
  height: 100vh;
}

.login-box {
  width: 420px;
  height: 520px;
  background: <?php echo $get_settings0['bcasillaUno'] ?>;
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
  top: -50px;
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
<script>
  function verificar() {
    var clave=document.getElementById('clave').value;
    if (clave.length<4)
    {
      alert('La clave no puede tener menos de 4 caracteres!!!');
    }
  }
</script>    
<?php
 if (isset($_COOKIE['save'])){
 $usuario=$_COOKIE['save'];
 $clave=$_COOKIE['contra'];
} else {
    $usuario=""; 
    $clave="";
}
if (isset($_REQUEST['notificacion'])){
 $notificacion=$_REQUEST['notificacion'];
}
?>      
 <div class="login-box">
 <img src="Imagenes/log_in.png" class="avatar" alt="Avatar Image">
  <br>
  <h2>Bienvenido a tu Gestion de Cartera!</h2>
  <br>
   <h2>Iniciar sesión</h2>
   
  <?php echo $notificacion ?>
  <form method="post" action="Revisar_login_lobby_web.php">
 <br> 
  <input type="text" name="usuario_login_admin" required size="50" placeholder="Usuario" value="<?php echo $usuario ?>"> 
  <br> <br> 
  <input type="password" id="clave" name="clave_login_admin" required size="50" placeholder="Clave" value="<?php echo $clave ?>" > 
  <br> <br>

Mantener contraseña:
  <input type="checkbox" name="save"
   <?php
    if ($usuario!=null){
     echo 'checked';  
    } 
  ?>
  >
 <br> <br>
  <input class="btn btn-primary btn-lg" type="submit" onClick="verificar()" value="Iniciar sesión"> 
  </form>
  </div>
</body> 
</html>