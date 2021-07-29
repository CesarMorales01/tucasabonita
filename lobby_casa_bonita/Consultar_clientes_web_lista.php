<html>

<head>
<link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" /> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Listado de clientes</title>

</head>  

<body>

<br>

<h1>Resultado de la busqueda:</h1>

<?php
include("datos.php");



$nombre=$_REQUEST['nombre'];

$json=array();



$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

    if ($mysql->connect_error)

     die("Problemas con la conexión a la base de datos");

mysqli_set_charset($mysql,'utf8');

$registros=$mysql->query("select nombre, cedula from clientes where nombre like '%$nombre%' or direccion like '%$nombre%'") or die ("problemas en la consulta");

 echo '<tr><td colspan="6">';

    echo '</td></tr>';

    echo '<table>';									  

echo '<table class="tablalistado1"  style="margin: 0 auto;"  >';

echo '<tr><th>Nombre</th><th>Cedula</th><th>Detalle Cuenta</th>';	

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

	  

	}



$mysql->close();



?>

</body>

</html>