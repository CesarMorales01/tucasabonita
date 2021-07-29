<?php
header('Content-type: text/html; charset=utf-8');
include("Searched_hipertext.php");
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css">
	<title>Searched</title>
  </head>
  <body >
<?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
<br>
<!-- div encontrados. -->
<div class="container">	
<h3>Resultados de búsqueda para: <?php echo $word; ?></h3>
<br>
	<div class="row">
	<?php
	for($c=0;$c<count($nombre_producto);$c++){ 
     echo  '<div ';
		echo 'onclick="cargar_producto_searched(';
		echo $c;
		echo ')"';
		echo ' class="col-md-4">';
		echo '<div class="card" >';
		echo	'<h5 style="text-align:center; margin-top:6px; font-weight: bold;" class="card-title">';
		echo 	$nombre_producto[$c];
		echo	'</h5>';
		echo  	'<img  class="img-fluid" style="padding:4px;" src="';
		echo 		"Imagenes_productos/".$imagen_producto[$c]; 
		echo 		'" class="card-img-top">';
		echo 		'<p style="text-align:center; margin-top:2px; font-size:20px;">';
		echo "$ ".number_format($precio_producto[$c],0,",",".");
		echo	'</p>';
		echo '</div>';
	  echo '</div>';
	}
	?>  
	</div>
</div>

<script src="functions.php"></script>
<script>
window.addEventListener('load', inicializar_eventos, false);
var cods_productos;
var url="<?php echo $url1;?>";
function inicializar_eventos(){
 cods_productos= <?php echo json_encode($codigos_producto);?>;	
}
	
function cargar_producto_searched(cod){
	var c= cods_productos[cod];
	var url1 = url+"Productos.php?producto="+encodeURIComponent(window.btoa(c));
    location.href =url1;
}
</script>
</body>
</html>