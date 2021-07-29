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
   <link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Formulario Ingresar articulos</title> 
</head> 
 <?php 
  include("datos.php");
	$cedula=$_REQUEST['cedula']; 	
   ?>
<script>
 window.addEventListener('load', Inicio, false);
 function Inicio() {
	llamar_carrito(); 
}

// ACCESOS DIRECTOS PRESIONANDO TECLAS
$(document).keydown(function(event) { 
  var key = (event.keyCode);
  if(key==13){
	  document.getElementById('btn_buscar').click();
  }
});
  
var datos;
var cant=1;
var subto;
var conexion3;
function llamar_carrito() {
  conexion3=new XMLHttpRequest();
  conexion3.onreadystatechange = get_data_carrito;
  conexion3.open('POST','consultar_carrito_compras.php', true);
  conexion3.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion3.send(encodeDatos_carrito()); 
}

function encodeDatos_carrito(){
	var cliente="<?php echo $cedula; ?>";
    var cadena='cliente='+encodeURIComponent(cliente); 
  return cadena;
}

function get_data_carrito(){
	var gift=document.getElementById('gift');
  if(conexion3.readyState == 4){
	  var resp= conexion3.responseText;
		var infor=JSON.parse(conexion3.responseText);
		gift.innerHTML = '<img src="">';
		 cargar_carrito(infor);  
  }else{
	gift.innerHTML = '<img style="WIDTH: 58px; HEIGHT: 58px" src="Imagenes/loading.gif">';
  }
}

function cargar_carrito(infor){
	 $("#tabla tr").remove(); 
	 var sumar=0;
	for(var f=0;f<infor.length;f++){
		var nombres=infor[f].producto;
		var descripcion=infor[f].descripcion;
		var valor=infor[f].valor;
		var subto=infor[f].subtotal;
		sumar=parseInt(sumar)+parseInt(subto);
		var conte1="<td class='table-success'>"+nombres+"</td>";
		var conte2="<td class='table-success'>"+valor+"</td>";
		var conte3="<td class='table-success'>"+cant+"</td>";
		var conte4="<td class='table-success'>"+subto+"</td>";
		document.getElementById("tabla").insertRow(-1).innerHTML = conte1+conte2+conte3+conte4;
	}	
		document.getElementById("tv_total").innerText=sumar;
}

var conexion2;
function add_products(ind) {
  conexion2=new XMLHttpRequest();
  conexion2.onreadystatechange = get_data;
  conexion2.open('POST','Guardar_en_carrito_mysql.php', true);
  conexion2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion2.send(encodeDatos(ind)); 
}

function encodeDatos(ind){
	var cod=datos[ind].id;
	var nombre=datos[ind].nombre;
	var descripcion=datos[ind].descripcion;
	var valor=datos[ind].valor;
	subto= cant*valor;
	var cliente="<?php echo	$cedula; ?>";
    var cadena='nombre='+encodeURIComponent(nombre)+'&descripcion='+encodeURIComponent(descripcion)+
	'&valor='+encodeURIComponent(valor)+'&cant='+encodeURIComponent(cant)+'&subtotal='+encodeURIComponent(subto)+'&cliente='+encodeURIComponent(cliente)+
	'&id='+encodeURIComponent(cod); 
  return cadena;
}

function get_data(){
	var gift=document.getElementById('gift');
  if(conexion2.readyState == 4){
	  var resp= conexion2.responseText;
	  if(resp=="insert"){
		  cant=1;
		 llamar_carrito();
		 gift.innerHTML = '<img src="">';
		 window.location.href ="#tema1";
	  }
  }else{
	gift.innerHTML = '<img style="WIDTH: 58px; HEIGHT: 58px" src="Imagenes/loading.gif">';
  }
}

function recal(ca){
	cant = document.getElementById(ca).value;
}

