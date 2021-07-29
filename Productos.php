<?php
header('Content-type: text/html; charset=utf-8');
include("Productos_hipertext.php");
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css">
	<title>Productos</title>
  </head>
  <body >
 <?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
<br>
<!-- div contenedor producto: miniaturas, img main y comprar --->
 <div id="div_producto_todo" style="padding: 1em 3em; margin: 1em 5%;">
    <div class="row">
		<div  id="div_miniaturas" class="row col-lg-2 col-sm-12">
		<?php
		for($a=0;$a<count($imagenes_producto);$a++){
			echo '<div class="col-sm-3 col-md-12" style="height: 80px; width: 100px; margin:5px;" onclick="cambiar_imagen(';
			echo $a;
			echo ',';
			echo "this";
			echo')" class="col-md-12 border">';
			echo  	'<img class="img-fluid" style="height: 80px; width: 100px;"  src="';
			echo 		"Imagenes_productos/".$imagenes_producto[$a];
			echo 		'">';
			echo '</div>';
			echo '<br>';
		}
		?>
		</div>
		<div class="col-lg-6 col-sm-12 border" >
			<div class="row">
				<div id="div_previous_img" style="cursor:pointer;" class="col-sm-1 align-self-center">
				<i id="tv_previous_image"  onclick="previous_image()" class="card fas fa-angle-double-left fa-2x"></i>
				</div>
				<div class="col-sm-10 align-self-center">
				<img id="img_main" style="padding:2px; display:block; margin:auto;" src="Imagenes_config/loading.gif" class="img-fluid">
				</div>
				<div id="div_next_img" style="cursor:pointer;" class="col-sm-1 align-self-center">
				<i id="tv_next_image"  onclick="next_image()" class="card fas fa-angle-double-right fa-2x"></i>
				</div>
				<div  style="cursor:pointer;" class="col-sm-1 align-self-end">
				<i onclick="set_full_screen()" class="card fas fa-expand fa-2x"></i>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-sm-12">
				<div class="card text-center">
				  <div>
					<br>
					<h3 style="font-size:36px;" id="titulo_producto" class="card-title"></h3>
					<br><br>
					<h3 id="tv_precio_antes" style="color:#ff0000; text-decoration:line-through; font-size:22px;" class="card-text"></h3>
					<h3 id="tv_precio" style="font-size:36px;" class="card-text"></h3>
					<br><br>
					<div class="container">
						<div class="row">
							<div class="col-sm-5 col-12">
								<h5 style="color:#9c9c9c;">Cantidad</h5>
							</div>
							<div style="cursor:pointer;" class="col-sm-1 col-4">
								<i id="tv_menos" onclick="menos_cantidad()" class="fas fa-minus"></i>
							</div>
							<div class="col-sm-4 col-4">
								<h5 id="tv_cantidad">1</h5>
							</div>
							<div  style="cursor:pointer;" class="col-sm-1 col-4">
								<i id="tv_mas" onclick="mas_cantidad()" class="fas fa-plus"></i>
							</div>
						</div>	
					</div>
					<br><br>
					<h3 style="font-size:18px; color:green;">Envio gratis en el área metrópolitana de Bucaramanga!</h3>
					<p >(Compras superiores a $100.000)</p>
					<h3 id="tv_llega" style="font-size:18px;"></h3>
					<br><br>
					<!-- formulario producto -->
					<form method="post" id="form_producto" action="Shopping_cart.php">
					  <input type="hidden" id="id_producto" name="id_producto">
					  <input type="hidden" id="cantidad" name="cantidad">
					  <input type="hidden" id="cedula" name="cedula">
					</form>
					<a href="#" id="btn_comprar" onclick="comprar()" style="background-color:green;" class="btn btn-primary">Comprar</a>
					<br><br>
				  </div>
				</div>
		</div>
	</div>
