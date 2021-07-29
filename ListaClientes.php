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
    <script src="funciones.js"></script>
 </head>  
<body>    
<title>Clientes</title>
<br>
<div class="container">
<nav style="background-color:#fb6a4b;" class="navbar navbar-expand-md  ">
	<a class="navbar-brand" style="color:white; padding-left:30px; padding-right:30px;" href="#"> <i class="fas fa-shopping-cart"></i>  Merca Ya</a>
	<button class="navbar-toggler active" style="background-color:white; width:13%;" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
		aria-expanded="false" aria-label="Toggle navigation"></button>
	<div class="collapse navbar-collapse" id="collapsibleNavId">
		
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
			<li class="nav-item active">
				<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irProductos()" href="#"> <i class="fas fa-box-open"></i>  Productos</a>
			</li>

			<li class="nav-item active">
				<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irCategorias()" href="#"><i class="fas fa-align-justify"></i> Categorias<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item active">
			<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irPromociones()" href="#"> <i class="fab fa-adversal"></i>  Promociones</a>	
			</li>
			<li class="nav-item active">
				<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irClientes()" href="#"><i class="fas fa-user-friends"></i>  Clientes</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irListaCompras()" href="#"><i class="fas fa-shopping-cart"></i>  Lista compras</a>
			</li>
		</ul>
	</div>
</nav>
</div>
<br>
<h1 align="center">Clientes</h1>
<br>
<div class="container"> 
<div class="col-3" >
        <a style="background-color:#fb6a4b; padding:8px" href="https://tucasabonita.site/Lista_claves.php">Claves</a> 
</div>
<?php
include("datos.php");
echo '<br>';
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$get=$mysql->query("select * from clientes") or die ("problemas al consultar");
echo '<table class="table">';
echo '<tr><th>Nombre</th><th>Cedula</th><th>Direccion</th><th>Telefonos</th><th>E-mail</th><th>contraseña</th></tr>';	
while ($nombres=$get->fetch_array()){
echo '<tr class="table-success" >';
echo '<td>';
echo  $nombres['nombre'];
echo " ";
echo  $nombres['apellidos'];
echo '</td>';
echo '<td>';
echo  $nombres['cedula'];
echo '</td>';
echo '<td>';
echo  $nombres['direccion'];
echo '</td>';
echo '<td>';
echo  $nombres['telefono'];
echo '</td>';  
echo '<td>';
echo  $nombres['email'];
echo '</td>';
echo '<td>';
echo  $nombres['contraseña'];
 echo '</td>';
 echo '<td>';
 echo '<a id="hrefEliminar" onClick="AlertEliminar('.$nombres['cedula'].')" href="#" ><img height="20" width="20" src="Imagenes_productos/eliminar.png"></a>';
 echo '<br><br>';
 echo '<a  href="FormIngresarClientes.php?cedula='.$nombres['cedula'].'"><i style="color:red;" class="fas fa-pencil-alt"></i></a>';
echo '</td>';
echo '</tr>';
}
echo '</table>';
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
  window.location.href = "https://tucasabonita.site/Ingresar_clientes_web.php?cedula="+cod;
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
                <h5 id="tituloDialogo" class="modal-title">Eliminar cliente?</h5>
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