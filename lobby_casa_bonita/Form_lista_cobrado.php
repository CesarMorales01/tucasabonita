<!DOCTYPE html>
<html>

<head>

 <link rel="StyleSheet" href="estilos.php" type="text/css">    

  <title>Lista cobrado</title>

</head>  

<body>
<br><br>

<?php  
include("datos.php");

 //  CONFIRMAR INICIO DE SESION             
if(isset($_COOKIE['cobrador'])){
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'";
}

if(isset($_REQUEST['cobro'])){
	$cobro1=$_REQUEST['cobro'];
	$cobro="'".$_REQUEST['cobro']."'";
}

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

if($_REQUEST['cobro']==null){
  $GET_CARTE_PREDE=$mysql->query("select variable from cartera_prede where asesor=$revisar_sesion_comis") or die ("problemas al consutar cartera prede");
   if($get_prede=$GET_CARTE_PREDE->fetch_array()){
    $cobro1=$get_prede['variable'];
	$cobro="'".$get_prede['variable']."'";
   }
}


echo '<h1>Lista cobrados '.$cobro1.' </h1>';
//FORM FILTRAR
echo '<form method="post" action="Form_lista_cobrado.php">'; 
echo '<select name="cobro">';

$registros1=$mysql->query("select * from Carteras") or die ("problemas en la consulta_carteras");	
while($reg=$registros1->fetch_array()){  
$valor=$reg['Nombre'];
 echo "<option value='$valor'";
	 if ($cobro1 == $valor) { 
	 echo 'selected="true"';
	  }
echo ">$valor</option>";        
}      
echo '</select>';
echo '<br>';
echo '<input  class="botonsubmit" type="submit" value="Filtrar">'; 
echo '</form>';

echo '<br>';

$consultar=$mysql->query("SELECT * FROM lista_cobrado where Cobro=$cobro ORDER BY fecha DESC") or die ("problemas en consulta");
echo '<table class="tabencabezado" style="margin: 0 auto;">';

echo '<tr><th>Fecha</th> <th>Total Cobrado</th><th>Total egreso</th><th>Efectivo neto</th><th>Lista</th><th>Asesor</th><th>Eliminar</th> </tr>';
while($get_totales=$consultar->fetch_array()){
      echo '<tr>';

      echo '<td>';

      echo $get_totales['fecha'];

      echo '</td>'; 
	  
	  echo '<td>';

      echo $get_totales['total_cobrado'];

      echo '</td>';
	  
	  echo '<td>';

      echo $get_totales['total_egresos'];

      echo '</td>';
	  
	  echo '<td>';

      echo $get_totales['total_neto'];

      echo '</td>';

	  echo '<td>';

      echo "<textarea id='text_area' rows='1' cols='30'>";
	  $var=$get_totales['lista'];
	  $token = strtok($var, ",");

		while ($token !== false){
		echo "$token\n";
		$token = strtok(",");
		}
	  echo '</textarea>';
	  echo '<br>';	
	  $id=$get_totales['id'];
      echo '<a href="ver_lista_cobrado_xdia_movil.php?id='.$id.'">Ver lista</a>';
      echo '</td>'; 
	  
	  echo '<td>';

      echo $get_totales['asesor'];

      echo '</td>';
	  
	  echo '<td>';
	 echo '<a href="Alerta_eliminar_registro_lista_cobrado.php?id='.$get_totales['id'].'">Eliminar</a>';
      echo '</td>';	


	  echo '</tr>';
	}
   
      echo '</table>';
	  
	  
$n_registros=mysqli_num_rows($consultar);
 
//CONSULTAR INGRESO MAS ANTIGUO PARA ELIMINARLO

$check_ufecha=$mysql->query("select min(id) from lista_cobrado where Cobro=$cobro") or die ("check_ufecha");

 if($get_ufecha=$check_ufecha->fetch_array()){
 $ufecha=$get_ufecha['min(id)'];  
 }
 

 if($n_registros>150){
$borrar_uid=$mysql->query("delete from lista_cobrado where id=$ufecha") or die ("Problemas borrar primera fila");
 }
	  	 
?>



</body>

</html>	  
