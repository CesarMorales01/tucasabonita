<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Buscar clientes</title> 

  </head> 

  <body>

  <br> <br> 

  <?PHP
echo $estilos;
 if(isset($_REQUEST['notificacion'])){
echo $_REQUEST['notificacion'];	 
 }
 
echo '<h1>Buscar Clientes</h1>'; 

 ?>

   <br> <br>
   <div style="text-align:center;" class="container">
<form method="post" action="Consultar_clientes_web_lista_micro.php"> 

   Nombre:

   <input type="text" name="nombre" size="50"> 

  <br> <br> 

   

 <input type="submit" value="Buscar" class="botonsubmit"> 

  </form>

   <br> 

   <a href="Lobby_micro.php">Ir a Lobby</a>
   <div>
  </body> 

</html>