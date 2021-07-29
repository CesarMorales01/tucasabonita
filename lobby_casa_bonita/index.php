<!doctype html>
<html> 
<head> 
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Financiera mi rey</title> 
<meta charset="UTF-8">
</head> 
<body>
<div id="recuadro">
<br>
<img class="centrado"  src="Imagenes/ventas_y_servicios_mirey.png">
<div id="header">
<ul class="nav"><ul>
<li><u><a href="#tema1">Inicio</a></u></li>
<li><u><a href="#tema2">Ingresar a mi cuenta</a></u></li>
<li><u><a href="#tema3">Contactenos</a></u></li>
<li><u><a href="#">About</a></u></li>
</ul>
</li>
</ul>
 </div>
<?php 
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
$consulta=$mysql->query("select * from promociones where id='2'")or die("problemas en la consulta");
if($registro=mysqli_fetch_array($consulta)){
$result["Titulo"]=$registro['Titulo'];
$result["Descripcion"]=$registro['Descripcion'];
$result["Url"]=$registro['Url'];
$result["ImagenUrl"]=$registro['ImagenUrl'];
$result["Texto_boton"]=$registro['Texto_boton'];
}
$mysql->close();
?>
<br> <br><br><br><br>
<A Name="tema1"></a>
<h1 style="color:#CC0000";><?php echo $result["Titulo"] ?> </h1>
<img class="enmarcar_imagen"  src="<?php echo $result["ImagenUrl"] ?>">
<h2 class="centrado_texto"><?php echo $result["Descripcion"] ?> </h2>
<br><br>
<h2 class="centrado_texto" style="color:#0836a9";><?php echo $result["Texto_boton"] ?> </h2>

<?php 
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$consulta=$mysql->query("select * from promociones where id='5'")or die("problemas en la consulta");
if($registro=mysqli_fetch_array($consulta)){
$result["Titulo"]=$registro['Titulo'];
$result["Descripcion"]=$registro['Descripcion'];
$result["Url"]=$registro['Url'];
$result["ImagenUrl"]=$registro['ImagenUrl'];
$result["Texto_boton"]=$registro['Texto_boton'];
}
$mysql->close();
?>  
<br><br>
<h1 style="color:#CC0000";><?php echo $result["Titulo"] ?> </h1>
<img class="enmarcar_imagen"  src="<?php echo $result["ImagenUrl"] ?>">
<h2 class="centrado_texto"><?php echo $result["Descripcion"] ?> </h2>
<h2 class="centrado_texto" style="color:#0836a9";><?php echo $result["Texto_boton"] ?> </h2>

<br> <br>  
<hr <hr style="border-color:black;" size="4" noshade="noshade"><hr>  
<script>
  function verificar(){
    var clave=document.getElementById('clave').value;
    if (clave.length<4){
      alert('La clave no puede tener menos de 4 caracteres!!!');
    }
  }
 
 function wrong_password(){
	alert('Documento de identidad o contraseña incorrecta!!!'); 
 }	 
</script>    
    
  <?php
 
if (isset($_COOKIE['save_index'])){
 $usuario=$_COOKIE['save_index'];
 $clave=$_COOKIE['contra_index'];
 
} else {
    $usuario=""; 
    $clave="";
}

if (isset($_REQUEST['notificacion'])){
 $notificacion=$_REQUEST['notificacion'];
echo "<script>";
echo "wrong_password();";
echo "</script>";
}else {
    $notificacion="";
}
?>      
  <br> <br> <br> 
 <A Name="tema2"></a>
  <div class="">
   <h2>Ingresar a mi cuenta</h2>
   <img src="Imagenes/LOGO ROJO1_resized.jpg">
  <?php echo "<p style=font-size:15px>" .$notificacion." </>"?>
  <form method="post" action="Revisar_login_clientes.php">
 <br> 
  <input type="text" name="cedula" required size="50" placeholder="Cédula" value="<?php echo $usuario ?>"> 
  <br> <br> 
  <input type="password" id="contraseña" name="contraseña" required size="50" placeholder="Contraseña" value="<?php echo $clave ?>" > 
  <br> <br>
  <div style="font-size:15px;">
  Mantener contraseña:

  <input type="checkbox"  name="save_index"
   <?php
    if ($usuario!=null){
     echo 'checked';  
    } 
  ?>
  >
 <br> 
   </div>
   <br>
  <input class="botonsubmit" type="submit" onClick="verificar()" value="Ingresar"> 
  </form>
   <br> 
  <a href="Form_crear_clave_clientes_web.php" style="float:center; font-size:12px;">¿Olvidaste tu cuenta?</a>
  
  </div>

<br> <br><br>  
<hr <hr style="border-color:black;" size="4" noshade="noshade"><hr>  
<div id="lateral">
 <A Name="tema3"></a>
   <h2 >Escríbenos:</h2>
    <img src="Imagenes/whatsapp.png">
	<p style="font-size:22px;">3116186785</p>
	<img src="Imagenes/whatsapp.png">
	<p style="font-size:22px;">3163362388</p>
  </div>  
  
  <div id="principal">
   <h2 >Llámanos:</h2>
    <img src="Imagenes/telefono.png">
	<p style="font-size:22px;">3166182463</p>
	<img src="Imagenes/telefono.png">
	<p style="font-size:22px;">3152440039</p>
  </div> 
		
	
 </div>
</body> 
</html>