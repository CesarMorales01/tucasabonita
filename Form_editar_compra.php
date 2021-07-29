<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Formulario editar compra</title> 

  </head> 

  <body>

  <h1>Editar compra</h1>
<div id="contenedor"> 
   <form method="post" action="Editar_compra.php" > 

    <?php 

  if(isset($_REQUEST['id'])){

	$id=$_REQUEST['id']; 

		

  }

include("datos.php");



$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

    if ($mysql->connect_error)

     die("Problemas con la conexión a la base de datos");

$registros1=$mysql->query("select * from lista_compras where id=$id") or die ("problemas en la consulta1");	  

$reg1=$registros1->fetch_array();	

   ?>

  Cliente: 

  <input type="text" name="cliente" size="50" value="<?PHP echo $reg1['cliente'];?> "> 
  <input type="hidden" name="id" size="50" value="<?PHP echo $reg1['id'];?> "> 

  <br> <br> 

  Compra N°:

  <input type="text" name="compra_n" size="50" value="<?PHP echo $reg1['compra_n'];?>"> 

  <br>

  Fecha:

  <input type="text" name="fecha" size="50" value="<?PHP echo $reg1['fecha'];?>"> 

  <br> <br> 

  Total compra:

  <input type="text" name="total_compra" size="50" value="<?PHP echo $reg1['total_compra'];?>"> 

  <br> <br> 

  Descripcion credito:

   <input type="text" name="descripcion_credito" size="50" value="<?PHP echo $reg1['descripcion_credito'];?>">

  <br> <br> 

  N cuotas:

  <input type="text" name="n_cuotas" size="50" value="<?PHP echo $reg1['n_cuotas']; ?>" > 

  <br>

  Periodicidad: 

  <input type="text" name="periodicidad" size="50" value="<?PHP echo $reg1['periodicidad'];?>"> 

  <br> <br> 

  Domicilio:

  <input type="text" name="domicilio" size="50" value="<?PHP echo $reg1['domicilio'];?>">

  <br> <br> 

  Medio de pago:

  <input type="text" name="medio_de_pago" size="50" value="<?PHP echo $reg1['medio_de_pago'];?>"> 

  <br> <br> 

  Comentarios:

  <input type="text" name="comentarios" size="50" value="<?PHP echo $reg1['comentarios'];?>"> 

  <br>

  Cambio:

  <input type="text" name="cambio" size="50" value="<?PHP echo $reg1['cambio'];?>"> 

  <br> <br> 


  <input type="submit" class="botonsubmit" value="Editar info" style="background-color:green"> 
<br>
</form>
</div>
</body> 
</html>