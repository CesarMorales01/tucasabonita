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
$get=$mysql->query("select nombre from categorias") or die ("problemas al consultar");
$getImages=$mysql->query("select nombre, imagen from productos") or die ("problemas al consultar imagenes");
$images=[];
$nombres=[];
while($getI=$getImages->fetch_array()){
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
if(isset($_REQUEST['id'])){
 $id=$_REQUEST['id'];
 $getProduct=$mysql->query("select * from productos where id=$id") or die ("problemas al consultar producto");
 if($getP=$getProduct->fetch_array()){
   $ref=$getP['referencia'];
   $categoria=$getP['categoria'];
   $nombre=$getP['nombre'];
   $descripcion=$getP['descripcion'];
   $valor=$getP['valor'];
   $n_cuotas=$getP['n_cuotas'];
   $valor_cuotas=$getP['valor_cuotas'];
   $text_credito=$getP['text_credito'];
   $imagen=$getP['imagen'];
 }
$token = strtok($imagen, "||");
$dir="Imagenes_productos/";
$show_image=$dir.$token;
}
$mysql->close();
?>
 <div class="container justify-content-justify">   
        <div class="jumbotron">
        <h3 id="titulo" class="text-center">Ingresar producto</h3>
        <form method="post" action="Ingresar_producto_web.php" enctype="multipart/form-data" id="Form_ingresar_producto"> 
        <br>
        <div class="row justify-content-around">
            <div class="col-3">
        <input type="hidden" name="id" value="<?php echo $id;?>">      
        <input type="text"  style="WIDTH: 288px; HEIGHT: 28px" name="referencia" size="26" placeholder="Referencia" id="referencia" value="<?php echo $ref;?>"> 
        <br><br>
        Categoria:
        <br>
        <select name="categoria">
        <?php
        while($getCate=$get->fetch_array()){
          echo '<option value="';
          echo $getCate['nombre'];
          echo '"';
          if($categoria==$getCate['nombre']){
            echo "selected";
          }
          echo'>';
          echo $getCate['nombre'];
          echo '</option>';
          }
        ?> 
        </select>
        <br> <br>  
        <textarea onBlur="verificarNombreProducto(this)" required style="WIDTH: 288px;" rows="2" name="nombre" size="26" placeholder="Nombre" id="nombre"><?php echo $nombre;?></textarea>  
        <br> <br> 
        <textarea required style="WIDTH: 288px;" rows="4" name="descripcion" size="26" placeholder="Descripcion" id="descripcion" ><?php echo $descripcion;?></textarea> 
		<br><br>
        <input type="text" onchange="set_precio()" style="WIDTH: 288px; HEIGHT: 28px" name="costo" size="26" placeholder="Costo producto" id="costo"> 
        <br><br>
        <input type="text" required style="WIDTH: 288px; HEIGHT: 28px" name="precio" size="26" placeholder="Precio" id="precio" value="<?php echo $valor;?>"> 
        <br><br>
        <input type="text" style="WIDTH: 80px; HEIGHT: 28px" name="n_cuotas" size="26" placeholder="N° cuotas" id="n_cuotas" value="<?php echo $n_cuotas;?>">
        <input type="text" style="WIDTH: 120px; HEIGHT: 28px" name="valor_cuotas" size="26" placeholder="Valor cuotas" id="valor_cuotas" value="<?php echo $valor_cuotas;?>">
        <textarea style="WIDTH: 288px;" rows="2" name="text_credito" size="26" placeholder="Credito" id="texto_credito" ><?php echo $text_credito;?></textarea>
            </div>
            <div class="col-3" >
            <input data-toggle="tooltip" title="Ingresa imagenes con fondo blanco, aprox 500x500 mp." type="file"  id="file" name="imagen">
            <textarea  style="WIDTH: 288px;" rows="3" name="imageDir" placeholder="Imagenes...." id="labelImage"><?php echo $imagen;?></textarea> 
            <br><br>
            <span ><img id="img" width="140px" height="150px" src="Imagenes_productos/no_preview.png"> </span>
            <br>
            <a href="https://tucasabonita.site/FormMasImagenes.php?id=<?php echo $id;?>">Subir mas imagenes</a>
            <br><br>
            <input id="btn_submit" class="btn btn-primary btn-lg" type="submit" value="Ingresar">
            </div>
        </div> 
        </form>
        </div>
  </div>
</body>
<script src="functions_my_system.php"></script> 
<script>
window.addEventListener('load', init, false);
function init() {
  var inputFile = document.getElementById('file');
  inputFile.addEventListener('change', mostrarImagen, false);
  document.getElementById('precio').addEventListener('change', calcular_credito, false);
  document.getElementById('precio').onblur=calcular_credito;
  document.getElementById('n_cuotas').addEventListener('change', calcular_credito, false);
  document.getElementById("Form_ingresar_producto").addEventListener('submit', validar, false);
  revisarId()
}

function set_precio(){
	var costo = document.getElementById('costo').value;
	var precio=(costo*0.2)+parseInt(costo);
	document.getElementById('precio').value=precio;
}

function calcular_credito() {
  var valor =document.getElementById('precio').value;
  ///    NUMERO DE CUOTAS    ///
  var input_n_cuotas = document.getElementById('n_cuotas').value;
  if(input_n_cuotas==""){
    document.getElementById('n_cuotas').value="4";
  }
  var n_cuotas = document.getElementById('n_cuotas').value;
  var meses = parseInt(n_cuotas)/2;
  var excedente=valor*0.1*meses;
  var int_total=parseInt(valor)+parseInt(excedente);
  var int_cuota=Math.round(int_total/parseInt(n_cuotas));
  document.getElementById('valor_cuotas').value=int_cuota;
  var format_num= new Intl.NumberFormat("de-DE").format(int_cuota);
  document.getElementById('texto_credito').value="Credito: "+n_cuotas+" cuotas quincenales de $"+format_num+" pesos.";
}

function validar(evt) {
  var nom=document.getElementById('precio').value;
     var patron=/^[0-9]+$/;
    if (patron.test(nom)) {
    } else { 
      alert('El campo precio solo puede guardar numeros!');
		  evt.preventDefault();
		}  
}

function revisarId() {
  var id = "<?php echo $id;?>";
  if(id!=""){
    var btn_submit = document.getElementById('btn_submit');
    btn_submit.value="Modificar";
    var img = document.getElementById('img');
    img.src= "<?php echo $show_image;?>";
    var nombre = document.getElementById('nombre');
    nombre.value="<?php echo $nombre;?>";
    nombre.removeAttribute("onBlur");
    var titulo = document.getElementById('titulo');
    titulo.innerHTML="Modificar producto";
    var Form_ingresar_producto = document.getElementById('Form_ingresar_producto');
    Form_ingresar_producto.setAttribute('action', 'Modificar_producto.php');
  } 
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
  var labelImage = document.getElementById('labelImage');
  labelImage.innerHTML="";
}

function checkNombre(name) {
  var nombresImages= <?php echo json_encode($cuts);?>;
  if(nombresImages.indexOf(name)>0){
     alert("Ya existe una imagen con el nombre "+name);
  }
}

function verificarNombreProducto(control) {
  var nombres= <?php echo json_encode($nombres);?>;
  var nombre = document.getElementById('nombre').value;
  for(var i=0; i<nombres.length;i++){
    var ind = nombres[i].localeCompare(nombre);
    if(nombres[i].localeCompare(nombre)==0){
      alert("Ya existe un producto con el nombre: "+nombre);
    }
  }
} 
</script> 
</html>        