<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cambiar contraseña</title>
  </head>
  <body>
  <?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
 <!-- div 1 -->
<div class="container">

  <br><br>
  <h2 id="tv_titulo" style="color:black; text-align:center;">Cambiar contraseña</h2>
  <hr> 

<form style="background-color:#f4f4f4; padding:20px;" id="form_cambiar_contra"  action="change_password.php" method="post"> 
<p style="color:red;" id="alert"></p>
			<div class="row justify-content-start" >
			<strong style="font-size:18px; margin-left:15px;" >Escribe la contraseña</strong>
			  <div class="col-10" >
				
				<input type="password" name="contraseña" required id="contraseña" class="form-control" >   
			  </div>
			  <div class="col-2" >
				<button type="button" onclick="mostrarContrasena()" style="background-color:#228b22;"><i class="fas fa-eye"></i></button> 
			  </div>  
			</div>
			<br>
			
			<div class="row justify-content-start" >
			<strong style="font-size:18px; margin-left:15px;" >Escribe nuevamente la contraseña</strong>
			  <div class="col-10" >
				
				<input type="password" name="contraseña1" required id="contraseña1" class="form-control" >   
			  </div>
			  <div class="col-2" >
				<button type="button" onclick="mostrarContrasena()" style="background-color:#228b22;"><i class="fas fa-eye"></i></button> 
			  </div>  
			</div> 
				<br>
			<div style="text-align:center;" class="container">
			<button style="background-color:#f0e094;" id="btn_modificar" class="btn btn-outline-success my-2 my-sm-0" type="submit" >Cambiar contraseña<i style="margin-left:10px;" class="fas fa-edit"></i></button>
			</div>
			<br>
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
		document.getElementById("alert").innerText="Las contraseñas no coinciden!";
	  }	  
}
</script>
</body>
</html>