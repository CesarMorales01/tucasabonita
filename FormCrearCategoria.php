<html> 
<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>Ingreso de productos</title> 
</head> 
<body style="background-image: url('Imagenes/fondo_blanco.jpg'); background-position: center center;	  
	background-repeat: no-repeat;
	background-attachment: fixed;
    background-size: cover;" >
<body>
<?php
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$get=$mysql->query("select * from categorias") or die ("problemas al consultar");
$images=[];
$nombres=[];
while($getI=$get->fetch_array()){
 $nombres[]=$getI['nombre'];
 $images[]=$getI['imagen'];
}
$reps=count($images);
$cuts=[];
for($i=0;$i<$reps;$i++){
$token = strtok($images[$i], "/");
$aux=$token;
$token = strtok("/");
$cuts[]=$token;
}
?>
<br>  
 <div class="container justify-content-justify">   
        <div class="jumbotron">
        <h3 class="text-center">Crear categoria</h3>
        <form method="post" action="Crear_categoria_web.php" enctype="multipart/form-data"> 
        <br>
        <input type="text" onBlur="verificarNombre(this)" required style="WIDTH: 288px; HEIGHT: 28px" name="categoria" size="26" placeholder="Categoria" id="categoria">
        <br><br>
            <input type="file"  id="file" name="imagen">
            <br><br>
            <span ><img id="img" width="140px" height="150px" src="Imagenes_productos/no_preview.png"> </span>
            <br><br><br>
            <input class="btn btn-primary btn-lg" type="submit" value="Crear"> 
        </form>
        </div>
  </div>
</body>
<script>
window.addEventListener('load', init, false);
function init() {
  var inputFile = document.getElementById('file');
  inputFile.addEventListener('change', mostrarImagen, false);
}

function mostrarImagen(event) {
  var file = event.target.files[0];
  checkNombre(file.name);
  var reader = new FileReader();
  reader.onload = function(event) {
    var img = document.getElementById('img');
    img.src= event.target.result;
  }
  reader.readAsDataURL(file);
}


function checkNombre(name) {
  var nombresImages= <?php echo json_encode($cuts);?>;
  if(nombresImages.indexOf(name)>0){
     alert("Ya existe una imagen con el nombre "+name);
  }
}

function verificarNombre(control) {
  var nombres= <?php echo json_encode($nombres);?>;
  var nombre = document.getElementById('categoria').value;
  for(var i=0; i<nombres.length;i++){
    var ind = nombres[i].localeCompare(nombre);
    if(nombres[i].localeCompare(nombre)==0){
      alert("Ya existe una categoria con el nombre: "+nombre);
    }
  }
}
  
</script> 
</html>   