</div>	
<!-- fin  div contenedor producto: miniaturas, img main y comprar --->
<br>
<div class="container">
	<div class="card text-center">
		<h2 style="text-align:center" >Descripcion</h2>
		<p id="tv_descripcion" style="font-size:20px;"></p>
	</div>
<br><br>
<p><strong style="color:red;">*</strong>La disponibilidad, el precio y la cantidad de unidades de los productos esta sujeta a las unidades disponibles en inventario. 
Tu Casa Bonita no se hace responsable por el posible agotamiento de unidades.</p>
<br><br>
<div style="cursor:pointer;" class="row" >
	<div style="margin:2px;" class="col-sm-4 col-md-3 col-lg-2">
		<h2>Pregunta sobre este producto</h2>
	</div>
	<div style="margin:2px;" class="col-sm-3 col-md-3 col-lg-2">
		<a onclick="preguntar_sobre('Tiene costo el envio?')" class="btn btn-primary">Tiene costo el envio?</a>
	</div>
	<div style="margin:2px;" class="col-sm-4 col-md-3 col-lg-2">
		<a onclick="preguntar_sobre('Tiene garantía?')" class="btn btn-primary">Tiene garantía?</a>
	</div>
	<div style="margin:2px" class="col-sm-6 col-md-3 col-lg-3">
		<a onclick="preguntar_sobre('Puedo recoger el producto?')" class="btn btn-primary">Puedo recoger el producto?</a>
	</div>
	<div style="margin:2px;" class="col-sm-6 col-md-2 col-lg-2">
		<a onclick="ventana_whataspp()"><img src="Imagenes_config/whatsapp1.png"></a>
	</div>
	<br><br>
</div>	
<br><br>	
<div class="row" >	
		<form class="form-inline" >
		  <div class="col-sm-6">
		  <textarea style="background-color:#D5DBDB;" id="tv_preguntar"class="form-control-plaintext"  rows="2" cols="150" placeholder="Escribe una pregunta..."></textarea>
		  </div>
		  <div class="col-sm-6">
		  <button type="button" id="btn_preguntar" style="margin:2px;" onclick="preguntar_sobre('')" class="btn btn-primary btn-lg" >Preguntar</button>
		  </div>
		</form>
	
</div>	
<br><br>
<!--- div preguntas --->
<div id="div_contenedor_preguntas" class="container">
<hr style="background-color:#f0e094">
</div>
<!-- Div productos relacionados -->
<br>
<div class="container">
 <h3>Otras personas quienes vieron este producto tambien compraron </h3>
 </div>
 <br>
<div class="container" >
<div class="row">
	<?php
	for($c=0;$c<count($nombre_s);$c++){ 
     echo  '<div ';
		echo 'onclick="cargar_producto(';
		echo $cod_s[$c];
		echo ')"';
		echo 'class="col-md-4">';
		echo '<div class="card" style="cursor:pointer;" >';
		echo	'<h5 style="text-align:center; margin-top:6px; font-weight: bold;" class="card-title">';
		echo 	$nombre_s[$c];
		echo	'</h5>';
		echo  	'<img style="padding:4px;" src="';
		echo 		$images_s[$c]; 
		echo 		'" class="card-img-top">';
		echo 		'<p style="text-align:center; margin-top:2px;">';
		echo "$ ".number_format($precio_s[$c],0,",",".");
		echo	'</p>';
		echo '</div>';
	  echo '</div>';
	}
	?>  
	</div>
</div>
<br><br>
<div class="container" >
<h5>Pagos seguros</h5>
    <img  class="img-fluid" src="Imagenes_config/metodo_de_pago_wompi.png">
