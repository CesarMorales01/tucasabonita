<?php
 include("my_profile_hipertext.php");	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My profile</title>
  </head>
  <body>
  <?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
if(isset($_REQUEST['message'])){
	$repeated=$_REQUEST['message'];
}
?>
<div class="container">
  <br><br>
  <h2 id="tv_titulo" style="color:black; text-align:center;">Registrarse</h2>
  <hr> 
<div class="row">
  <br> 
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
    <form  id="formulario_ingreso_clientes"  action="Registrar_cliente_casa_bonita_web.php" method="post"> 
           <p style="text-align:justify; color:black;">Nombre de usuario</p>
          <input type="text" name="nombre"  class="form-control"   id="nombre" required> 
		  <br>
			<p style="text-align:justify; color:black;">Correo electrónico</p>
            <input type="text"  name="mail" required id="mail"  class="form-control" > 
            <br>
			<p style="text-align:justify; color:black;">Repite el correo electrónico</p>
            <input type="text"  name="mail2" id="mail2" required  class="form-control"> 
            <br>
			<p style="text-align:justify; color:black;">Contraseña</p>
            <input type="password"  name="contraseña" required id="contraseña"  class="form-control" > 
            <br>
			<p style="text-align:justify; color:black;">Repite la contraseña</p>
            <input type="password"  name="contraseña2" required id="contraseña2"  class="form-control" > 
            <br>
			<p id="alert_same_email" style="text-align:justify; color:red;"></p>
			<div style="text-align:center;" class="container">
			<button id="btn_modificar" class="btn btn-outline-success my-2 my-sm-0" type="submit" >Registrarse</button>
	</form>	
			 </div>
			<br>
   </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
		<br>  
		<img width="300" height="300" src="Imagenes_config/la_humildad.png" style="margin:auto; display:block;" alt="Placeholder image">
	  </div>
      <br> 
</div>
</div> 
<script src="functions.php"></script>
<script>
var repeat="<?php echo $repeated; ?>";
if(repeat=="repeated_mail"){
	document.getElementById("alert_same_email").innerText="Ya existe una cuenta asociada a este e-mail!";
}
document.getElementById("formulario_ingreso_clientes").addEventListener('submit', validar, false);
function validar(event) {
	event.preventDefault();
	var check=verificarEntrada();
	if(check){
		document.getElementById("formulario_ingreso_clientes").submit();
	}
}

function verificarEntrada(){
	var check=false;
	var check_contra=document.getElementById("contraseña").value;
	var check_contra1=document.getElementById("contraseña2").value;
	var check_mail=document.getElementById("mail").value;
	var check_mail1=document.getElementById("mail2").value;
	if(check_mail==check_mail1){
		if(check_contra==check_contra1){
			check=true;
			document.getElementById("alert_same_email").innerText="";
		}else{
			document.getElementById("alert_same_email").innerText="Las contraseñas no coinciden!";
		}
	}else{
		document.getElementById("alert_same_email").innerText="Los e-mails no coinciden!";
	}
	return check;
}
  </script>
</body>
</html>