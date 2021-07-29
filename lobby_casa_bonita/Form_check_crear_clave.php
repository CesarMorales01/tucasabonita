<html> 
  <head>
       <link rel="StyleSheet" href="estilos.php" type="text/css">
  <title>Formulario ingresar claves</title> 
  </head> 
  <body>
 <br> <br> <br> 
 <h1> Datos en crear clave: </h1>

  <form method="post" action="Actualizar_datos_crear_clave.php"> 
  
  <?PHP
include("datos.php");

$cedula=$_REQUEST['cedula'];
$nombre=$_REQUEST['nombre'];


$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	

$consulta="SELECT * from crear_clave where cedula=$cedula";
$resultado=mysqli_query($conexion,$consulta);
if($reg=$resultado->fetch_array()){
 
}else{
     echo '<h2 style="color:#E64A19; font-size:16px; font-family:Arial; text-align:left"  > No se han encontrado datos en crear clave! </h2>';
};
?>
<br> 
  Lugar expedicion:
  <input type="text" name="lugarexp" value="<?php 
  if(isset($reg['lugarexp'])){
	 echo $reg['lugarexp']; 
  } ?>" > 
  <br> <br> 
  Fecha expedicion:
  <input type="text" name="fechaexp" value="<?php 
  if(isset($reg['fechaexp'])){
	 echo $reg['fechaexp']; 
  } ?>" > 
   <br> <br> 
   Usuario: 
   <input type="text" name="usuario" value="<?php 
  if(isset($reg['usuario'])){
	 echo $reg['usuario']; 
  } ?>"  > 
  <br> <br> 
  Clave:
  <input type="text" name="clave" value="<?php 
  if(isset($reg['clave'])){
	 echo $reg['clave']; 
  } ?>" > 
  <br> <br> 
   Nombre:
  <input type="text" name="nombre" size="30"  value="<?php 
  if(isset($reg['nombre'])){
	 echo $reg['nombre']; 
  } ?>"  > 
  <br> <br> 
   Cedula:
  <input type="text" name="cedula" value="<?php 
  if(isset($_REQUEST['cedula'])){
	echo $_REQUEST['cedula'];  
  } ?>" >
  <br> <br> 
  <input type="submit" value="Actualizar datos"> 
  </form>
  <br>
    <?PHP
echo '<a href="Form_Ingreso_crear_clave.php?cedula='.$cedula.'&nombre='.$nombre.'">Registrar datos en tabla crear clave</a>'; 
   ?>

</body> 
</html>