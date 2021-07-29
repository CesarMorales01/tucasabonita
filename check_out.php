<?php
header('Content-type: text/html; charset=utf-8');
include("check_out_hipertext.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<title>Check out casa bonita</title>
</head>
<body >
<nav style="background-color:#FF0000;" class="navbar navbar-expand-md">
<a class="navbar-brand" href="https://tucasabonita.site/"> <img src="Imagenes_config/ico_app_foreground.png" width="60" height="60">
<span style="color:white;">Tu casa bonita</span></a>
<div style="height:30px;"></div>
</nav> 
<br><br>
<div class="container"> 
<div class="row justify-content-around">
 <div class="col-lg-5" >
    <h3 style="font-size:22px; text-align: center;">Tu compra será entrega en:</h3> 
	<p style="text-align:justify; color:black;">Dirección de domicilio</p>
	<!-- Inicio form_ingresar_compra usado para enviar datos a mis_compras -->
	<form action="ingresar_compra_web.php" id="form_ingresar_compra" method="post">
		<textarea name="direccion" id="direccion" readonly rows="2" class="form-control"><?php echo $dir; ?></textarea> 
		<br>
		<h3 style="font-size:22px; text-align: center;">A nombre de:</h3> 
		<p style="text-align:justify; color:black;">Nombre</p>
		<input type="text" name="nombre" readonly class="form-control" value="<?php echo $cliente;?>" id="nombre"> 
		<br> 
		<p id="alert_cambio" style="text-align:justify; color:black;">Número de cédula</p>
		<input type="text" readonly name="cedula" class="form-control" value="<?php echo $cedula;?>" id="input_cedula">
		<input type="hidden"  name="id" value="<?php echo $id;?>" id="id">		
		<br> 
		<h3 style="font-size:22px; text-align: center;">Y tu número telefónico es:</h3> 
		<p style="text-align:justify; color:black;">Télefono</p>
		<input type="text" name="telefono" id="telefono" value="<?php echo $tel;?>" readonly class="form-control"> 
		<br>
	
	<div style="text-align:center;" class="container">
	<button style="background-color:#f0e094;" id="btn_modificar" onclick="ir_my_profile()" class="btn btn-outline-success my-2 my-sm-0" type="button" >Modificar<i style="margin-left:10px;" class="fas fa-edit"></i></button>
	</div>
	<br>
	<!--- tv llega -->
	<h3 id="tv_set_llega" style="font-size:16px; text-align: center;"></h3> 
    </div>
    <div class="col-lg-5 border border-success">
    <h1 style="font-size:18px;">Resumen compra:</h1> 
			<div id="div_carrito" class="container"> 	
			</div>
			<hr style="height:2px;border-width:0;color:gray;background-color:gray"></hr>
			<div class="row justify-content-around">
				<div class="col-lg-6" >
				<h3 style="font-size:18px; text-align: center;">Subtotal</h3> 
				</div>
				<div class="col-lg-6" >
				<h3 id="tv_subtotal" style="font-size:18px; color:green; text-align: center;"></h3>
				<input type="hidden" id="input_subtotal" name="subtotal">
				</div>
				<div class="col-lg-6" >
				<h3 style="font-size:18px; text-align: center;">Envio</h3>
				<input type="hidden" id="input_envio" name="envio">
				</div>
				<div class="col-lg-6" >
				<h3 id="tv_costo_envio" style="font-size:18px; text-align: center;"></h3>
				</div>
				<div class="col-lg-6" >
				<h3 style="font-size:18px; text-align: center;">Pago electrónico</h3>
				</div>
				<div class="col-lg-6" >
				<h3 id="tv_costo_pago" style="font-size:18px; text-align: center;"></h3>
				<input type="hidden" id="input_medio_de_pago" name="medio_de_pago">
				</div>
				<br>
				<div class="col-lg-12" >
				<hr style="height:2px;border-width:0;color:gray;background-color:gray"></hr>
				</div>
				<div class="col-lg-6" >
				<h3 style="font-size:20px; text-align: center;">Total</h3>
				</div>
				<div class="col-lg-6" >
				<h3 id="tv_costo_total" style="font-size:20px; color:green; text-align: center;"></h3>
				</div>
			</div>
     </div>
	 <div style="text-align:center;" class="container">
	 <br><br>
		<div class="container card" id="div_pago"> 
		<br>
				<div class="container">
					<div class="col-lg-12" >
					<img id="img_btn_pagar"  src="" id="img_pago" />
					</div>
					<button style="background-color:green; color:black;" id="btn_pagar" class="btn btn-outline-success my-2 my-sm-0" type="button" ></button>
				<!-- fin form_ingresar_compra -->
				</form>
				</div>
				<br>
		</div>	
		<br><br>
		 <div class="container"> 
			<div class="row justify-content-center">
			  <div class="col-5">
				<a onclick="ventana_whatsapp()" class="btn btn-primary">Dudas? Preguntanos!</a>	 
			  </div>
			  <div class="col-5">
				<a onclick="ventana_whatsapp()" style="cursor:pointer;" ><img src="Imagenes_config/whatsapp1.png"></a> 
			  </div>  
			</div>  
		</div>	
		<br><br>	
	 </div>	 
 </div>  
</div>
<!-- formulario para wompi ---> 	
 <form id="form_wompi" action="https://checkout.wompi.co/p/" method="GET">
  <!-- OBLIGATORIOS -->
  <input type="hidden" name="public-key" value="pub_prod_mm5Qq0EJtZhzNzjV4Vm6fLQx6aHhCbjS" />
  <input type="hidden" name="currency" value="COP" />
  <input type="hidden" id="amount" name="amount-in-cents" value="900000" />
  <input type="hidden" id="ref" name="reference" value="RE1" />
  <!-- OPCIONALES -->
  <input type="hidden" id="redirect" name="redirect-url" value="https://tucasabonita.site/check_out.php" />
  <br>
</form>

<!--- dialogo pago negado -->
<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px; cursor:pointer;" data-toggle="modal" id="dialogo_error_pago" data-target="#dialogo1"></a>
			  <!-- INICIO DIALOGO NUEVO REGISTRO --> 
					<div class="modal fade" id="dialogo1">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <!-- cuerpo del diálogo -->
							  <div class="modal-body">
								Lo sentimos. Algo ha salido mal con tu pago. Prueba con otro medio de pago!
							  </div>
						  <!-- pie del diálogo -->
						<div class="row justify-content-around"> 
							<button type="button" data-dismiss="modal" style="background-color:#228b22;">Aceptar</button>
						</div> 
						<br>	<br>	
						</div>
					  </div>
					</div>
 <!-- FIN DIALOGO -->
<script>
check_id_trans();
var url="<?php echo $url;?>";
var costo_medio_pago= "<?php echo $medio_pago;?>";
var total_pagar;
var cedula,fecha,valor_compra_GBD,estado_trans;
cargar_compras();
cargar_btn_pagar();
set_llega();
cargar_datos_wompi();

function dialogo_error_pago(){
	document.getElementById('dialogo_error_pago').click();
}

function ventana_whatsapp(){
	 var href="https://api.whatsapp.com/send?phone=0573163439744&text=";
	 window.open(href, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=600");
}
	
function check_id_trans() {
  id_trans="<?php echo $id_trans;?>";
  if(id_trans==""){}else{
		 var uri='https://production.wompi.co/v1/transactions/'+id_trans;
		 $.getJSON(uri, function(datos) {
			    var arreglo = JSON.stringify(datos.data);
				var datas=JSON.parse(arreglo);
				fecha=datas.created_at;
				valor_compra_GBD=datas.amount_in_cents;
				estado_trans=datas.status;
				actualizar_datos();
			});
	 } 
	 
}

var conexion1;
function actualizar_datos(){
  conexion1=new XMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','Actualizar_ref_wompi.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(cargarDatos());  
}
function cargarDatos(){
	var cadena='ref='+encodeURIComponent(id_trans)+'&cliente='+encodeURIComponent(cedula)+'&valor_compra='+encodeURIComponent(valor_compra_GBD)+'&fecha='+encodeURIComponent(fecha)+'&estado='+encodeURIComponent(estado_trans);
	return cadena;
}
function procesarEventos(){
  if(conexion1.readyState == 4){  
    var dato=conexion1.responseText;
	if(dato=="updated"){
		if(estado_trans=="APPROVED"){
			document.getElementById("input_medio_de_pago").value=id_trans;
			document.getElementById("form_ingresar_compra").submit();
		}else{
			dialogo_error_pago();
		}
	}
  }
} 

function cargar_datos_wompi(){	
	// variables para form wompi
	cedula=<?php echo $cedula; ?>;
	ref="<?php echo $ref; ?>";
	document.getElementById("ref").value=ref;
	document.getElementById("amount").value=total_pagar+"00";
}

function pago_wompi(){
	guardar_transaccion();
}

var conexion_guardar_transaccion;
function guardar_transaccion() {
  conexion_guardar_transaccion=new XMLHttpRequest();
  conexion_guardar_transaccion.onreadystatechange = terminar_save_transaccion;
  conexion_guardar_transaccion.open('POST','Guardar_ref_wompi.php?', true);
  conexion_guardar_transaccion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion_guardar_transaccion.send(cargar_parametros());  
}
function cargar_parametros(){
	var cliente= document.getElementById("input_cedula").value;
	var cadena='&cliente='+encodeURIComponent(cliente)+'&valor_compra='+encodeURIComponent(total_pagar)+'&estado='+encodeURIComponent("Iniciada");
	return cadena;
}

function terminar_save_transaccion(){
	 if(conexion_guardar_transaccion.readyState == 4){
			var dato=conexion_guardar_transaccion.responseText;
			var dato=dato.trim();
			if(dato=="registra"){
				document.getElementById("form_wompi").submit();
			}else{
				alert("Ha ocurrido un error interno...");
			}
	 }
}

function pagar(){
	document.getElementById("input_medio_de_pago").value=costo_medio_pago;
	document.getElementById("form_ingresar_compra").submit();
}

function cargar_btn_pagar(){
	if(costo_medio_pago==0){
		document.getElementById("img_btn_pagar").src = "Imagenes_config/ico_contraEntrega.png";
		document.getElementById('btn_pagar').innerText="Confirmar compra con pago contraentrega.";
		document.getElementById("img_btn_pagar").style.width = "250px";
		document.getElementById('btn_pagar').setAttribute( "onClick", "pagar()" );
	}else{
		document.getElementById("img_btn_pagar").src = "Imagenes_config/wompi_btn.png";
		document.getElementById('btn_pagar').innerText="Pagar con wompi bancolombia";
		document.getElementById('btn_pagar').setAttribute( "onClick", "pago_wompi()" );
		
	}
}

function set_llega(){
	var text_1="*Llega entre el ";
	var text_1_1="<?php echo $dia_entrega_min?>";
	var tex_1_2=" de ";
	var text_2="<?php echo $mes_entrega_min ?>";
	var text_3=" y el ";
	var text_4="<?php echo $dia_entrega_max?>";
	var text_5="<?php echo $mes_entrega_max?>";
	document.getElementById("tv_set_llega").innerText=text_1+text_1_1+tex_1_2+text_2+text_3+text_4+tex_1_2+text_5;
}

function ir_my_profile(){
	location.href = url+"Registrarse_1.php?lacking=true";
}
function cargar_compras(){
	var productos=<?php echo json_encode($productos);?>;
	var imagenes=<?php echo json_encode($imagenes);?>;
	var valores=<?php echo json_encode($valores);?>;
	var cantidades=<?php echo json_encode($cantidades);?>;
	var count = productos.length;
	var div_carrito=document.getElementById('div_carrito');
	var subtotal=0;
	  for(var i=0;i<count;i++){
		  var div_row=document.createElement('div');
			div_row.classList.add("row");
			div_row.style.textAlign = "center";
			
			// div cantidad
			var div_cantidad=document.createElement('div');
			div_cantidad.classList.add('col-sm-1');
			div_cantidad.classList.add('align-self-center');
			var cant=document.createElement('h3');
			cant.innerHTML=cantidades[i];
			cant.style.fontSize="18px";	
			div_cantidad.appendChild(cant);
			
			// div imagen
			var div_col=document.createElement('div');
			div_col.classList.add("col-sm-2");
			div_col.style.margin="10px";
			div_col.style.padding ="8px";
			// imgs
		    var images=document.createElement('img'); 
			images.src="Imagenes_productos/"+imagenes[i];
		    images.style.height="100px";
			images.style.width="100px";
			images.classList.add("img-fluid");
			div_col.appendChild(images);

			// div producto
			var div_producto=document.createElement('div');
			div_producto.classList.add('col-sm-4');
			div_producto.classList.add('align-self-center');
			// titulo producto
			var product=document.createElement('h3');
			product.innerHTML=productos[i];
			product.style.fontSize="18px";	
			div_producto.appendChild(product);
						
		  //  div subtotal
		  // sumar subtotal 
		   var cant =cantidades[i];
		   var estetotal=cant*parseInt(valores[i]);
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
			
			div_row.appendChild(div_cantidad);
			div_row.appendChild(div_col);
			div_row.appendChild(div_producto);
			div_row.appendChild(div_precio);	
			div_carrito.appendChild(div_row);
	  }
	  var subtotal1=Math.round(subtotal);
	  document.getElementById('input_subtotal').value=subtotal1;
	  var format_total_pagar=new Intl.NumberFormat("de-DE").format(subtotal1);
	  document.getElementById('tv_subtotal').innerText="$ "+format_total_pagar;
	  // subtotal con envio y check si envio gratis
	  var costo_envio;
	if(subtotal1>100000){
		document.getElementById('tv_costo_envio').innerText="$ 0";
		costo_envio=0;
	}else{
		costo_envio=10000;
		document.getElementById('tv_costo_envio').innerText="$ 10.000";
	}
	document.getElementById("input_envio").value=costo_envio;
	costo_medio_pago=Math.round(costo_medio_pago);
	var format_costo_medio_pago=new Intl.NumberFormat("de-DE").format(costo_medio_pago);
	document.getElementById('tv_costo_pago').innerText="$ "+format_costo_medio_pago;
	total_pagar=subtotal1+costo_envio+costo_medio_pago;
	total_pagar=Math.round(total_pagar);
	var format_total_pagar=new Intl.NumberFormat("de-DE").format(total_pagar);
	document.getElementById('tv_costo_total').innerText="$ "+format_total_pagar;
}
</script>
</body>
</html>