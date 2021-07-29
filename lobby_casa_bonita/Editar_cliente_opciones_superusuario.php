<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Formulario de entrada del dato</title> 

  </head> 

  <body>

  <br>

  <h1>Editar info cliente</h1>
 <div id="contenedor">  
   <form method="post" action="Editar_info_clientes_web_superusuario.php"> 

    <?php 

  if(isset($_REQUEST['cedula'])){

	$cedula=$_REQUEST['cedula']; 

		

  }

include("datos.php");



$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

    if ($mysql->connect_error)

     die("Problemas con la conexión a la base de datos");

$registros1=$mysql->query("select * from clientes where cedula=$cedula") or die ("problemas en la consulta1");	  

$reg1=$registros1->fetch_array();	

   ?>

  Nombre: 

  <input type="text" name="nombre" size="50" value="<?PHP echo $reg1['nombre'];?> "> 

  <br> <br> 

  Cedula:

  <input type="text" name="cedula" size="50" value="<?PHP echo $cedula;?>"> 

  <br> <br> 

  Direccion:

  <input type="text" name="direccion" size="50" value="<?PHP echo $reg1['direccion'];?>"> 

  <br> <br> 

  Telefono:

  <input type="text" name="telefono" size="50" value="<?PHP echo $reg1['telefono'];?>"> 

  <br> <br> 

  Dir trabajo:

   <input type="text" name="direccion_trabajo" size="50" value="<?PHP echo $reg1['direccion_trabajo'];?>">

  <br> <br> 

  Tel trabajo:

  <input type="text" name="telefono_trabajo" size="50" value="<?PHP echo $reg1['telefono_trabajo']; ?>" > 

  <br> <br> 

  Nombre fiador: 

  <input type="text" name="nombre_fiador" size="48" value="<?PHP echo $reg1['nombre_fiador'];?>"> 

  <br> <br> 

  Dir fiador:

  <input type="text" name="dir_fiador" size="50" value="<?PHP echo $reg1['dir_fiador'];?>">

  <br> <br> 

  Tel fiador:

  <input type="text" name="tel_fiador" size="50" value="<?PHP echo $reg1['tel_fiador'];?>"> 

  <br> <br> 

  Varios:

  <input type="text" name="rifa" size="50" value="<?PHP echo $reg1['otro_rifa'];?>"> 

  <br> <br> 

  <label style="font-size: 16px;">Comentarios:</label>
  <textarea name="valor_letra" rows="2" cols="45" ><?PHP echo $reg1['valor_letra'];?></textarea> 

  <br> <br> 

  <input class="botonsubmit" type="submit" value="Editar info"> 

  </form>

    <br> <br> 

  </div>
</body> 

</html>


