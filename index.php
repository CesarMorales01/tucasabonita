<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css">
	<title>Tu casa bonita</title>
  </head>
  <body >
  
  
<?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>

<!-- carousel-->
<div class="container">		
    <div id="carousel1" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
	  <?php
	   for($a=0;$a<count($descrip_promos);$a++){
        echo '<li data-target="#carousel1" data-slide-to="';
		echo $a;
		echo '"';
		echo 'class="active"';
		echo '>';
		echo '</li>';
	   }
		?>
      </ol>
      <!-- diapositivas -->
      <div id="div_carousel" style="margin: 0 auto; width:600px; height:700px;" class="carousel-inner">
	   <?php
	   for($b=0;$b<count($descrip_promos);$b++){
		   if($b==0){ echo '<div style="cursor:pointer;" onclick="cargar_promo(';
		   echo $b;
		   echo ')" class="carousel-item active">';
		   }else{ echo '<div style="cursor:pointer;" onclick="cargar_promo(';
		   echo $b;
		   echo ')" class="carousel-item">';}
				echo '<img  style="max-width:100%;width:auto;max-height:70%;" class="img-fluid" src="';
				echo $descrip_promos[$b];
				echo '" >';
				// para poner titulo y texto a una diapositiva -->
				 echo '<div class="carousel-caption">';
				 // en realidad el h3 deberia ir aca pero se me acomodo mejor abajo del div carousel caption
				 echo '<p></p>';
				 echo '</div>';
				 
				 echo '<h3 style="color:black; font-size:24px; text-align:center; margin-top:10px;" >';
				 echo $descripciones_promos[$b];
				 echo '</h3>';	
				 
			echo '</div>';
		 }
		?>
      </div>
      <!-- botones de desplazamiento a izquierda y derecha -->      
      <a  class="carousel-control-prev" href="#carousel1" data-slide="prev">
        <span style="background-color:#fb6a4b;" class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel1" data-slide="next">
        <span style="background-color:#fb6a4b;" class="carousel-control-next-icon" aria-hidden="true"></span>
        <span  class="sr-only">Next</span>
      </a>
    </div>
</div>
<!-- Fin div container para carousel -->
 <br><br>
 
  <!-- boton flotante fb-->
  <div id="div_btn_fb1" style="display:scroll; position:fixed; bottom:186px; right:-900px; z-index: 1; cursor:pointer;" class="container">
		<a onclick="close_button_fb()"><i class="fas fa-window-close"></i></a>
</div>
  <div id="div_btn_fb2" style="display:scroll; position:fixed; bottom:150px; right:-820px; z-index: 1; cursor:pointer;"   onclick="ir_fb()" class="container">
		<h5 id="btn_fb" >Síguenos!</h5>
</div> 
<div id="div_btn_fb" style="display:scroll; position:fixed; bottom:80px; right:240px; z-index: 1; cursor:pointer;"   onclick="ir_fb()" class="container">
		<img  width="70" height="70" src="Imagenes_config/btn_facebook.jpg">
</div>
 
 <!-- boton flotante whastapp-->
 <div id="div_btn_whatsapp1" style="display:scroll; position:fixed; bottom:186px; right:-900px; z-index: 1; cursor:pointer;" class="container">
		<a onclick="close_button_whatsapp()"><i class="fas fa-window-close"></i></a>
</div>
<div id="div_btn_whatsapp2" style="display:scroll; position:fixed; bottom:150px; right:-820px; z-index: 1; cursor:pointer;"   onclick="ventana_whatsapp()" class="container">
		<h5 id="btn_whatsapp" >Escribénos!</h5>
</div> 
<div id="div_btn_whatsapp3" style="display:scroll; position:fixed; bottom:80px; right:-840px; z-index: 1; cursor:pointer;"   onclick="ventana_whatsapp()" class="container">
		<img  width="70" height="70" src="Imagenes_config/whatsApp_btn.png">
</div>
	
 <!-- Cards categorias-->
 <div class="container">
 <h4 style="box-shadow: 0 0 25px hsla(0, 0%, 0%, 0.60); color:#FF0000;">Categorias</h4>
 </div>
<div class="container">	
	<div class="row">
	<?php
	for($c=0;$c<count($categorias);$c++){ 
     echo  '<div style="cursor:pointer;"';
		echo 'onclick="mostrar_todo_categoria(';
		echo $c;
		echo ')"';
		echo ' class="col-md-4">';
		echo '<div class="card" >';
		echo	'<h5 style="text-align:center; margin-top:6px; font-weight: bold;" class="card-title">';
		echo 	$categorias[$c];
		echo	'</h5>';
		echo  	'<img  class="img-fluid" style="padding:4px;" src="';
		echo 		$images_categorias[$c]; 
		echo 		'" class="card-img-top">';
		echo '</div>';
	  echo '</div>';
	}
	?>  
	</div>
</div>
 <!--Resumen productos por categorias-->
 
<?php
for($c=0;$c<count($categorias);$c++){
  echo '<br>';
  echo '<div class="container">';
  echo '<h4 style="box-shadow: 0 0 25px hsla(0, 0%, 0%, 0.60); color:#FF0000; font-weight: bold;">';
  echo $categorias[$c];
  echo '</h4>';
  echo '</div>';  
  echo '<div style="cursor:pointer;" class="container">';	
	 echo '<div class="row">';	
	
	for($d=0;$d<count($productos_by_cates_nombres[$categorias[$c]]);$d++){
		
     echo  '<div ';
	 echo 'onclick="cargar_producto(';
	 echo $productos_by_cates_codigos[$categorias[$c]][$d];
	 echo ')"';
	 echo 'class="col-md-4">';
		echo '<div class="card" >';
		echo	'<h5 style="text-align:center; margin-top:6px; font-weight: bold;" class="card-title">';
		echo 	$productos_by_cates_nombres[$categorias[$c]][$d];
		echo	'</h5>';
		echo  	'<img style="padding:4px; max-height: 600px;" src="';
		echo 		"Imagenes_productos/".$productos_by_cates_images[$categorias[$c]][$d]; 
		echo 		'" class="card-img-top">';
		echo 		'<p style="text-align:center; margin-top:2px; font-size:20px;">';
		echo "$ ".number_format($productos_by_cates_precios[$categorias[$c]][$d],0,",",".");
		echo	'</p>';
		echo '</div>';
	  echo '</div>';
	} 
	  
	  
	echo '</div>';
 echo '</div>';	  
}
?> 
<script src="functions.php"></script>
<script>
var ancho=$(window).width();
if(ancho<500){
	document.getElementById("div_carousel").style.width ="300px";
	document.getElementById("div_carousel").style.height ="480px";
}
</script>
</body>
</html>
