<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css" type="text/css">
  <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!-- Este boostrap es necesario para cargar la barra de acciones -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
 </head>  
<body>    
<title>Lista promociones</title>
<br>
<h1 align="center">Promociones</h1>
<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-4" >
        <form action="ListaProductos.php">
        <button style="margin-top:10px;" type="submit" class="btn btn-primary">Ir a productos</button>
        </form>
        </div>
        <div class="col-xl-4" >
        <form action="FormIngresarPromo.php">
        <button  style="margin-top:10px; background-color:#ff0080;"  type="submit" class="btn btn-primary">Crear promocion</button>
        </form>
        </div>
    </div> 
</div>  
<br>
<div class="container"> 
<?php
include("datos.php");
echo '<br>';
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$get=$mysql->query("select * from promociones_mercaya order by id desc") or die ("problemas al consultar");
echo '<table class="table">';
echo '<tr><th>Id</th><th>Descripcion</th><th>Producto asignado</th><th>Credito</th><th>Categoria asignada</th><th>Imagen</th><th>Opciones</th></tr>';	
while ($nombres=$get->fetch_array()){
echo '<tr class="table-success" >';
echo '<td>';
echo  $nombres['id'];
echo '</td>'; 
echo '<td>';
echo  $nombres['descripcion'];
echo '</td>'; 
echo '<td>';
$product = $nombres['ref_producto'];
if($product==""){}else{
  $getProduct=$mysql->query("select nombre from productos where id=$product") or die ("problemas al consultar");
  if($getP=$getProduct->fetch_array()){
    echo  $getP['nombre'];
  }
}
echo '</td>'; 
echo '<td>';
echo  $nombres['pago_credito'];
echo '</td>';
echo '<td>';
echo $nombres['categoria'];
echo '</td>';  
echo '<td>';
echo $nombres['imagen'];
echo "<br>";
echo '<img width="100" height="100" src="';
echo $nombres['imagen'];
echo '">';
 echo '</td>';
 echo '<td>';
 echo '<a id="hrefEliminar" onClick="AlertEliminar('.$nombres['id'].')" href="#" ><img height="20" width="20" src="Imagenes_productos/eliminar.png"></a>';
 echo '<br><br>';
 echo '<a  href="FormIngresarPromo.php?id='.$nombres['id'].'"><i style="color:red;" class="fas fa-pencil-alt"></i></a>';
echo '</td>';
echo '</tr>';
}
echo '</table>';
mysqli_close($conexion);
?>
</div>
<script src="functions_my_system.php"></script> 
<script>
var cod;
function AlertEliminar(param) {
  var abrirDialogo=document.getElementById('abrirDialogo'); 
  abrirDialogo.click();
  cod=param;
}

function eliminar() {
  window.location.href = "https://tucasabonita.site/Crear_promo_web.php?id="+cod;
}
</script>
<a class="nav-link" id="abrirDialogo" data-toggle="modal" data-target="#dialogo1" ></a>
			  <!-- INICIO DIALOGO CONFIRMAR BORRAR --> 
<div class="modal fade" id="dialogo1">
	<div class="modal-dialog">
		<div class="modal-content">
						  <!-- cuerpo del diálogo -->
			<div class="modal-header">
      <br>
                <div class="container">
                <h5 id="tituloDialogo" class="modal-title">Deseas eliminar esta categoria?</h5>
      </div>
		</div>
						  <!-- pie del diálogo -->
					  <div class="row justify-content-around">
						  <div class="col-3">
							<button style="background-color:#afafaf;" type="button"  data-dismiss="modal">Cancelar</button>
						  </div>
						  <div class="col-3">
							<button onClick="eliminar()" type="button" style="background-color:#d22c21;" data-dismiss="modal" >Eliminar</button>
						  </div>
            </div>  
            <br>
	</div>
</div>        
			    <!-- FIN DIALOGO -->
</body>
</html>