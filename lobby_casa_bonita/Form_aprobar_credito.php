<html>

<head>
<link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" /> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Listado de clientes</title>

</head>  

<body>
<script>
function toggle(source) {
  checkboxes = document.getElementsByName('cedulas[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;	
  }
}

</script>
<br>
<br> <br>
<div style="text-align:center;" class="container">
<form method="post" action="Form_aprobar_credito.php"> 
Nombre:
<input type="text" name="nombre" size="50"> 
<br> <br> 
<input type="submit" value="Buscar" class="botonsubmit"> 
</form>
<h3>Clientes</h3>
<?php
if(isset($_REQUEST['notificacion'])){
	echo $_REQUEST['notificacion'];
	if($_REQUEST['notificacion']!=""){
		echo '<br><br>'; 
	}
}
include("datos.php");
$nombre=$_REQUEST['nombre'];
$json=array();
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");

mysqli_set_charset($mysql,'utf8');

$registros=$mysql->query("select nombre, cedula from clientes where nombre like '%$nombre%' or direccion like '%$nombre%'") or die ("problemas en la consulta");

 echo '<tr><td colspan="6">';

    echo '</td></tr>';

    echo '<table>';									  

echo '<table class="tablalistado1"  style="margin: 0 auto;"  >';

echo '<tr><th>Nombre</th><th>Cedula</th><th>Detalle Cuenta</th><th>';
echo '<input style="margin-right:10px;" type="checkbox" id="select_all" onClick="toggle(this)"/>';
echo "Credito a todos";
echo '</th></tr>';	
 echo '<form method="post" action="Aprobar_creditos_casa_bonita.php" id"Aprobar_creditos_casa_bonita">';
while($reg=$registros->fetch_array()){

	 echo '<tr>';

      echo '<td>';

      echo $reg['nombre'];

      echo '</td>';  

	  

      echo '<td>';

      echo $reg['cedula'];

      echo '</td>'; 

	  

	 echo '<td>';
     echo '<div id="enlaces">';    
	 echo '<a href="Form_ detalle_cuentas_todos.php?cedula='.$reg['cedula'].'">Ver detalles</a>';
     echo '</div>';
      echo '</td>';	
	  
	   echo '<td>';
	  echo '<input type="checkbox" name="cedulas[]" value="'.$reg['cedula'].'"/>';
      echo '<input type="submit" style="background-color:red; margin-left:10px;" value="Aprobar seleccionados">';	  
      echo '</td>';	
 echo '</tr>';
	  

	}



$mysql->close();



?>

</body>

</html>
