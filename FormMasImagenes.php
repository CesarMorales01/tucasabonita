<html> 
<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>Ingreso de productos</title> 
</head> 
<body style="background-image: url('Imagenes/fondo_blanco.jpg'); background-position: center center;	  
	background-repeat: no-repeat;
	background-attachment: fixed;
    background-size: cover;">
<body>
<?php
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
 $id=$_REQUEST['id'];
 $getProduct=$mysql->query("select * from productos where id=$id") or die ("problemas al consultar producto");
 if($getP=$getProduct->fetch_array()){
   $ref=$getP['referencia'];
   $categoria=$getP['categoria'];
   $nombre=$getP['nombre'];
   $descripcion=$getP['descripcion'];
   $valor=$getP['valor'];
   $imagen=$getP['imagen'];
}
$token = strtok($imagen, "||");
$imagenes=[];
while ($token !== false){
$imagenes[]= $token;
$token = strtok("||");
}

$mysql->close();
?>
<br>  
        <h3 id="titulo" class="text-center">Ingresar imagenes</h3>
        <br>
        <div class="container">
        <form action="ListaProductos.php">
        <button style="margin-top:10px;" type="submit" class="btn btn-primary">Ir a productos</button>
        </form>
        </div>
        <div class="container">
        <form method="post" action="Ingresar_mas_imagenes_web.php" enctype="multipart/form-data" id="Form_ingresar_imagenes"> 
        <br>
       <input type="hidden" name="id" value="<?php echo $id;?>">
       <input type="hidden" name="array" value="<?php echo $imagen;?>">  
            <label id="labelImage">Producto:</label>  
            <br> 
            <input type="text" required style="WIDTH: 288px; HEIGHT: 28px" name="descripcion" size="26" placeholder="Descripcion" id="descripcion" value="<?php echo $descripcion;?>"> 
            <br><br>
           
            <input data-toggle="tooltip" title="Ingresa imagenes con fondo blanco, aprox 500x500 mp." type="file"  id="file"  name="imagen">
            <label id="labelImage"></label>
            <span ><img id="img" width="140px" height="150px" src="Imagenes_productos/no_preview.png"> </span>
            <br><br>
            
            <div class="container">   
                <div class="card-columns mt-3">
                <?php
                $num=count($imagenes);
                for($i=0;$i<$num;$i++){    
                    echo '<div class="card text-center border-info">';
                        echo  '<div class="card-body">';
                        $imagen=$imagenes[$i];
                        $ruta="Imagenes_productos/";
                        $rutaCompleta=$ruta.$imagen;
                        echo  '<img class="img-fluid" src="';
                        echo $rutaCompleta;
                        echo '">';   
                        echo  '</div>';
                    echo '</div>';          
                }     
                ?>        
                </div>
            </div>
            <a onClick="regresar()" href="#">Regresar</a>
            <br><br>
            <input id="btn_submit" class="btn btn-primary btn-lg" type="submit" value="Ingresar imagen">

        </form>
    </div>
</body>
<script>
window.addEventListener('load', init, false);
var id;
function init() {
  var inputFile = document.getElementById('file');
  inputFile.addEventListener('change', mostrarImagen, false);
  id="<?php echo $id;?>";
}

function regresar(){
    var ref = "http://tucasabonita.site/FormIngresarProductos.php?id="+id;
    window.location.href = ref;
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
</html>        