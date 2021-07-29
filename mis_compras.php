<?php
header('Content-type: text/html; charset=utf-8');
include("mis_compras_hipertext.php");
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css">
	<title>Mis compras</title>
  </head>
  <body >
 <?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
<br>
<div class="container border border-success">
	<h3>Seguimiento compra</h3>
	<h3 id="tv_titulo_compra_n" style="text-align:center; color:blue;"></h3>
	<h4 style="text-align:center;"></h4>
	<div id="div_lista_articulos" class="container"> 	
	</div>
	<br>
	<div id="div_subtotal" class="row justify-content-around">
				<div class="col-lg-6" >
				<h3 style="font-size:20px; text-align: center;">Total</h3> 
				</div>
				<div class="col-lg-6" >
				<h3 id="tv_subtotal" style="font-size:20px; color:blue; text-align: center;"></h3>
				</div>
				<div class="col-lg-6" >
				<h3 style="font-size:18px; color:grey; text-align: center;">Costo envio</h3> 
				</div>
				<div class="col-lg-6" >
				<h3 id="tv_costo_envio" style="font-size:18px; color:grey; text-align: center;"></h3>
				</div>
				<div class="col-lg-6" >
				<h3 style="font-size:20px; color:grey; text-align: center;">Forma de pago</h3> 
				</div>
				<div class="col-lg-6" >
				<h3 id="tv_medio_de_pago" style="font-size:20px; color:blue; text-align: center;"></h3>
				</div>
	</div>
	<!--- Check boxes estado de pedido -->
	<br><br>
	<div id="div_seguimiento_compra" class="row justify-content-around">
				<div class="col-lg-6" >
					<div class="row justify-content-center">
					  <div class="col-1">
						<img id="img_recibida" src="Imagenes_config/unchecked_checkbox.png" width="30" height="30">
					  </div>
					  <div class="col-5">
						<h3 id="tv_recibida" style="font-size:18px; color:#c0c0c0; text-align: center;">Orden de compra recibida</h3> 
					  </div>  
					</div>
					
					<div class="row justify-content-center">
					  <div class="col-1">
						<img id="img_preparando" src="Imagenes_config/unchecked_checkbox.png" width="30" height="30">
					  </div>
					  <div class="col-5">
						<h3 id="tv_preparando" style="font-size:18px; color:#c0c0c0; text-align: center;">Preparando tus productos</h3> 
					  </div>  
					</div>
					
					<div class="row justify-content-center">
					  <div class="col-1">
						<img id="img_camino" src="Imagenes_config/unchecked_checkbox.png" width="30" height="30">
					  </div>
					  <div class="col-5">
						<h3 id="tv_camino" style="font-size:18px; color:#c0c0c0; text-align: center;">Tu compra va en camino a casa</h3> 
					  </div>  
					</div>
					
					<div class="row justify-content-center">
					  <div class="col-1">
						<img id="img_entregada" src="Imagenes_config/unchecked_checkbox.png" width="30" height="30">
					  </div>
					  <div class="col-5">
						<h3 id="tv_entregada" style="font-size:18px; color:#c0c0c0; text-align: center;">Compra entregada</h3> 
					  </div>  
					</div>
					<br>
				</div>
				<div class="col-lg-6" >
					<div class="row justify-content-center">
					  <div class="col-5">
						<a onclick="ventana_whatsapp()" class="btn btn-primary">Inquietudes? Escribenos!</a>	 
					  </div>
					  <div class="col-1">
						<a onclick="ventana_whatsapp()" style="cursor:pointer;"><img src="Imagenes_config/whatsapp1.png"></a> 
					  </div>  
					</div>
				</div>
	</div>
</div>
<br>
<div class="container">
	<h3 style="text-align:center;" >Historial de compras</h3>
	<div id="div_historial_compras" class="container"> 	
	</div>
	<br>
</div>	

<!--- dialogo error pago -->
<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px; cursor:pointer;" data-toggle="modal" id="dialogo_reintentar_pago" data-target="#dialogo1"></a>
			  <!-- INICIO DIALOGO NUEVO REGISTRO --> 
					<div class="modal fade" id="dialogo1">
					  <div class="modal-dialog modal-lg">
						<div class="modal-content">
						  <!-- cuerpo del diálogo -->
						  <br> <br>
							  <div class="modal-title text-center">
								<span id="alert_check_contra" style="color:black;" ><strong>Algo ha salido mal con tu pago! Que tal si intentas con otro medio de pago.</strong></span>
								<br> <br>
							  </div>
						  <!-- pie del diálogo -->
						<div class="modal-title text-center">
							<a <button type="button" href="https://tucasabonita.site/Shopping_cart.php" style="background-color:#228b22; color:black;" class="btn btn-outline-success my-2 my-sm-0">Intentar con otro medio de pago</button></a>
						</div> 
						<br><br>		
						</div>
					  </div>
					</div>
 <!-- FIN DIALOGO -->
