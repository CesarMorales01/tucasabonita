<?php
header('Content-type: text/html; charset=utf-8');
include("Shopping_cart_hipertext.php");
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css">
	<title>Carrito compras</title>
  </head>
  <body >
<?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
<div class="row" style="background-color:#f0e094; color:green; height:50px;">
	<div class="col align-self-center">
	<h1 style="text-align: center; font-size:18px;" >Tu carrito de compras</h1>
	</div>
</div>
<br>
<div style="margin-left:10px;">
	<div class="row">
		<div class="col-sm-9 border border-success">
			<h1 style="font-size:18px;" >Productos en el carrito: </h1>
			<div id="div_carrito" class="container">
				
			</div>
		</div>
		<div class="col-sm-3 border border-success">
			<h3 style="font-size:18px; text-align: center;">Subtotal</h3>
			<h3 id="tv_subtotal" style="font-size:18px; color:green; text-align: center;"></h3>
			<hr style="height:2px;border-width:0;color:gray;background-color:gray"></hr>
			<h3 style="font-size:18px;">Costo envio</h3>
			<p id="tv_costo_envio" style="font-size:18px;"></p>
			<h3 style="font-size:18px; text-align: center;">Total con envio</h3>
			<h3 id="tv_subtotal_con_envio" style="font-size:18px; color:green; text-align: center;"></h3>
			<br>
			<h3 style="font-size:18px;">Elige un medio de pago</h3>
			
			<div class="container card" id="div_contraentrega"> 
				<div class="row justify-content-center">
					<div class="col-3 align-self-center">
					<input type="radio" checked id="contraentrega" name="medio_pago" value="contraentrega">
					</div>
					<div class="col-3">
					<img src="Imagenes_config/img_pago_contra_entrega.png" id="img_pago_contra_entrega" />
					</div>
				</div>
				<label for="contraentrega">Pago contra entrega. Gratis en el área metropolitana de Bucaramanga.</label><br>
			</div>
			
			<div class="container card" id="div_wompi"> 
				<div class="row justify-content-center">
					<div class="col-3 align-self-center">
					<input type="radio" id="wompi" name="medio_pago" value="wompi">
				</div>
				<div class="col-3">
				<img style="margin-top:10px;" src="Imagenes_config/wompi_btn.png" />	
				</div>
				</div>
			<label for="wompi">Pagar con wompi bancolombia. Comisión del 3.5% sobre el valor de la compra.</label><br>
			</div>
			
			<h3 style="font-size:18px; text-align: center;">Costo medio de pago</h3>
			<h3 id="tv_medio_pago" style="font-size:18px; color:green; text-align: center;"></h3>
			<br>
			<h3 style="font-size:22px; text-align: center;">Total a pagar</h3>
			<h3 id="tv_total_pagar" style="font-size:22px; color:green; text-align: center;"></h3>
			<div class="container">
			<a onclick="ir_pagar()" style="font-size:18px; background-color:green; text-align: center;" class="card btn btn-primary">Ir a pagar</a>
			</div>
			<br><br>
		</div>
	</div>
</div>
<div class="container">
<br>
<a href="https://tucasabonita.site/" onclick="" style="font-size:18px; background-color:#f0e094; color:green; width:240px; " class="card btn btn-primary"><strong>Continuar comprando</strong></a>
<br><br>
<p><strong style="color:red;">*</strong>La disponibilidad, el precio y la cantidad de unidades de los productos esta sujeta a las unidades disponibles en inventario. 
Tu Casa Bonita no se hace responsable por el posible agotamiento de unidades.</p>
</div>

<!--- dialogo confirmar eliminar -->
<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px; cursor:pointer;" data-toggle="modal" id="ancla_dialogo_eliminar" data-target="#dialogo1"></a>
			  <!-- INICIO DIALOGO NUEVO REGISTRO --> 
					<div class="modal fade" id="dialogo1">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <!-- cuerpo del diálogo -->
							  <div class="modal-body">
								¿Deseas eliminar este producto?
							  </div>
						  <!-- pie del diálogo -->
						<div class="row justify-content-around">
						  <div class="col-3"> 
							<button type="button" style="background-color:#d22c21;" data-dismiss="modal">Cancelar</button>
						  </div>
						  <div class="col-3">
							<input type="hidden" id="hidden_dialogo_eliminar"> 
							<button type="button" onclick="run_ajax_delete()" style="background-color:#228b22;">Eliminar</button>
						  </div>
						</div> 
						<br>	<br>	
						</div>
					  </div>
					</div>
 <!-- FIN DIALOGO -->
