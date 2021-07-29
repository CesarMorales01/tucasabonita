<html> 
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css" ">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!-- Este boostrap es necesario para cargar la barra de acciones -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
   <!-- Necesarios para autocomplete -->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<title>Crear promocion</title> 
</head> 
<body style="background-image: url('ImagenesCategorias/fondo_blanco.jpg'); background-position: center center;	  
	background-repeat: no-repeat;
	background-attachment: fixed;
    background-size: cover;">
<?php
include("datos.php");
if(isset($_REQUEST['id'])){
    $id= $_REQUEST['id'];
    $conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
    $get=$mysql->query("select * from promociones_mercaya where id=$id") or die ("problemas al consultar");
    if($datos=$get->fetch_array()){
     $detalle=$datos['descripcion'];
     $imagen=$datos['imagen'];
     $producto=$datos['ref_producto'];
     $credito=$datos['pago_credito'];
     $categoria=$datos['categoria'];
    }
    mysqli_close($conexion);
}
$get_id_productos=$mysql->query("select * from productos") or die ("problemas al consultar id productos");
$get_id_categorias=$mysql->query("select * from categorias") or die ("problemas al consultar id categorias");
?>
<br>  
<div class="container">
  <div class="row">
    <div class="mx-auto">
        <h3 id="titulo" class="text-center">Crear promocion</h3>
        <form method="post" action="Crear_promo_web.php" enctype="multipart/form-data" id="Form_crear_promo"> 
        Id (Modificar solo para iniciar promo Firebase. No poner id al crear porque se va a eliminar.):
        <br>
        <input type="text" name="modifId" value="<?php echo $id;?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <br><br>
        <textarea id="descripcion" name="descripcion" rows="3" cols="50"  placeholder="Descripcion"><?php echo $detalle;?></textarea>  
        <br><br>
            <label><strong>Imagen</strong></label>
            <br>
            <input data-toggle="tooltip" title="Ingresa imagenes con fondo blanco, aprox 500x500 mp." type="file"  id="file" name="imagen">
            <br><br>
			<input type="text" id="labelImage" name="labelImage" class="form-control input-lg" value="<?php echo $imagen;?>">
            <br>
            <span ><img id="img" width="140px" height="150px" src="Imagenes_productos/no_preview.png"> </span>
            <br><br>
            Asignar producto:
            <br>
			<input style="width:300px;" type="search" id="input_autocomplete" placeholder="Buscar productos..." aria-label="Search">
           <br><br>
		   <select name="producto" id="producto" onChange="cambiarCredito()">
           <option value="no">No asignar</option>
           <?php
		   $productos=[];
		   $productos_id=[];
		   $productos_valor=[];
		   $productos_imagen=[];
		   $productos_cate=[];
		   $productos_credito=[];
            while($id_productos=$get_id_productos->fetch_array()){
			  $productos[]= $id_productos['nombre'];
			  $productos_id[]= $id_productos['id'];
			  $productos_valor[]= $id_productos['valor'];
			  $tok = strtok($id_productos['imagen'], "||");
			  $productos_imagen[]="Imagenes_productos/".$tok;
			  $productos_cate[]= $id_productos['categoria'];	
			  $productos_credito[]= $id_productos['text_credito'];	
			  
              echo '<option value="';
              echo $id_productos['id'];
              echo '"';
              if($producto==$id_productos['id']){
                echo "selected";
              }
              echo'>';
              echo $id_productos['nombre'];
              echo '</option>';
              } 
            ?>
            </select>
            <br><br>
            Credito:
            <br>
            <textarea id="credito" name="credito" rows="2" cols="50" ><?php echo $credito;?></textarea>  
            <br>  <br>
            Asignar categoria:
            <br>
           <select id="categoria" name="categoria">
           <option value="no">No asignar</option>
           <?php
            while($id_categorias=$get_id_categorias->fetch_array()){
              echo '<option value="';
              echo $id_categorias['nombre'];
              echo '"';
              if($categoria==$id_categorias['nombre']){
                echo "selected";
              }
              echo'>';
              echo $id_categorias['nombre'];
              echo '</option>';
              } 
            ?>
            </select>
            <br>  <br>
            <input id="btn_submit" class="btn btn-primary btn-lg" type="submit" value="Ingresar">
        </form>
    </div>
 </div>
