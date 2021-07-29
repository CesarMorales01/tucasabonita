<?PHP
$value=$_REQUEST['valor'];
$value= str_replace(".","",$value);
$max=$_REQUEST['max_pres'];
$max= str_replace(".","",$max);
$apro=aprobacion($max, $value);
function aprobacion($max_pres, $valor){
    if($max_pres!=null){
        if($valor<=$max_pres){
            $aprobado="true";  
          }else{
              $aprobado="false";
          }
    }else{
        $aprobado="false";
    } 
   return $aprobado; 
}
$form_value=number_format($value, 0,',','.');
?>

<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilos_contactos.css?v=<?php echo time(); ?>" /> 
	<title>Autorespuesta</title>
  </head>
  <center>
  <body style="background-image: url('Imagenes/fondo_blanco.jpg'); background-position: center center;	  
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-size: cover;" >
<br>
  <img height="120" style="margin:auto; display:block;" src="Imagenes/Logo_eslogan.jpg">    
  <br> <br>
<div class="container">  
    <h3>¡Gracias por preferirnos!</h3> 
    <br>
      <p id="parrafo" style="font-size:20px; text-align:center;" ></p>
      <div class="row justify-content-center">
      <div class="col-xl-3" >
     
	    <a href="form_solicitudes_dos.php" class="btn btn-primary btn-lg">Hacer otra solicitud</a>
      <br>
      </div>
      <div class="col-xl-3" >
      <img id="imagen" style="width=100px; margin:40px; height:100px;"  src=""><br>
      </div>
      </div> 
  </div>
  </center>  
</body>
<script>
addEventListener('load',iniciar,false);
function iniciar(){
  var parrafo=document.getElementById('parrafo');
  var imagen=document.getElementById('imagen');
  var aprob = "<?php echo $apro ?>";
  var valor="<?php echo $form_value ?>";
  if(aprob=="false"){
    parrafo.innerHTML="Tu solicitud se ha realizado satisfactoriamente. En breve uno de nuestro asesores se comunicará contigo.";
    imagen.src="Imagenes/phone_ringing.gif";
  }else{
    parrafo.innerHTML="Tu prestamo por $"+valor+" pesos ha sido aprobado. En breve uno de nuestro asesores lo hará efectivo."; 
    imagen.src="Imagenes/pulgar_arriba.gif";
  }
}
</script>
</html>