<script src="functions.php"></script>
<script>
var conexion, conexion_cantidad, subtotal_con_envio;
var cedula=<?php echo $cedula; ?>;
var json;
get_carrito();
var costo_medio_pago;

document.getElementById('div_contraentrega').addEventListener('click', function (event) {
	document.getElementById("contraentrega").checked=true;
    calcular_costo_medio_pago();
});

document.getElementById('div_wompi').addEventListener('click', function (event) {
	document.getElementById("wompi").checked=true;
    calcular_costo_medio_pago();
});

function calcular_costo_medio_pago(){
	var radios = document.getElementsByName('medio_pago');
	var id_radio_no_selected;
	for (var i = 0, length = radios.length; i < length; i++) {
	  if (radios[i].checked) {
		  radio_selected=radios[i].value;
		break;
	  }
	}
	costo_medio_pago;
	if(radio_selected=="contraentrega"){
		costo_medio_pago=0;
	}else{
		costo_medio_pago=subtotal_con_envio*0.035;
	}
	costo_medio_pago=Math.round(costo_medio_pago);
	total_pagar=subtotal_con_envio+costo_medio_pago;
	total_pagar=Math.round(total_pagar);
	var format_costo_medio_pago=new Intl.NumberFormat("de-DE").format(costo_medio_pago);
	var format_total_pagar=new Intl.NumberFormat("de-DE").format(total_pagar);
	document.getElementById('tv_medio_pago').innerText="$ "+format_costo_medio_pago;
	document.getElementById('tv_total_pagar').innerText="$ "+format_total_pagar;
}


function ir_pagar(){
	if(subtotal_con_envio!=null){
		window.location.href = url+"check_out.php?e_pay="+costo_medio_pago;
	}else{
		alert("Carrito de compras vacio!");
	}
}

function cargar_params_cambiar_cantidad_carrito(seleccion, producto){
	var parametros='cedula='+encodeURIComponent(cedula)+'&producto='+encodeURIComponent(producto)+'&cantidad='+encodeURIComponent(seleccion);
	return parametros;
}

function procesar_cambio_cantidad_carrito(){
	limpiar_div_carrito();
  if(conexion_cantidad.readyState == 4){
	  limpiar_div_carrito();
	   get_carrito();
  }else{
	  mostrar_imagen_cargando();
  }
}

function get_carrito() {
  conexion=new XMLHttpRequest();
  conexion.onreadystatechange = procesar;
  conexion.open('POST','cargar_carrito_hipertext.php', true);
  conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion.send('cedula='+encodeURIComponent(cedula));  
}

function procesar(){
	limpiar_div_carrito();
  if(conexion.readyState == 4){
	  json = JSON.parse(conexion.responseText);
	  if(json.check[0]=="0"){
		  document.getElementById("tv_subtotal_con_envio").innerText="$ 0";
		  document.getElementById("tv_subtotal").innerText="$ 0";
		  document.getElementById("tv_total_pagar").innerText="$ 0";
		  document.getElementById("tv_medio_pago").innerText="$ 0";
		  limpiar_div_carrito();
		  cargar_mensaje_carrito_vacio();
	  }else{
		  limpiar_div_carrito();
	      cargar_div_carrito();
	  }
  }else{
	  mostrar_imagen_cargando();
  }
}
function cargar_mensaje_carrito_vacio(){
	var br=document.createElement('br');
	var msje=document.createElement('h3');
	msje.style.textAlign = "center";
	msje.innerHTML="Tu carrito de compras esta vacio!";
	msje.style.fontSize="24px";	
	var anchor=document.createElement('a');
	anchor.text ="Que tal si presionas aqui y compras una de estas novedades!";
	//anchor.style.width="500px";
	anchor.style.textAlign = "center";
	anchor.style.color = "green";
	anchor.style.fontSize="22px";
	anchor.style.cursor="pointer";	
	anchor.classList.add("btn-primary");
	anchor.classList.add("card");
	anchor.addEventListener("click", function(event) {
	  window.location.href = url+"Searched.php?lookingfor=Tm92ZWRhZGVz";
	});
	div_carrito.appendChild(br);
	div_carrito.appendChild(msje);
	div_carrito.appendChild(anchor);
}

