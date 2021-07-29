<html> 

  <head> 
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
    <link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" />  

  <title>Lista precios</title> 
  </head> 
  <body>
  <?PHP
 if(isset($_REQUEST['notificacion'])){
 echo $_REQUEST['notificacion'];	 
 }
 if(isset($_REQUEST['producto'])){
	$producto= $_REQUEST['producto'];	 
 }
 ?>
 <br>
<div style="display: flex; align-items: center; justify-content: center; width: 650px; margin: 0 auto;"  class="container">
  <div class="row ">
    <nav style="background-color:pink"  class="navbar navbar-expand-md">
      <div class="col-xl-3">
        <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="Lobby.php"> <i class="fas fa-home"></i>  Lobby</a>
      </div>
      <div class="col-xl-3">
        <a class="navbar-brand" id="navBuscarClientes" style="color:black; padding-left:30px; padding-right:30px;" href="Form_ingresar_coti_producto.php"> <i class="fas fa-plus"></i>  Agregar producto</a>
      </div>
    </nav> 
  </div>
</div>   
  <br> <br>  
<div style="text-align:center;" class="container">
<form method="post" action="Form_lista_cotizacion.php"> 
   Producto:
   <input type="text" name="producto" size="50"> 
  <br> 
 <input type="submit" value="Buscar" class="botonsubmit"> 
  </form>
<br> 
<?PHP 
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
if($producto==""){
	$registros1=$mysql->query("select * from cotizaciones limit 30") or die ("problemas en la consulta1");
}else{
	$registros1=$mysql->query("select * from cotizaciones where producto like '%$producto%'") or die ("problemas en la consulta1");		
}
echo '<table class="tabencabezado" style="margin: 0 auto;" >'; 
echo '<tr><th style="text-align:center">Producto</th> <th  style="text-align:center">Descripcion</th><th  style="text-align:center">Valor</th><th  style="text-align:center">Proveedor</th><th  style="text-align:center">Editar</th></tr>';	
while($reg1=$registros1->fetch_array()){
	  echo '<tr  >';

      echo '<td>';
      echo $reg1['producto'];
      echo '</td>';  

	  

      echo '<td>';
      echo $reg1['descripcion'];
      echo '</td>'; 
	  
	  echo '<td>';
	  echo number_format($reg1['precio'],2,",",".");
      echo '</td>';
		
	 echo '<td>';
	  echo $reg1['proveedor'];
      echo '</td>';	
	  
	  echo "<td>";
		?> 
		<form method="post"  id="irEditarCotizacion" action="Form_ingresar_coti_producto.php">
		<input type="hidden" id="id" name="id" value="<?php echo $reg1['id']; ?>" >
		<button style="background-color:#dbbba6; type="submit"  ><i style="color:red;" class="fas fa-pencil-alt"></i></button> 
		</form>
		<?php
		echo "</td>";
	  
	  echo '</tr  >';
	  
}
echo '</table>';	  
?>    
<div>

  </body> 
</html>