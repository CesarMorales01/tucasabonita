	<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Salarios</title> 

  </head> 
  <body>

<?php 

echo '<br>';
echo '  <h1>Salarios</h1>'; 
include("datos.php");

	
 //  CONFIRMAR INICIO DE SESION             
if(isset($_COOKIE['cobrador'])){
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  
//REVISAR USUARIO
if(isset($_COOKIE['tipo_usuario'])){
$tipo_usuario1 = $_COOKIE['tipo_usuario'];
$tipo_usuario="'".$tipo_usuario1."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  

// REVISANDO TIPO DE USUARIO 	 
$check_tipousuario=$mysql->query("select * from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta asesores");
if($revisar_usu=$check_tipousuario->fetch_array()){
	$type_usu=$revisar_usu['tipo_usuario'];
}
if($type_usu!="administrador"){
$notificacion="Se requiere iniciar sesión!";
header("Location:  $url/Form_login.php?notificacion=$notificacion");  		
}


$total=null;

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexiÃ³n a la base de datos");
     
$registros=$mysql->query("select * from salarios") or die ("problemas en la consulta");

//TABLA SALARIOS
 echo '<table class="tablalistado1"style="margin: 0 auto;">';

echo '<tr><th>Fecha</th><th>Ingresos</th><th>Retiros</th><th>Comentarios</th><th>Ingreso neto </th><th>Total</th><th>Eliminar</th></tr>';

    while ($reg=$registros->fetch_array()) {
		
	  $id=$reg['id'];

      echo '<tr>';

      echo '<td>';
      echo $reg['Fecha'];

      echo '</td>';      

      echo '<td>';

      echo number_format($reg['Ingresos'],2,",",".");

      echo '</td>';   
      
      echo '<td>';    
      echo $reg['Retiros'];
      echo '</td>'; 
	  echo '<td>';
	
      echo $reg['Comentarios'];      

      echo '</td>'; 
      
      echo '<td>';
      
      echo number_format($reg['Ingreso_neto'],2,",",".");

      echo '</td>';
   
      echo '<td>';

      echo number_format($reg['Total'],2,",",".");      

      echo '</td>';
       $total=$reg['Total'];
 

      echo '<td>';
	  echo '<a href="alerta_eliminar_salario.php?id='.$reg['id'].'" >Eliminar</a>';
      echo '</td>';  
	  
      echo '</td>';
      echo '</tr>';      

    } 
	
if($total==null){
		echo 'No se han encontrado registros. Puedes ir a "Realizar nuevo registro" para efectuar el primero.';
		$total=0;
	}	

echo '</table>'; 
 //CONSULTAR NUMERO DE FILAS EN LA TABLA
$n_registros=mysqli_num_rows($registros);
 
 // CONSULTAR INGRESO MAS ANTIGUO PARA ELIMINARLO
 
$check_ufecha=$mysql->query("select min(id) from salarios") or die ("check_ufecha");

 if($get_ufecha=$check_ufecha->fetch_array()){
 $ufecha=$get_ufecha['min(id)'];  
 }
 

 if($n_registros>31){
$borrar_uid=$mysql->query("delete from salarios where id=$ufecha") or die ("Problemas borrar primera fila");
 }
echo '<form method="post" action="nuevo_ingreso_salario.php">';
echo '<input type="hidden" name="total" value="'.$total.'">'; 
echo '<br>';   
echo '<input class="botonsubmit" type="submit" value="Realizar nuevo ingreso">';
echo '<br>';


?>

   
</body>

</html>