function cargar_div_carrito(){
	var count = Object.keys(json.imagenes).length;
	var div_carrito=document.getElementById('div_carrito');
	var subtotal=0;
	  for(var i=0;i<count;i++){
		  var div_row=document.createElement('div');
			div_row.classList.add("row");
			div_row.style.textAlign = "center";
			// div imagen
			var div_col=document.createElement('div');
			div_col.classList.add("col-sm-2");
			div_col.style.margin="10px";
			div_col.style.padding ="8px";
			// imgs
		    var images=document.createElement('img'); 
			images.src="Imagenes_productos/"+json.imagenes[i];
		    images.style.height="100px";
			images.style.width="100px";
			images.classList.add("img-fluid");
			div_col.appendChild(images);
			// div producto
			var div_producto=document.createElement('div');
			div_producto.classList.add('col-sm-5');
			div_producto.classList.add('align-self-center');
			// titulo producto
			var product=document.createElement('h3');
			product.innerHTML=json.productos[i];
			product.style.fontSize="18px";	
			div_producto.appendChild(product);
		  //  div subtotal
		  // sumar subtotal 
		   var cant =json.cantidades[i];
		   var estetotal=cant*parseInt(json.valores[i]);
		   subtotal=subtotal+estetotal;
		   var div_precio=document.createElement('div');
		   div_precio.classList.add('col-sm-4');
		   div_precio.classList.add('align-self-center');
			// texto precios
		    var precio=document.createElement('h3');
			var precio_format=new Intl.NumberFormat("de-DE").format(estetotal);
			precio.innerHTML="$ "+precio_format;
			precio.style.fontSize="18px";	
			div_precio.appendChild(precio);	
			
			// fin info articulo. Inicio div cantidad y eliminar.
		   var div_container_cantidad=document.createElement('div');
		   div_container_cantidad.classList.add('container');
			var div_row_cantidad=document.createElement('div');
		   div_row_cantidad.classList.add('row');
		   div_row_cantidad.classList.add('justify-content-around');
		   var div_cantidad=document.createElement('div');
		   div_cantidad.classList.add('col-3');	 
			var div_form_group=document.createElement('div');
		   div_form_group.classList.add('form-group');
		   var select=document.createElement('SELECT');
		   select.classList.add('form-control');
		   var id_select_cantidad="selec_cantidad//"+i;
		   select.id=id_select_cantidad;
			//Create and append the options
			for (var a = 1; a < 5; a++) {
				var option = document.createElement("option");
				option.value = a;
				option.text = a;
				if(a==cant){
					option.selected=true;
				}
				select.appendChild(option);
			}	
		   select.appendChild(option);
		   // onclick para cambiar cantidad
		   var producto=json.cods[i];
		   select.addEventListener("change", function(event) {
				 cambiar_cantidad(this);
			    });
		   div_form_group.appendChild(select);
		   div_cantidad.appendChild(div_form_group);
		   div_row_cantidad.appendChild(div_cantidad);
		   // div_icono_eliminar
		   var div_eliminar=document.createElement('div');
		   div_eliminar.classList.add('col-3');
		   var ico_eliminar=document.createElement('a');
		   ico_eliminar.classList.add('btn-default');
		   var id_anchor_eliminar= "anchor//"+i;
		   // onclick para eliminar producto
		   ico_eliminar.addEventListener("click", function(event) {
				f_delete(this);
			  });
		   ico_eliminar.id=id_anchor_eliminar;
		   var ico=document.createElement('i');
		   ico.classList.add('card');
		   ico.classList.add('far');
		   ico.classList.add('fa-trash-alt');
		   ico.classList.add('fa-2x');
		   ico.style.color="red";
		   ico.style.padding="1px";
		   ico_eliminar.appendChild(ico);
		   div_eliminar.appendChild(ico_eliminar);
		   div_row_cantidad.appendChild(div_eliminar);
		   div_container_cantidad.appendChild(div_row_cantidad);
		 // cargar divs a div container principal	
		  div_row.appendChild(div_col);
		  div_row.appendChild(div_producto);
		  div_row.appendChild(div_precio);	
		  div_carrito.appendChild(div_row);
		  div_carrito.appendChild(div_container_cantidad);  
	  }
	var subtotal_format=new Intl.NumberFormat("de-DE").format(subtotal);  
	document.getElementById('tv_subtotal').innerText="$ "+subtotal_format;	
	// subtotal con envio y check si envio gratis
	var costo_envio;
	if(subtotal>100000){
		document.getElementById('tv_costo_envio').innerText="Gratis en el área metropolitana de Bucaramanga por compras superiores a $100.000 pesos.";
		costo_envio=0;
	}else{
		costo_envio=10000;
		document.getElementById('tv_costo_envio').innerText="$ 10.000. Área metropolitana de Bucaramanga. (Por compras superiores a $ 100.000 pesos tu envio será gratis)";
	}
	subtotal_con_envio=subtotal+costo_envio;
	var format_subtotal_con_envio=new Intl.NumberFormat("de-DE").format(subtotal_con_envio);
	document.getElementById('tv_subtotal_con_envio').innerText="$ "+format_subtotal_con_envio;	
	calcular_costo_medio_pago();
}

