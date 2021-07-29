<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nuevo cliente</title>
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
    <form method="post" action="Registro_clientes_navegador.php" id="form_registro_clientes" >
  <h2>Ingresar cliente:</h2>
  <hr> 
  <div class="row">
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
          <input type="text" name="nombre" class="form-control"   placeholder="Nombre" id="nombre" required> 
          <br> 
            <input type="text" name="cedula" class="form-control" placeholder="Cedula" id="cedula" required> 
            <br>
            <textarea name="direccion" rows="2" class="form-control" placeholder="Direccion"></textarea> 
            <br>
            <input type="text" name="telefono" class="form-control" placeholder="Telefono"> 
            <br>
             <textarea name="direccion_trabajo" rows="2" class="form-control"  placeholder="Direccion de trabajo"></textarea>
            <br> 
            <input type="text" name="telefono_trabajo" class="form-control" placeholder="Telefono de trabajo"> 
            <br>
            <input type="text" name="nombre_fiador"  class="form-control" placeholder="Nombre fiador"> 
            <br>
            <textarea name="dir_fiador" rows="2" class="form-control" placeholder="Direccion fiador"></textarea>
            <br>
            <input type="text" name="tel_fiador"  class="form-control" placeholder="Telefono fiador"> 
            <br>
            <input type="text" name="rifa" class="form-control" placeholder="Varios"> 
            <br>
          <input type="text" name="valor_letra" class="form-control" placeholder="Valor Letra"> 
          <br>
          <?php 
          include("datos.php");
          if(isset($_COOKIE['cobrador'])){	
          $revisar_sesion = $_COOKIE['cobrador']; 
          } else {
           $notificacion="Se requiere iniciar sesion!";
           header("Location:  $url/Form_login.php?notificacion=$notificacion");  
          }  
          $revisar_sesion_comis="'".$revisar_sesion."'";
          
          $mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
          
          if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
          
          $registros1=$mysql->query("select variable from cartera_prede where asesor=$revisar_sesion_comis") or die ("problemas en la consulta1");
          $Cobro0="";
          if($reg=$registros1->fetch_array()){
          $Cobro0=$reg['variable'];
          }
          
          $registros2=$mysql->query("select * from Carteras") or die ("problemas en la consulta1");	  
          echo '<select class="form-control" style="text-align-last: center;" name="Cobro">';
          
          while($reg2=$registros2->fetch_array()){
            $valor=$reg2['Nombre'];
            echo "<option value='$valor'";
              if ($Cobro0 === $valor) { 
              echo 'selected="true"';
              }
              echo ">$valor</option>"; 
           }
          
          ?> 
          </select>
          <br>
          <input  type="submit"  style="color:black; background-color:green;" class="form-control"  value="Registrar" > 
          </form>
          <br>
       <a class="form-control" style="text-align:center; color:blue;" href="Lobby.php">Ir a Lobby</a>   
      </div>
      <!--
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
      		
      <br>	

		<p class="info"><strong>¿Deseas un Sitio Web?</strong> Ponte en contacto con nosotros a través de este formulario.</p>

	    <p class="info">Desarrollamos Sitios Web adaptables a cualquier dispositivo utilizando para ello <strong> HTML5, CSS3, Bootstrap, Javascript y JQuery</strong>. Visita nuestro canal !!! ahí podrás encontrar recusos sobre Diseño y Desarrollo Web.</p>
	    
      <img src="imagenes/img_contacto2.jpg" class="img-rounded img-responsive" alt="Placeholder image"> </div>
    </div>
    -->
  </div> 
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="js/jquery-1.11.2.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<!-- <script src="js/bootstrap.js"></script> -->
  <script src="js/bootstrap-3.3.7.js"></script>
</body>
<script>
  window.addEventListener('load', inicio, false);

  function inicio() {
    document.getElementById("form_registro_clientes").addEventListener('submit', validar, false);
  }

  function validar(evt) {
     var nom=document.getElementById('cedula').value;
     var patron=/^[0-9]+$/;
    if (patron.test(nom)) {
    } else {    alert('El campo cedula solo puede guardar numeros!');
		evt.preventDefault();
		}
  }
</script>
</html>