</div>	
<br>
<!-- Footer -->
<footer style="background-color:#f9f9c5;" class="page-footer font-small indigo">

  <!-- Footer Links -->
  <div class="container">

    <!-- Grid row-->
    <div class="row text-center d-flex justify-content-center pt-5 mb-3">

      <!-- Grid column -->
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Nosotros</a>
        </h6>
      </div>
      <!-- Grid column -->

      <!-- 
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Productos</a>
        </h6>
      </div>

      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Awards</a>
        </h6>
      </div>
 
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Ayuda</a>
        </h6>
      </div>

      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Contacto</a>
        </h6>
      </div>
      -->

    </div>
    <!-- Grid row-->
    <hr class="rgba-white-light" style="margin: 0 15%;">

    <!-- Grid row-->
    <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">

      <!-- Grid column -->
      <div class="col-md-8 col-12 mt-5">
	  <div class="row">
		<div class="col-md-6">
		  <img width="200px;" src="Imagenes_config/casa_bonita_google_play.png">
		</div>
		<div class="col-md-6">	
			<p style="margin:2px;" ><br>Estamos ubicados en la calle 56 #3w-22. Barrio Mutis. <br> Bucaramanga. Santander.
			<br><br>Telefonos: 31661824363 - 3163439744 - 3116186785
			<br><br>E-mail: contacto@tucasabonita.site
			</p>
			<br><br>
			 <div class="container"> 
				<div class="row justify-content-center">
				  <div class="col-6">
					<a onclick="ventana_whatsapp()" class="btn btn-primary">Escribenos!</a>	 
				  </div>
				  <div class="col-6">
					<a onclick="ventana_whatsapp()" style="cursor:pointer;" ><img src="Imagenes_config/whatsapp1.png"></a> 
				  </div>  
				</div>  
			</div>
		</div>	
		</div>
	  </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->
    <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">

    <!-- Grid row-->
	<br>
    <div class="row pb-3">
      <!-- Grid column -->
      <div style="text-align:center;" class="col-md-12">
        <div class="mb-5 flex-center">
          <!-- Facebook -->
          <a href="https://www.facebook.com/TucasabonitaBmanga" class="fb-ic">
            <i  class="fab fa-facebook-f fa-lg white-text mr-4"> </i>
          </a>
          
          <!-- Google 
          <a class="gplus-ic">
            <i class="fab fa-google-plus-g fa-lg white-text mr-4"> </i>
          </a>
           +-->
          <!--Instagram-->
          <a class="ins-ic">
            <i class="fab fa-instagram fa-lg white-text mr-4"> </i>
          </a>
        </div>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
  </div>

</footer>
<!-- Footer -->
<script src="functions.php"></script>
<script>
window.addEventListener('load', start_events, false);
var images;
var id_image_actual, count_images;
var div_image_miniatura_actual;
var precio;
var id_producto;
var conexion;

setTimeout(quitar_div, 100);
window.addEventListener('resize', quitar_div);
function quitar_div(){
var ancho=$(window).width();
	if(ancho<700){
		document.getElementById("div_previous_img").remove();
		document.getElementById("div_next_img").remove();
		document.getElementById("div_producto_todo").style.padding = null;
		// style="padding: 1em 3em; margin: 1em 5%;
		//div
		//div.style.width = "100px";
		//document.getElementById("div_carousel").style.height ="380px";
	}
}

function check_agotado(){
	if(precio=="0"){
		document.getElementById("btn_comprar").innerHTML="Producto agotado!";
		document.getElementById("btn_comprar").style.backgroundColor="#ff8000";
		document.getElementById("tv_precio").innerText="";
		$("#btn_comprar").removeAttr("onclick");
	}else{
		set_precio_antes();
	}
}