</div>
<script src="functions_my_system.php"></script> 
<script>
window.addEventListener('load', init, false);
var vector_productos=[];
var vector_productos_id=[];
var vector_productos_imagen=[];
var vector_productos_valor=[];
var vector_productos_categoria=[];
var vector_productos_credito=[];
function init() {
   var inputFile = document.getElementById('file');
   inputFile.addEventListener('change', mostrarImagen, false);
   checkId();
   get_json_productos= <?php echo json_encode($productos);?>;
   get_json_productos_id= <?php echo json_encode($productos_id);?>;
   get_json_productos_imagen= <?php echo json_encode($productos_imagen);?>;
   get_json_productos_valor= <?php echo json_encode($productos_valor);?>;
   get_json_productos_categoria= <?php echo json_encode($productos_cate);?>;
   get_json_productos_credito= <?php echo json_encode($productos_credito);?>;
	  for(var i=0;i<get_json_productos.length;i++){
		 vector_productos[i]=get_json_productos[i];
		 vector_productos_id[i]=get_json_productos_id[i];
		 vector_productos_imagen[i]=get_json_productos_imagen[i];
		 vector_productos_valor[i]=get_json_productos_valor[i];
		 vector_productos_categoria[i]=get_json_productos_categoria[i];
		 vector_productos_credito[i]=get_json_productos_credito[i];
	  }
  document.getElementById('input_autocomplete').addEventListener('keydown', showup_button, false);
}

$(function(){
    $( "#input_autocomplete" ).autocomplete({
      source: vector_productos
    });
});


$("#input_autocomplete" ).on( "autocompleteselect", function( event, ui ) {
	var ind=vector_productos.indexOf(ui.item.value);
	document.getElementById('descripcion').innerText=vector_productos[ind]+". $ "+vector_productos_valor[ind];
	document.getElementById('credito').innerText=vector_productos_credito[ind];
	document.getElementById("categoria").value = vector_productos_categoria[ind];
	document.getElementById("producto").value=vector_productos_id[ind];
		var img = document.getElementById('img');
        img.src= vector_productos_imagen[ind];
        var labelImage = document.getElementById('labelImage');
        labelImage.value=vector_productos_imagen[ind];
});

var conexion1;
function cambiarCredito(){
  conexion1=new XMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','consultar_producto_json.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(retornarDatos());  
}

function retornarDatos(){
  var cadena='';
  var producto = document.getElementById('producto').value;
	cadena='id='+encodeURIComponent(producto); 
  return cadena;
}

function procesarEventos(){
  var control_credito = document.getElementById("credito");
  if(conexion1.readyState == 4){  
    var datos=JSON.parse(conexion1.responseText);
    control_credito.value = datos.text_credito; 
  }  
}

function validarFile(evt) {
   var  descripcion = document.getElementById('descripcion').value;
   if(descripcion==""){
     alert("Ingresa una descripcion!");
     evt.preventDefault();
   }else{
      var labelImage = document.getElementById('labelImage').innerHTML;
      if(labelImage==""){
        var ifFile = document.getElementById('file').files.length;
        if(ifFile==0){
          alert("Debes adjuntar una imagen!");
          evt.preventDefault();
        }
      }
   } 
}

function checkId() {
    var id = "<?php echo $id;?>";
    if(id!=""){
       var img = document.getElementById('img');
        img.src= "<?php echo $imagen;?>";
        var labelImage = document.getElementById('labelImage');
        labelImage.innerHTML="<?php echo $imagen;?>";
        var titulo = document.getElementById('titulo');
        titulo.innerHTML="Modificar promocion";
        var Form_crear_promo = document.getElementById('Form_crear_promo');
        Form_crear_promo.setAttribute('action', 'Modificar_promo.php'); 
        var btn_submit = document.getElementById('btn_submit');
        btn_submit.value="Modificar";
 
    }
    
}

function mostrarImagen(event) {
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function(event) {
    var img = document.getElementById('img');
    img.src= event.target.result;
     }
  reader.readAsDataURL(file);
  var labelImage = document.getElementById('labelImage');
  labelImage.innerHTML="";
}

</script>
</body> 
</html>      