function cambiar_cantidad(obj){
  var idd = obj.id;
  var sel = document.getElementById(idd).value;
  var cut=idd.split("//");
  var producto =json.cods[cut[1]] 
  conexion_cantidad=new XMLHttpRequest();
  conexion_cantidad.onreadystatechange = procesar_cambio_cantidad_carrito;
  conexion_cantidad.open('POST','cambiar_cantidad_item_carrito.php', true);
  conexion_cantidad.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion_cantidad.send(cargar_params_cambiar_cantidad_carrito(sel, producto)); 
}

function f_delete(ancla){
	// dialogo confirmar eliminar
	document.getElementById('ancla_dialogo_eliminar').click();
	var id= ancla.id;
	var cut=id.split("//");
	document.getElementById('hidden_dialogo_eliminar').value=json.cods[cut[1]];
}

var conexion_delete;
function run_ajax_delete(){	
  var id=document.getElementById('hidden_dialogo_eliminar').value;
  document.getElementById('ancla_dialogo_eliminar').click(); 
  conexion_delete=new XMLHttpRequest();
  conexion_delete.onreadystatechange = procesar_after_delete;
  conexion_delete.open('POST','delete_item_carrito.php', true);
  conexion_delete.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion_delete.send(cargar_params(id));  	
	
}

function cargar_params(id){
	var params ="cod="+encodeURIComponent(id)+'&cedula='+encodeURIComponent(cedula);
	return params;
}
function procesar_after_delete(){
	limpiar_div_carrito();
  if(conexion_delete.readyState == 4){
	  limpiar_div_carrito();
	  if(conexion_delete.responseText){
		 json.imagenes=[];
		 json.cods=[];
		 json.productos=[];
		 json.valores=[];
		 json.cantidades=[];
		 get_carrito();  
	  }
  }else{
	 mostrar_imagen_cargando();
  }
}

function mostrar_imagen_cargando(){
	var div_carrito1=document.getElementById('div_carrito'); 
	var div_row1=document.createElement('div');
	div_row1.classList.add("row");
	div_row1.style.textAlign = "center";
	var image=document.createElement('img'); 
	image.src="Imagenes_config/loading.gif";
	div_row1.appendChild(image);
	div_carrito1.appendChild(div_row1);
	
}
function limpiar_div_carrito(){
		var div = document.getElementById('div_carrito');
			while (div.firstChild) {
				div.removeChild(div.firstChild);
			}	
}
</script>
</body>
</html>