function ventana_whatsapp(){
	 href="https://api.whatsapp.com/send?phone=0573163439744&text=";
	 window.open(href, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=600");
}

function cargar_preguntas(){
  conexion=new XMLHttpRequest();
  conexion.onreadystatechange = procesar_preguntas;
  conexion.open('POST','get_preguntas_mysql.php', true);
  conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion.send('producto='+encodeURIComponent(id_producto));
	
}

function procesar_preguntas(){
	if(conexion.readyState == 4){
		cargar_div_preguntas(conexion.responseText);
	}
}

function cargar_div_preguntas(responseText){
	var json = JSON.parse(responseText);
	var titulo=document.createElement('h3');
	
	
	var count;
	if(json!=null){
		titulo.innerHTML="Últimas preguntas realizadas";
		count = Object.keys(json.pregunta).length;
	}else{
		titulo.innerHTML="Aún no han realizado preguntas sobre este producto. Sé tu el primero!";
		count = 0;
	}
	var br=document.createElement('br');
	var div = document.getElementById('div_contenedor_preguntas');
	div.appendChild(titulo);
	div.appendChild(br);
	for(var i=0;i<count;i++){
		var titulo_pregunta = document.createElement('p');
		var strong = document.createElement('strong');
		strong.innerText="Pregunta:";
		titulo_pregunta.appendChild(strong);
		titulo_pregunta.style.fontSize="20px";
		
		var pregunta = document.createElement('p');
		pregunta.innerText=json.fecha[i]+": ";
		pregunta.innerText +=json.pregunta[i];
		pregunta.style.fontSize="20px";
		
		var titulo_respuesta = document.createElement('p');
		var strong1 = document.createElement('strong');
		strong1.innerText="Respuesta:";
		titulo_respuesta.appendChild(strong1);
		titulo_respuesta.style.fontSize="20px";
		
		var respuesta = document.createElement('p');
		var texto_resp;
		if(json.respuesta[i]==null){
			texto_resp="Dentro de poco te daremos respuesta XD";
		}else{
			texto_resp=json.respuesta[i];
		}
		respuesta.innerText=texto_resp;
		respuesta.style.fontSize="20px";
		respuesta.style.color="gray";		
		div.appendChild(titulo_pregunta);
		div.appendChild(pregunta);
		div.appendChild(titulo_respuesta);
		div.appendChild(respuesta);
	}
  var hr=document.createElement('hr'); 
  hr.style.backgroundColor="#f0e094";
  div.appendChild(hr);
}

function preguntar_sobre(msje){
	if(cedula==""){
		location.href = "https://tucasabonita.site/Login.php?inbox=question&producto="+encodeURIComponent(window.btoa(id_producto))+"&from=producto";
	}else{
		if(msje==""){
		var mensaje=document.getElementById("tv_preguntar").value;
		if(mensaje==""){
		}else{
			registrar_pregunta(mensaje);
		}
		}else{
			document.getElementById("tv_preguntar").value=msje;
			document.getElementById("tv_preguntar").style.backgroundColor="#f0e094";
			document.getElementById("btn_preguntar").style.backgroundColor="green";
		}
	}
}

function registrar_pregunta(pregunta){
  conexion=new XMLHttpRequest();
  conexion.onreadystatechange = procesar;
  conexion.open('POST','registrar_pregunta.php', true);
  conexion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion.send(cargar_parametros(pregunta)); 	
}

function cargar_parametros(pregunta){
	var cadena='cedula='+encodeURIComponent(cedula)+"&producto="+encodeURIComponent(id_producto)+"&pregunta="+encodeURIComponent(pregunta);
	return cadena;
}

function procesar(){
	if(conexion.readyState == 4){
		limpiar_div_preguntas();
		cargar_preguntas();
	}
}

function limpiar_div_preguntas(){
		var div = document.getElementById('div_contenedor_preguntas');
			while (div.firstChild) {
				div.removeChild(div.firstChild);
			}	
}

function comprar(){
	if(cedula==""){
		location.href = "https://tucasabonita.site/Login.php?producto="+encodeURIComponent(window.btoa(id_producto))+"&from=producto";
	}else{
		document.getElementById("id_producto").value=id_producto;	
		document.getElementById("cantidad").value=document.getElementById("tv_cantidad").innerText;
		document.getElementById("cedula").value=cedula;
		document.getElementById("form_producto").submit();
	}
}

function start_events(){
	images= <?php echo json_encode($imagenes_producto);?>;
	id_producto=<?php echo $cod_prod;?>;
	count_images=images.length;
	set_image_indiv();
	set_llega();
	cargar_preguntas();	
	check_agotado();
}

function set_full_screen(){
	var imagen = document.getElementById("img_main");
	getFullscreen(imagen);
}

function getFullscreen(element){
  if(element.requestFullscreen) {
      element.requestFullscreen();
    } else if(element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if(element.webkitRequestFullscreen) {
      element.webkitRequestFullscreen();
    } else if(element.msRequestFullscreen) {
      element.msRequestFullscreen();
    }
}

function set_llega(){
	var text_1="Llega entre el ";
	var text_1_1="<?php echo $dia_entrega_min?>";
	var tex_1_2=" de ";
	var text_2="<?php echo $mes_entrega_min ?>";
	var text_3=" y el ";
	var text_4="<?php echo $dia_entrega_max?>";
	var text_5="<?php echo $mes_entrega_max?>";
	document.getElementById("tv_llega").innerText=text_1+text_1_1+tex_1_2+text_2+text_3+text_4+tex_1_2+text_5;
}
function mas_cantidad(){
	var cant = document.getElementById("tv_cantidad").innerText;
	var nuevaCant=parseInt(cant)+1;
	if(nuevaCant>=4){nuevaCant=4;}
	document.getElementById("tv_cantidad").innerText=nuevaCant;
	
}
function menos_cantidad(){
	var cant = document.getElementById("tv_cantidad").innerText;
	var nuevaCant=parseInt(cant)-1;
	if(nuevaCant<=0){nuevaCant=1;}
	document.getElementById("tv_cantidad").innerText=nuevaCant;
}

function set_image_indiv(){
	id_image_actual=0;
	document.getElementById("img_main").src="Imagenes_productos/"+images[0];
	var div_min= document.getElementById("div_miniaturas");
	div_min.childNodes[1].style.borderLeft = "thick solid brown";
	div_image_miniatura_actual=div_min.childNodes[1];
	document.getElementById("titulo_producto").innerText="<?php echo $nombre_producto?>";
	precio=<?php echo $precio_producto?>;
	var precio_format=new Intl.NumberFormat("de-DE").format(precio);
	document.getElementById("tv_precio").innerText= "Hoy! $ "+precio_format;
	document.getElementById("tv_descripcion").innerText=<?php echo json_encode($descripcion_producto);?>;
}
function set_precio_antes(){
	var precio_ant= (parseInt(precio)*0.2)+precio;
	var precio_format=new Intl.NumberFormat("de-DE").format(precio_ant);
	document.getElementById("tv_precio_antes").innerText= "Antes: $ "+precio_format;
}
function cambiar_imagen(pos, get_div){
	id_image_actual=pos;
	document.getElementById("img_main").src="Imagenes_productos/"+images[pos];
	var div_min= document.getElementById("div_miniaturas");
	  for(var x=0;x<div_min.childNodes.length;x++) {
		if (div_min.childNodes[x].nodeType==Node.ELEMENT_NODE){
			div_min.childNodes[x].style.borderLeft = "";
		}
	  }
	get_div.style.borderLeft = "thick solid brown";
}

function next_image(){
	var next = id_image_actual+1;
	if(next>count_images-1){
		next=0;
	}
	cambiar_imagen(next, div_image_miniatura_actual);
}

function previous_image(){
	var next = id_image_actual-1;
	if(next<0){
		next=count_images-1;
	}
	cambiar_imagen(next, div_image_miniatura_actual);
}

$(document).keydown(function(event) { 
  var key = (event.keyCode);
  if(key==37){
    previous_image();
  }
  if(key==39){
    next_image();
  }
  if(key==13){
    exit_full_screen();
  } 
});

function exit_full_screen(){
	if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
}
</script>
</body>
</html>