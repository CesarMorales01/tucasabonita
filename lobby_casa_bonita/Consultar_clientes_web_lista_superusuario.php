

<html> 

  <head> 
  <link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" /> 

  <title>Elije la cartera para buscar</title> 

  </head> 

  <body>
  <?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
mysqli_set_charset($mysql,'utf8');
 if(isset($_REQUEST['notificacion'])) {
 echo $_REQUEST['notificacion'];	 
 }
 
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'";


$registros1=$mysql->query("select * from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta1");

while($reg=$registros1->fetch_array()){
$Cobros=trim($reg['unable']);
}

$tok = strtok($Cobros, ",");
$n=0;
$nombres=[];
while ($tok !== false) {
   $n++;
   $nombres[$n]= "$tok";
   $tok = strtok(",");
}
$size_array= count($nombres, COUNT_RECURSIVE);
$nombre=$_REQUEST['nombre'];


for($x=1;$x<=$size_array;$x++){
$cartera="'".trim($nombres[$x])."'";
$registros=$mysql->query("select nombre, cedula from clientes where (nombre like '%$nombre%' or direccion like '%$nombre%') and Cobro=$cartera") or die ("problemas en la consulta");

 echo '<tr><td colspan="6">';

    echo '</td></tr>';

    echo '<table>';									  

echo '<table class="tablalistado1"  style="margin: 0 auto;"  >';
echo '<tr><th colspan="3">'; 
echo 'Encontrado en: '.$nombres[$x];
echo '</th></tr>';
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
	 $cedula2= base64_encode($reg['cedula']);
	 echo '<a href="Form_ detalle_cuentas_todos_superusuario.php?dkfjas='.$cedula2.'">Ver detalles</a>';
    
      echo '</td>';	

	  

	}
  echo '<br>';
   echo '<table>';		
}


 ?>

   <br> 

   <a href="Lobby_superusuario.php">Ir a Lobby</a>
 <br>    <br>
  </body> 

</html>