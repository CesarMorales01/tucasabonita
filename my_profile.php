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
?>
<!-- div 1 -->
<div class="container">

  <br><br>
  <h2 id="tv_titulo" style="color:black; text-align:center;">Mis datos</h2>
  <hr> 
  <form  id="formulario_modificar_clientes"  action="Modificar_datos_clientes_casa_bonita_web.php" method="post"> 

    <div id="div_datos_personales" onmouseover="activar_inputs_datos_personales()" onmouseout="desactivar_inputs_datos_personales()" style="background-color:#f4f4f4; padding:3px;">
		 <div class="row justify-content-center" >
		  <p id="alert_cambio" style="text-align:justify; color:brown;"></p>		  
			 <div class="col-lg-4 col-sm-12" > 
			 <strong style="font-size:18px;" >Datos personales</strong>
		    <br>		 
			   <p style="text-align:justify; color:black;">Nombres</p>
			   <input type="hidden" name="id" id="id"> 
				<input type="text" name="nombre"  class="form-control"  id="nombre" required>
				<br>				
			 </div> 
			 
			 <div class="col-lg-4 col-sm-12" >
			 <br>
				 <p style="text-align:justify; color:black;">Apellidos</p>
				<input type="text" name="apellidos"  class="form-control"    id="apellidos" required> 
				<br>
			 </div> 
		 </div>  
		 <div class="row justify-content-center" >	
			<div class="col-lg-4 col-sm-12" >
				<p style="text-align:center; color:black;">Número de cédula</p>
			</div> 
			 <div class="col-lg-4 col-sm-12" > 
				<input type="text"  name="cedula" placeholder="Número de cédula" class="form-control"    id="input_cedula" required>
			</div> 
		 </div> 
		 <br>
		    <div class="row justify-content-center">
				<div class="col-lg-6 col-sm-6" >
				<button style="background-color:#f0e094;" id="btn_modificar_datos_personales" onclick="abrir_dialogo_check_contra('')" class="btn btn-outline-success btn-md btn-block" type="button" >Modificar<i style="margin-left:10px;" class="fas fa-edit"></i></button>
				<br>
				</div>
			</div>	

	</div>  
	<br>
	
	<div style="background-color:#f4f4f4; padding:3px;">
		<div class="row justify-content-center" >
			<div class="col-lg-8 col-sm-12">
			 <strong style="font-size:18px;" >Dirección de envio</strong>
			<textarea name="direccion" id="direccion" readonly rows="2" class="form-control" required ></textarea>
			<br>
			</div>
			<div class="col-lg-8 col-sm-12">
			<textarea name="info_direccion" readonly id="info_direccion" rows="2" placeholder="Información adicional: apartamento, local, torre, etc. (Opcional)" class="form-control" required></textarea>
			<br>
			</div>
		</div>
		
		<div class="row justify-content-center" >
		  <div class="col-lg-4 col-sm-12" >
		   <input type="text" name="ciudad"readonly  class="form-control" placeholder="Ciudad"  id="ciudad" required>  
		  </div>
		  <br><br>
		  <div class="col-lg-4 col-sm-12">
			  <input type="text" name="departamento" readonly placeholder="Departamento" class="form-control"    id="departamento" required>
			  <br>
		  </div>  
		</div>
		 <div class="row justify-content-center" >	
				<div class="col-lg-4 col-sm-12" >
					<p style="text-align:center; color:black;">Télefonos</p>
				</div> 
				 <div class="col-lg-4 col-sm-12" > 
					<input type="text" readonly name="telefono" id="telefono" readonly class="form-control" required >
					<br>
				</div> 
		</div> 
		<div class="row justify-content-center">
					<div class="col-lg-6 col-sm-6" >
					<button style="background-color:#f0e094;" id="btn_modificar_direccion" onclick="abrir_dialogo_check_contra('dir')" class="btn btn-outline-success btn-md btn-block" type="button" >Modificar<i style="margin-left:10px;" class="fas fa-edit"></i></button>
					<br>
					</div>
		</div>			
	</div>
	<br>
	
	<div style="background-color:#f4f4f4; padding:3px;">
	<div class="row justify-content-center">
				<div class="col-lg-8 col-sm-12" >
						<strong style="font-size:18px;" >Datos de cuenta</strong>
						<div style="background-color:#f4f4f4; padding:3px;">
						<p style="text-align:justify; color:black;">Nombre de usuario</p>
						<input type="text" name="usuario" readonly class="form-control"    id="usuario" required> 
						<br>
						<p style="text-align:justify; color:black;">E-mail</p>
						<input type="text" onBlur="verificarEntrada()" name="mail" required id="mail" readonly class="form-control" > 
						<br>
						<div class="row justify-content-center">
							<div class="col-lg-6 col-sm-6" >
							<button style="background-color:#f0e094;" id="btn_modificar" onclick="abrir_dialogo_check_contra('datos_cuenta')" class="btn btn-outline-success btn-md btn-block" type="button" >Modificar<i style="margin-left:10px;" class="fas fa-edit"></i></button>
							</div>
						</div>
						<br>
						</div>
						
						<br>
						<strong style="font-size:18px;" >Contraseña</strong>
						<div style="background-color:#f4f4f4; padding:3px;">
						<input type="password" name="contraseña" required id="contraseña" readonly class="form-control" >  
						<br>
						<div class="row justify-content-center">
							<div class="col-lg-6 col-sm-6" >
							<button style="background-color:#f0e094;" id="btn_modificar" onclick="abrir_dialogo_check_contra('cambiar_contra')" class="btn btn-outline-success btn-md btn-block" type="button" >Cambiar contraseña<i style="margin-left:10px;" class="fas fa-edit"></i></button>
							 <br>
							</div>
						</div>	
						<br>
						</div>
				</div>
	</div> 
	</div> 
		  
