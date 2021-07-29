<html> 
<head>
<script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Agregar producto</title> 
</head> 
<body>
  <?php 
include("datos.php");
if(isset($_REQUEST['id'])){ 
	 $id=$_REQUEST['id'];
	 $conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);	  
	$consultar=$mysql->query("SELECT * from cotizaciones where id=$id") or die ("problemas en consulta");
	if($get=$consultar->fetch_array()){
	 $producto=$get['producto'];
	$descripcion=$get['descripcion'];
	$precio=$get['precio']; 
	$proveedor=$get['proveedor'];
	}
	mysqli_close($conexion);
}
?>
 <script>
window.addEventListener('load', check_id, false);

function check_id() {
	var id = "<?php echo $id ?>";
	if(id!=""){
		var btnEnviar=document.getElementById('btnEnviar');
		btnEnviar.value="Editar";
		var Form_ingresar_producto=document.getElementById('Form_ingresar_producto');
		Form_ingresar_producto.setAttribute('action', 'Editar_cotizacion.php');
		var btn_borrar=document.getElementById('btn_borrar');
		btn_borrar.style.display = "block";
	}
}
 </script>
 <br> <br> <br> 
 <h2> Ingresar producto: </h2>
<div id="contenedor"> 
  <form method="post" action="Ingresar_producto_web.php" id="Form_ingresar_producto"> 
<br> 
<textarea name="producto" required rows = "2" cols = "40" id="producto" placeholder="Producto"><?php echo $producto;?></textarea> 
  <br> <br> 
  <textarea name="descripcion" rows = "2" cols = "40" id="descripcion" placeholder="Descripcion"><?php echo $descripcion;?></textarea>
 <br> <br>
  <input type="number"  name="precio" required placeholder="Precio" value="<?php echo $precio;?>">
  <br> <br> 
    <input type="text"  name="proveedor" required placeholder="proveedor" value="<?php echo $proveedor;?>">
	  <br> <br>
   <input type="hidden"  name="id"  value="<?php echo $id;?>">
  <input class="botonsubmit" type="submit" id="btnEnviar" value="Ingresar">
  </form>
  <br> 
		<form method="post" style="display:flex; justify-content:center;"  id="EliminarCotizacion" action="Ingresar_producto_web.php">
		<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" >
		<button id="btn_borrar" style="background-color:#dbbba6; display:none;" type="submit"><i class="far fa-trash-alt"></i></button> 
		</form>

  <a href="Lobby.php">Ir a Lobby</a>
 </div>
</body>
</html>