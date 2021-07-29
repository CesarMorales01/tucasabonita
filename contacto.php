<?php
header('Content-type: text/html; charset=utf-8');
//include("_hipertext.php");
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css">
	<title>Contacto</title>
  </head>
  <body >
 <?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
<br>
<!-- Footer -->
<footer style="background-color:#f9f9c5;" class="page-footer font-small indigo">

  <!-- Footer Links -->
  <div class="container">

    <!-- Grid row-->
    <div class="row text-center d-flex justify-content-center pt-5 mb-3">

      <!-- Grid column -->
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Nosotros</a>
        </h6>
      </div>
      <!-- Grid column -->

      <!-- 
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Productos</a>
        </h6>
      </div>

      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Awards</a>
        </h6>
      </div>
 
      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Ayuda</a>
        </h6>
      </div>

      <div class="col-md-2 mb-3">
        <h6 class="text-uppercase font-weight-bold">
          <a href="#!">Contacto</a>
        </h6>
      </div>
      -->

    </div>
    <!-- Grid row-->
    <hr class="rgba-white-light" style="margin: 0 15%;">

    <!-- Grid row-->
    <div class="row d-flex text-center justify-content-center mb-md-0 mb-4">

      <!-- Grid column -->
      <div class="col-md-8 col-12 mt-5">
	  <div class="row">
		<div class="col-md-6">
		  <img width="200px;" src="Imagenes_config/casa_bonita_google_play.png">
		</div>
		<div class="col-md-6">	
			<p style="margin:2px;" ><br>Estamos ubicados en la calle 56 #3w-22. Barrio Mutis. <br> Bucaramanga. Santander.
			<br><br>Telefonos: 31661824363 - 3163439744 - 3116186785
			<br><br>E-mail: contacto@tucasabonita.site
			</p>
			<br><br>
			 <div class="container"> 
				<div class="row justify-content-center">
				  <div class="col-6">
					<a onclick="ventana_whatsapp()" class="btn btn-primary">Escribenos!</a>	 
				  </div>
				  <div class="col-6">
					<a onclick="ventana_whatsapp()" style="cursor:pointer;" ><img src="Imagenes_config/whatsapp1.png"></a> 
				  </div>  
				</div>  
			</div>
		</div>	
		</div>
	  </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->
    <hr class="clearfix d-md-none rgba-white-light" style="margin: 10% 15% 5%;">

    <!-- Grid row-->
	<br>
    <div class="row pb-3">
      <!-- Grid column -->
      <div style="text-align:center;" class="col-md-12">
        <div class="mb-5 flex-center">
          <!-- Facebook -->
          <a href="https://www.facebook.com/TucasabonitaBmanga" class="fb-ic">
            <i  class="fab fa-facebook-f fa-lg white-text mr-4"> </i>
          </a>
          
          <!-- Google 
          <a class="gplus-ic">
            <i class="fab fa-google-plus-g fa-lg white-text mr-4"> </i>
          </a>
           +-->
          <!--Instagram-->
          <a class="ins-ic">
            <i class="fab fa-instagram fa-lg white-text mr-4"> </i>
          </a>
        </div>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
  </div>

</footer>
<!-- Footer -->
<script src="functions.php"></script>
</body>
</html>