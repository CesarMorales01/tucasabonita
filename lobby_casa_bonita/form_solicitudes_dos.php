<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulario inteligente para solicitudes</title>
    <!-- Bootstrap -->
	<!-- <link href="css/bootstrap.css" rel="stylesheet"> -->
	<link href="css/bootstrap-3.3.7.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/estilos_contactos.css?v=<?php echo time(); ?>" /> 


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
  </head>
  <body style="background-image: url('Imagenes/fondo_blanco.jpg'); background-position: center center;	  
	background-repeat: no-repeat;
	background-attachment: fixed;
    background-size: cover;" >
  <div class="container">
  <br>
  <img height="120" style="margin:auto; display:block;" src="Imagenes/Logo_eslogan.jpg">    
  <br>
  <h2 style="color:black;">Solicitud de credito N° 2.</h2>
  <hr> 
  <form method="post" action="ingresar_solicitud_clientes_dos_web.php">
  <div class="row">
  <p style="text-align:left;">Agradecemos actualices tu información. La usaremos para contactanos contigo.</p>
  <br> 
  <p style="text-align:left; color:red;">*Obligatorio</p> 
  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <p id="ingresaCedula" style="text-align:justify; color:black;">Ingresa tu número de cédula.<strong style="color:red;">*</strong></p>
            <input type="number" onfocusout="buscar_datos()" name="cedula" class="form-control" placeholder="Número de cedula" id="cedula" required> 
            <br> 
            <p<strong style="color:red;">*</strong></p> 
          <input type="text" name="nombre" class="form-control"   placeholder="Nombre" id="nombre" required> 
            <br>
            <p<strong style="color:red;">*</strong></p>
            <textarea name="direccion" id="direccion" rows="2" class="form-control" required placeholder="Direccion domicilio"></textarea> 
            <br>
            <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono fijo"> 
            <br>
            <p<strong style="color:red;">*</strong></p>
            <input type="text" name="celular" id="celular" class="form-control" required placeholder="Telefono celular"> 
            <br>
            <p style="text-align:justify; color:black;">Otros números telefonicos.</p>
            <input type="text" name="otros_telefonos" class="form-control"  placeholder="Otros telefonos">
            <br>
            <p style="text-align:justify; color:black;">Otros:<br>
            Cuéntanos si haz modificado algún otro de tus datos, estaremos muy agradecidos.</p>
          <textarea name="otros" rows="2" class="form-control" placeholder="Ejemplo: direccion de trabajo... telefono trabajo...Información de referencias...."></textarea> 
          <p style="text-align:justify; color:black;">Sugerencias:<br>
          Queremos mejorar. Déjanos tu sugerencia. Con tu ayuda prestaremos un mejor servicio. Gracias.</p>
          <textarea name="sugerencias" rows="2" class="form-control" placeholder="Sugerencias... Comentarios... Inquietudes..."></textarea>
            <p style="text-align:justify; color:black;">Valor de crédito a solicitar.<strong style="color:red;">*</strong></p>
            <input type="number" name="valor" id="valor" class="form-control" placeholder="Cantidad de dinero que necesitas" required> 
            <br>
            <p style="text-align:justify; color:black;">Periodicidad .<strong style="color:red;">*</strong> <br>
            Selecciona cada cuanto puedes realizar abonos, es importante para calcular el valor de las cuotas.</p>
            <select name="periodicidad" id="periodicidad" class="form-control">
            <option value="Diaria">Diaria</option>
            <option value="Semanal">Semanal</option>
            <option value="Quincenal">Quincenal</option>
            <option value="Mensual">Mensual</option>
            </select>
          <br>
          <input type="hidden" name="max_prest"  id="max_prest"> 
          <input  type="submit"  style="color:black; background-color:green;" class="form-control"  value="Enviar" > 
          </form>   
      </div>

      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
   
      <br>  
      <img width="200" height="200" src="Imagenes/la_humildad.png" style="margin:auto; display:block;" alt="Placeholder image"> </div>
      <br> 
    </div>

  </div> 
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.2.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<!-- <script src="js/bootstrap.js"></script> -->
  <script src="js/bootstrap-3.3.7.js"></script>
  <script>
  var cedula;
function buscar_datos() {
  var paCedula= document.getElementById("ingresaCedula");
  cedula= document.getElementById("cedula").value;
  var patron=/^[0-9]+$/;
    if (patron.test(cedula)) {
      enviarFormulario();
      paCedula.style.color="black";
      paCedula.innerText="INGRESA TU NUMERO DE CEDULA";
    } else { 
     paCedula.style.color="red"; 
     paCedula.innerText="INGRESA TU NUMERO DE CEDULA SIN PUNTOS NI LETRAS NI SIMBOLOS PARA PERMITIR LA CARGA AUTOMATICA DEL FORMULARIO!";
		}
}

function retornarDatos(){
  var cadena='cedula='+encodeURIComponent(cedula);
  return cadena;
}

var conexion1;
function enviarFormulario() {
  conexion1=new XMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','llenar_formu_solicitud_dos.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(retornarDatos());  
}

function procesarEventos(){
  if(conexion1.readyState == 4){  
    var datos=JSON.parse(conexion1.responseText);
    document.getElementById("nombre").value=datos.nombre;
    document.getElementById("direccion").value=datos.direccion;
    document.getElementById("telefono").value=datos.tel_fijo;
    var max_prest=datos.valorprestamo;
    document.getElementById("valor").value=max_prest;
    document.getElementById("max_prest").value=max_prest;
    var per = datos.periodicidad;
    if(per=="diaria"){
      document.getElementById("periodicidad").value="Diaria";
    }
    if(per=="semanal"){
      document.getElementById("periodicidad").value="Semanal";
    }
    if(per=="quincenal"){
      document.getElementById("periodicidad").value="Quincenal";
    }
    if(per=="mensual"){
      document.getElementById("periodicidad").value="Mensual";
    } 
  }
}

  
  </script>
</body>
</html>