<script src="functions.php"></script>
<script>
revisar_compras_por_entregar();
cargar_historial_compras();

function dialogo_error_pago(){
	document.getElementById("dialogo_reintentar_pago").click();
}

function ventana_whatsapp(){
	 var href="https://api.whatsapp.com/send?phone=0573163439744&text=";
	 window.open(href, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=600");
}

function cargar_historial_compras(){
	var error="<?php echo $error;?>";
	if(error=="true"){
		dialogo_error_pago();
	}
	// variable para verificar si error pago desde app
	var productos=<?php echo json_encode($articulos_entre_productos);?>;
	var fechas=<?php echo json_encode($fecha_entre);?>;
	var imagenes=<?php echo json_encode($articulos_entre_img);?>;
	var valores=<?php echo json_encode($articulos_entre_precios);?>;
	var cantidades=<?php echo json_encode($articulos_entre_cant);?>;
	var codigos=<?php echo json_encode($articulos_entre_cods);?>;
	var num_compra=<?php echo json_encode($num_compra_entre);?>;
	if(productos!=null){
		 count = productos.length;
	}else{
		 count = 0;
	}
	var div_carrito=document.getElementById('div_historial_compras');
	var subtotal=0;
	  for(var i=0;i<count;i++){
		  var div_row=document.createElement('div');
			div_row.classList.add("row");
			div_row.style.textAlign = "center";
			
			// div fecha 
			var div_cantidad=document.createElement('div');
			div_cantidad.classList.add('col-sm-2');
			div_cantidad.classList.add('align-self-center');
			var cant=document.createElement('h3');
			
			cant.innerHTML="Entregado el "+fechas[i];
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
			// unidades al lado de producto
			var product_cant=document.createElement('h3');
			product_cant.innerHTML=cantidades[i]+" unidad.";
			product_cant.style.fontSize="18px";	
			div_producto.appendChild(product_cant);
		   var cant =cantidades[i];
		   // texto precios
		    var precio=document.createElement('h3');
			var precio_format=new Intl.NumberFormat("de-DE").format(valores[i]);
			precio.innerHTML="$ "+precio_format;
			precio.style.fontSize="18px";	
			div_producto.appendChild(precio);	
		   
		   // div para bton volver a comprar....
		   var div_precio=document.createElement('div');
		   div_precio.classList.add('col-sm-3');
		   div_precio.classList.add('align-self-center');
			// crear elementos....
			var anchor=document.createElement('a');
			anchor.text ="Volver a comprar!";
			anchor.style.height="50px";
			anchor.style.textAlign = "center";
			anchor.style.color = "white";
			anchor.style.fontSize="22px";
			anchor.style.cursor="pointer";
			anchor.style.padding="10px";
			anchor.style.backgroundColor="green";			
			anchor.classList.add("btn-primary");
			anchor.classList.add("card");
			var id_anchor_prod= "anchor_";
			anchor.id=id_anchor_prod+codigos[i];
			anchor.addEventListener("click", function(event) {
				var id= this.id;
				var cut = id.split("_");
				var href = "https://tucasabonita.site/Productos.php?producto="+encodeURIComponent(window.btoa(cut[1]));
				window.location.href = href;
			});
			div_precio.appendChild(anchor);
			var salto= document.createElement('br');
			div_precio.appendChild(salto);

			// btn ver detalles compra historica
			var anchor_detalles=document.createElement('a');
			anchor_detalles.text ="Ver detalles";
			anchor_detalles.style.textAlign = "center";
			anchor_detalles.style.color = "blue";
			anchor_detalles.style.fontSize="16px";
			anchor_detalles.style.cursor="pointer";
			anchor_detalles.style.padding="10px";			
			anchor_detalles.classList.add("btn-primary");
			anchor_detalles.classList.add("card");
			var id= "anchor_";
			anchor_detalles.id=id+num_compra[i];
			anchor_detalles.addEventListener("click", function(event) {
				var id= this.id;
				var cut = id.split("_");
				var href_detalles = "https://tucasabonita.site/detalle_compra_web.php?compra_n="+encodeURIComponent(window.btoa(cut[1]));
			    window.location.href = href_detalles;
			});
			div_precio.appendChild(anchor_detalles);
			div_row.appendChild(div_cantidad);
			div_row.appendChild(div_col);
			div_row.appendChild(div_producto);	
			div_row.appendChild(div_precio);
			div_carrito.appendChild(div_row);
			
	  }
}

function revisar_compras_por_entregar(){
	var compras_por_entregar="<?php echo $compras_por_entregar;?>";
	if(compras_por_entregar=="true"){
		var num_compra="<?php echo $num_compra;?>";
		var fecha_compra="<?php echo $fecha;?>";
		document.getElementById("tv_titulo_compra_n").innerText="Compra N° "+ num_compra+" del "+ fecha_compra;
		document.getElementById("div_lista_articulos").innerText="Lista articulos";
		cargar_lista_articulos_por_entregar();
		check_estado_compra();
	}else{
		cero_compras_por_entregar();
		document.getElementById("div_seguimiento_compra").style.display='none';
		document.getElementById("div_subtotal").style.display='none';
	}
}

function check_estado_compra(){
	var estado="<?php echo $estado;?>";
	if(estado=="Recibida"){
		document.getElementById("img_recibida").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_recibida").style.color="green";
	}
	if(estado=="Preparando"){
		document.getElementById("img_preparando").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_preparando").style.color="green";
		document.getElementById("img_recibida").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_recibida").style.color="green";
	}
	if(estado=="En camino"){
		document.getElementById("img_camino").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_camino").style.color="green";
		document.getElementById("img_preparando").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_preparando").style.color="green";
		document.getElementById("img_recibida").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_recibida").style.color="green";
	}
	if(estado=="Entregada"){
		document.getElementById("img_entregada").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_entregada").style.color="green";
		document.getElementById("img_camino").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_camino").style.color="green";
		document.getElementById("img_preparando").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_preparando").style.color="green";
		document.getElementById("img_recibida").src="Imagenes_config/check_box_verde.jpg";
		document.getElementById("tv_recibida").style.color="green";
	}
}

function cero_compras_por_entregar(){
	var br=document.createElement('br');
	var msje=document.createElement('h3');
	msje.style.textAlign = "center";
	msje.innerHTML="Por el momento no tienes compras pendientes por recibir!";
	msje.style.fontSize="24px";	
	var anchor=document.createElement('a');
	anchor.text ="Que tal si le echas un vistazo a estas novedades!";
	//anchor.style.width="500px";
	anchor.style.textAlign = "center";
	anchor.style.color = "green";
	anchor.style.fontSize="22px";
	anchor.style.cursor="pointer";	
	anchor.classList.add("btn-primary");
	anchor.classList.add("card");
	anchor.addEventListener("click", function(event) {
	  window.location.href = "https://tucasabonita.site/Searched.php?lookingfor=Tm92ZWRhZGVz";
	});
	var div_carrito=document.getElementById('div_lista_articulos');
	div_carrito.appendChild(br);
	div_carrito.appendChild(msje);
	div_carrito.appendChild(anchor);	
}

function cargar_lista_articulos_por_entregar(){
	var productos=<?php echo json_encode($articulos_sin_entregar_productos);?>;
	var imagenes=<?php echo json_encode($articulos_sin_entregar_img);?>;
	var valores=<?php echo json_encode($articulos_sin_entregar_precios);?>;
	var cantidades=<?php echo json_encode($articulos_sin_entregar_cant);?>;
	var medio_de_pago="<?php echo $articulos_sin_entregar_medio_pago;?>";
	var domicilio="<?php echo $articulos_sin_entregar_domicilio;?>";
	var count;
	if(productos!=null){
		 count = productos.length;
	}else{
		 count = 0;
	}
	var div_carrito=document.getElementById('div_lista_articulos');
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
	  var format_total_pagar=new Intl.NumberFormat("de-DE").format(subtotal1);
	  document.getElementById('tv_subtotal').innerText="$ "+format_total_pagar;
	  //costo domicilio
	  var cut_domi = domicilio;
	  var costo_domicilio = cut_domi.split(" ");
	  var format_costo_domicilio=new Intl.NumberFormat("de-DE").format(costo_domicilio[0]);
	  document.getElementById('tv_costo_envio').innerText="$ "+format_costo_domicilio;
	  // medio de pago
	  var str = medio_de_pago;
	  var res = str.split(".");
	  document.getElementById('tv_medio_de_pago').innerText=res[1];
}

</script>
</body>
</html>