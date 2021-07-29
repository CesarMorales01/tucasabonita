<?php
include("my_profile_hipertext.php");	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
  </head>
  <body>
  <?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
 <!-- div 1 -->
<div class="container">
  <br><br>
  <h2 id="tv_titulo" style="color:black; text-align:center;">Mis datos</h2>
  <form  id="formulario_modificar_clientes"  action="Modificar_datos_cliente.php" method="post"> 
  <input type="hidden" name="id" id="id"> 
  <p id="alert_cambio" style="text-align:center; color:brown;"></p>
	 <br>
    <div class="row justify-content-center" >
      <div class="col-lg-4 col-sm-12" >
	  <strong style="font-size:18px;" >Datos personales</strong>
	  <br><br>
       <input type="text" name="nombre"  class="form-control" placeholder="Nombre"  id="nombre" required>  
      </div>
      <div class="col-lg-4 col-sm-12">
	  <br><br>
          <input type="text"  name="apellidos" placeholder="Apellidos" class="form-control"    id="apellidos" required>
      </div>  
    </div>   
	<br><br>
	 <div class="row justify-content-center" >
      <div class="col-lg-4 col-sm-12" >
       <input type="text" name="cedula" class="form-control" placeholder="Número de cédula"  id="input_cedula" required>  
      </div>
	  <br><br><br>
      <div class="col-lg-4 col-sm-12">
          <input type="text" name="telefono" placeholder="Télefono" class="form-control"    id="telefono" required>
      </div>  
    </div>  
	<br><br>
	 <div class="row justify-content-center" >
	 <div class="col-lg-8 col-sm-12">
	 <strong style="font-size:18px;" >Dirección de envio</strong>
	  <br> <br>
	<textarea name="direccion" id="direccion" rows="2" placeholder="Dirección" class="form-control" required></textarea>
	 <br>
	<textarea name="info_direccion" id="info_direccion" rows="2" placeholder="Información adicional: apartamento, local, torre, barrio, localidad, etc." class="form-control" required></textarea>
	</div>
	</div> 
	<br>
	<div class="row justify-content-center" >
      <div class="col-lg-4 col-sm-12" >
       <input type="text" name="ciudad" class="form-control" placeholder="Ciudad"  id="ciudad" required>  
      </div>
	  <br><br>
      <div class="col-lg-4 col-sm-12">
          <input type="text" name="departamento" placeholder="Departamento" class="form-control"    id="departamento" required>
      </div>  
    </div>
	<br><br>
	<div class="row justify-content-center" >
	<div class="col-8">
	<button  id="finalizar_compra" class="btn btn-success btn-lg btn-block" type="submit" >Continuar con la compra<i style="margin-left:10px;"</button>
	</div> 
	</div> 
</form>	
	
</div>   
<script src="functions.php"></script>
<script>
var cedula="<?php echo $_SESSION['cedula'];?>";
var lacking ="<?php echo $lacking;?>";
var vacios=false;
inicializar();
function inicializar(){
	if(cedula!=""){
		document.getElementById("id").value=cedula;
		var nombre = "<?php echo $nombre; ?>";
		document.getElementById("nombre").value=nombre;
		var apellidos = "<?php echo $apellidos; ?>";
		document.getElementById("apellidos").value=apellidos;
		var cedula_bd="<?php echo $cedula_bd; ?>";
		var input_cedula= document.getElementById("input_cedula");
		input_cedula.value=cedula_bd;
		document.getElementById("telefono").value="<?php echo $telefonos; ?>";
		var dir ='<?php echo $dir; ?>';
		document.getElementById("direccion").value=dir;
		document.getElementById("info_direccion").value="<?php echo $info_dir; ?>";
		document.getElementById("ciudad").value="<?php echo $ciudad; ?>";
		document.getElementById("departamento").value="<?php echo $departamento; ?>";
		if(cedula_bd!="" && nombre!="" && apellidos!=""){
			document.getElementById("nombre").setAttribute("readonly"  , true);
			document.getElementById("input_cedula").setAttribute("readonly"  , true);
			document.getElementById("apellidos").setAttribute("readonly"  , true);	
		}
	}
	check_lacking();	
}	

function check_lacking(){
	if(lacking=="true"){
		check_inputs_vacios();
	}else{
		document.getElementById('finalizar_compra').innerText="Modificar";	
	}
}

function check_inputs_vacios(){
	if(document.getElementById('nombre').value==""){
		document.getElementById('nombre').style.borderColor = "brown";
		vacios=true;
	}
	if(document.getElementById('apellidos').value==""){
		document.getElementById('apellidos').style.borderColor = "brown";
		vacios=true;
	}
	if(document.getElementById('input_cedula').value==""){
		document.getElementById('input_cedula').style.borderColor = "brown";
		vacios=true;
	}
	if(document.getElementById('direccion').value==""){
		document.getElementById('direccion').style.borderColor = "brown";
		vacios=true;
	}
	if(document.getElementById('telefono').value==""){
		document.getElementById('telefono').style.borderColor = "brown";
		vacios=true;
	}
	if(document.getElementById('ciudad').value==""){
		document.getElementById('ciudad').style.borderColor = "brown";
		vacios=true;
	}
	if(document.getElementById('departamento').value==""){
		document.getElementById('departamento').style.borderColor = "brown";
		vacios=true;
	}
	if(vacios==true){
		document.getElementById("alert_cambio").innerText="Falta información importante! Necesitamos tus datos personales para diligenciar tu factura.";
	}else{
		document.getElementById("alert_cambio").innerText="";
	}
}	
</script>
</body>
</html>  