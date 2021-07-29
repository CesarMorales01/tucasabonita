<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cambiar e-mail</title>
  </head>
  <body>
  <?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
 <!-- div 1 -->
<div class="container">
  <br><br>
  <h2 id="tv_titulo" style="color:black; text-align:center;">Cambiar e-mail</h2>
  <hr> 
<form style="background-color:#f4f4f4; padding:20px;" id="form_cambiar_contra"  action="change_email.php" method="post"> 
<p style="color:red;" id="alert"></p>
 <br>
 <strong style="font-size:18px; margin-left:10px;" >Escribe el nombre de usuario</strong>
<input type="text" name="usuario" required  class="form-control" >
 <br>
<strong style="font-size:18px; margin-left:10px;" >Escribe el email</strong>
<input type="text" name="mail" required id="contraseña" class="form-control" >
 <br>
<strong style="font-size:18px; margin-left:10px;" >Escribe nuevamente el e-mail</strong>
<input type="text" name="contraseña1" required id="contraseña1" class="form-control" >
<br>
	<div style="text-align:center;" class="container">
	<button style="background-color:#f0e094;" id="btn_modificar" class="btn btn-outline-success my-2 my-sm-0" type="submit" >Cambiar e-mail<i style="margin-left:10px;" class="fas fa-edit"></i></button>
	</div>		
</form>
<script src="functions.php"></script>
<script>
function mostrarContrasena(){
var tipo = document.getElementById("contraseña");
var tipo1 = document.getElementById("contraseña1");
      if(tipo.type == "password"){
          tipo.type = "text";
		  tipo1.type = "text";
      }else{
          tipo.type = "password";
		  tipo1.type = "password";
      }
}

document.getElementById("form_cambiar_contra").addEventListener('submit', validar, false);
function validar(event) {
	  event.preventDefault();
	  var tipo = document.getElementById("contraseña").value;
	  var tipo1 = document.getElementById("contraseña1").value;
	  if(tipo==tipo1){
		document.getElementById("form_cambiar_contra").submit();
	  }else{
		document.getElementById("alert").innerText="Los e-mails no coinciden!";
	  }	  
}
</script>
</body>
</html>