function llenar(dates) {
	for(var f=0;f<dates.length;f++){
		 var nombres=dates[f].nombre;
		 var descripcion=dates[f].descripcion;
		 var valor=dates[f].valor;
		 var conte1="<td class='table-danger'>"+nombres+"</td>";
		 var conte2="<td class='table-danger'>"+descripcion+"</td>";
		 var conte3="<td class='table-danger'>"+valor+"</td>";
		 var conte4="<td class='table-danger'><input type='number' onchange='recal("+f+")' id="+f+"  min='1' max='99' value='1'></td>";
		 var conte5="<td class='table-danger'><input type='button' class='btn btn-success' onClick='add_products("+f+")' value='Agregar'></td>";
		 document.getElementById("tabla_productos").insertRow(-1).innerHTML = conte1+conte2+conte3+conte4+conte5;
	}
}

var conexion1;
function get_products() {
  $("#tabla_productos tr").remove(); 
  conexion1=new XMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','consultar_productos.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(retornarDatos()); 
}

function retornarDatos(){
 var edit_buscar=document.getElementById('edit_buscar').value;
 var cadena='producto='+encodeURIComponent(edit_buscar); 
  return cadena;
}

function procesarEventos(){
	var gift=document.getElementById('gift');
  if(conexion1.readyState == 4){
	datos=null;	
    gift.innerHTML = '<img src="">';
    datos=JSON.parse(conexion1.responseText);
	llenar(datos);
  }else{
	gift.innerHTML = '<img style="WIDTH: 58px; HEIGHT: 58px" src="Imagenes/loading.gif">';
  }
}

var conexion4;
function limpiar_products() {
  conexion4=new XMLHttpRequest();
  conexion4.onreadystatechange = procesarEventos_eliminar_carrito;
  conexion4.open('POST','borrar_carrito_compras.php', true);
  conexion4.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion4.send(retornarDatos_eliminar_carrito()); 
}

function retornarDatos_eliminar_carrito(){
	var cliente="<?php echo $cedula; ?>";
 var cadena='cliente='+encodeURIComponent(cliente); 
  return cadena;
}

function procesarEventos_eliminar_carrito(){
	var gift=document.getElementById('gift');
  if(conexion4.readyState == 4){
	$("#tabla tr").remove();
	document.getElementById("tv_total").innerText=0;
	 cant=1;	
    gift.innerHTML = '<img src="">';
  }else{
	gift.innerHTML = '<img style="WIDTH: 58px; HEIGHT: 58px" src="Imagenes/loading.gif">';
  }
}

 function toggle(source) {
	  checkboxes = document.getElementsByName('productos[]');
	  for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;	
	  }
}

 function comprar_products() {
	 var cliente="<?php echo $cedula; ?>";
	 var url="Form_ingresar_prestamo_micro.php?cedula="+cliente;
	  location.href =url;
}
</script>
<body>
 <br> <br>
 <h2> Ingresar articulos: </h2>
  <br> <br>
  <A Name="tema1"></a>
<div class="container">
  <h4> Articulos seleccionados</h4>
<table class="table" id="tabla">
<tr><th>Producto</th><th>Cantidad</th><th>Precio unitario</th><th>Subtotal</th></tr>
</table>
<table class="table">
<tr class="table-active"><th >Total</th><th id="tv_total">0</th><th><input type='button' class='btn btn-danger' onClick='limpiar_products()' value='Limpiar'></th><th><input type='button' class='btn btn-success' onClick='comprar_products()' value='Ir a registrar compra'></th></tr>
</table>
</div> 
 <br> <br>
<div class="container"> 
<input type="text" id="edit_buscar" required size="50" placeholder="Producto...">
 <br> 
<input type="button" class="btn btn-primary" onClick="get_products()" id="btn_buscar" value="Buscar productos">
 <h4>Productos encontrados</h4>
   <span style="width=10%" height="10%" id="gift"></span><br>
<table class="table" id="tabla_productos">

</table>
</div> 
 <br>
 
<br>
  <a href="Lobby_micro.php">Ir a Lobby</a>
  <br> <br> 
</body> 
</html>