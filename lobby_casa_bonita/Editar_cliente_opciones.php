<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Formulario de entrada del dato</title> 

  </head> 

  <body>
<script>
window.addEventListener('load', inicio, false);
 function inicio() {
    document.getElementById("form_eliminar_cliente").addEventListener('submit', validar, false);
  }

  function validar(evt) {  
	  if (confirm('Al eliminar el cliente tambien se eliminaran su prestamo, sus abonos e historial!!!')) {
		} else {
		evt.preventDefault();
		}	  
  }
</script>
  <br>

  <h1>Editar info cliente</h1>
<div id="contenedor"> 
   <form method="post" action="Editar_info_clientes_web.php" > 

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

  <input type="text" name="nombre_fiador" size="50" value="<?PHP echo $reg1['nombre_fiador'];?>"> 

  <br> <br> 

  Dir fiador:

  <input type="text" name="dir_fiador" size="50" value="<?PHP echo $reg1['dir_fiador'];?>">

  <br> <br> 

  Tel fiador:

  <input type="text" name="tel_fiador" size="50" value="<?PHP echo $reg1['tel_fiador'];?>"> 

  <br> <br> 

  Comentarios:

  <input type="text" name="rifa" size="50" value="<?PHP echo $reg1['otro_rifa'];?>"> 

  <br> <br> 

  Valor Letra:

  <input type="text" name="valor_letra" size="50" value="<?PHP echo $reg1['valor_letra'];?>"> 

  <br> <br> 
Cartera actual:
 <?php echo $_REQUEST['Cobro'];?> 
  <br>  <br> 
  Transferir a:
      
  <?php  

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

$registros1=$mysql->query("select * from Carteras") or die ("problemas en la consulta1");	 

echo '<select name="Cobro">';
while($reg=$registros1->fetch_array()){  
 $valor=$reg['Nombre'];
 echo "<option value='$valor'";
 if ($_REQUEST['Cobro'] == $valor) { 
 echo 'selected="true"';
  }
echo ">$valor</option>";        
}

?>     
      
 </select>
 <br><br>

  <input type="submit" class="botonsubmit" value="Editar info" style="background-color:green"> 
<br>
  </form>

  <?PHP

	echo ' <form method="post" action="Eliminar_cliente_web.php" id="form_eliminar_cliente"> ';
	echo '<input type="hidden" name="cedula" value="'.$cedula.'">';
    echo '<input type="submit" style="background-color:red" value="Eliminar cliente">';	

  ?>
   <br><br>
<div style="background-color:orange"> 
   <?PHP
  echo '<a href="confirmar_reportarCCM.php?cedula='.$cedula.'&nombre='.$reg1['nombre'].'">Reportar cliente en mora</a>';
   ?>
   <br>
</div>
</div>

</body> 

</html>