</div>
<!--- dialogo confirmar contraseña -->
<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px; cursor:pointer;" data-toggle="modal" id="dialogo_confirmar_password" data-target="#dialogo1"></a>
			  <!-- INICIO DIALOGO NUEVO REGISTRO --> 
					<div class="modal fade" id="dialogo1">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <!-- cuerpo del diálogo -->
							  <div class="modal-body">
								<span id="alert_check_contra" style="color:black;" >Para modificar tus datos debes ingresar tu contraseña.</span>
								<br><br>
								<input type="password" id="check_contraseña" class="form-control" > 
							  </div>
						  <!-- pie del diálogo -->
						<div class="row justify-content-around">
						  <div class="col-3"> 
							<button type="button" onclick="limpiar_alert_contra()" style="background-color:#d22c21;" data-dismiss="modal">Cancelar</button>
						  </div>
						  <div class="col-3">
							<input type="hidden" id="hidden_dialogo_eliminar"> 
							<button type="button" onclick="continuar_modificar_datos()" style="background-color:#228b22;">Continuar</button>
						  </div>
						</div> 
						<br>	<br>	
						</div>
					  </div>
					</div>
 <!-- FIN DIALOGO -->
 
<script src="functions.php"></script>
<script>
inicializar_eventos();
var cedula, password, cedula_bd, apellidos, nombre;
var check_contra, check_contra1, check_mail, check_mail1;
var datos_cuenta, cambiar_contra=false, cambiar_dir=false, vacios=false; inputs_over_datos;
var url ="<?php echo $url;?>";
function inicializar_eventos(){
	cedula="<?php echo $_SESSION['cedula'];?>";
	if(cedula!=""){
		document.getElementById("id").value=cedula;
		cedula_bd="<?php echo $cedula_bd; ?>";
		var input_cedula= document.getElementById("input_cedula");
		input_cedula.value=cedula_bd;
		nombre = "<?php echo $nombre; ?>";
		document.getElementById("nombre").value=nombre;
		apellidos = "<?php echo $apellidos; ?>";
		document.getElementById("apellidos").value=apellidos;
		var usuario = "<?php echo $usuario; ?>";
		document.getElementById("usuario").value=usuario;
		// por algun motivo al haber saltos de linea en un string genera error aca en javascript
		var dir ='<?php echo $dir; ?>';
		document.getElementById("direccion").value=dir;
		document.getElementById("telefono").value="<?php echo $telefonos; ?>";
		document.getElementById("info_direccion").value="<?php echo $info_dir; ?>";
		document.getElementById("ciudad").value="<?php echo $ciudad; ?>";
		document.getElementById("departamento").value="<?php echo $departamento; ?>";
		document.getElementById("mail").value="<?php echo $correo; ?>";
		password="<?php echo $clave; ?>";
		document.getElementById("contraseña").value="<?php echo $clave; ?>";
		check_cedula();	
	}
}

function check_cedula(){
	if(cedula_bd!="" && nombre!="" && apellidos!=""){
		document.getElementById("apellidos").setAttribute("readonly"  , false);
		document.getElementById("input_cedula").setAttribute("readonly"  , false);
		document.getElementById("nombre").setAttribute("readonly"  , false);
		document.getElementById("btn_modificar_datos_personales").onclick = ventana_whatsapp;
		document.getElementById("btn_modificar_datos_personales").innerHTML="Escribir a asesor!";
		inputs_over_datos=true;			
	}else{
				
	}		
}

function ventana_whatsapp(){
	var tel="<?php echo $tel_whatsapp;?>";
	 href="https://api.whatsapp.com/send?phone=057"+tel+"&text=Cordial saludo. Escribo para realizar un cambio en mis datos personales.";
	 window.open(href, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=600");
} 

function abrir_dialogo_check_contra(origen){
	if(origen=="datos_cuenta"){datos_cuenta=true;}else{datos_cuenta=false;}
	if(origen=="cambiar_contra"){cambiar_contra=true;}else{cambiar_contra=false;}
	if(origen=="dir"){cambiar_dir=true;}else{cambiar_dir=false;}
	document.getElementById("dialogo_confirmar_password").click();
}

function limpiar_alert_contra(){
	document.getElementById("alert_check_contra").style.color="black";
	document.getElementById("alert_check_contra").innerText="Para modificar tus datos debes ingresar tu contraseña.";
	document.getElementById("check_contraseña").value="";
}

function continuar_modificar_datos(){
	var contra = document.getElementById("check_contraseña").value;
	if(contra==password){
		if(datos_cuenta){
			var url1=url+"Form_change_email.php"
			window.location=url1;
		}else{
			if(cambiar_contra){
				var url1=url+"Form_change_password.php"
				window.location=url1;
			}else{
				if(cambiar_dir){
					var url1=url+"Registrarse_1.php"
					window.location=url1;
				}else{
					document.getElementById("formulario_modificar_clientes").submit();
				}
			}
		}
		
	}else{
		document.getElementById("alert_check_contra").style.color="red";
		document.getElementById("alert_check_contra").innerText="Contraseña incorrecta!";
	}
}

function desactivar_inputs_datos_personales(){
	document.getElementById("alert_cambio").innerText="";
}

function activar_inputs_datos_personales(){
		if(inputs_over_datos){
			var ape= document.getElementById("apellidos").value;
			var name= document.getElementById("nombre").value;
			if(cedula_bd!="" && ape!="" && name != ""){
				document.getElementById("alert_cambio").innerText="Tu nombre y número de cédula se consideran datos de especial relevancia. Si deseas modificarlos puedes comunicarte con un asesor.";
			}
		}	
}
</script>
</body>
</html>