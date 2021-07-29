<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Confirmar reportar CCM</title> 
  </head> 
  <body>
 
  <br>
  <?PHP
  include("datos.php");
  if(isset($_COOKIE['cobrador'])){	
	$revisar_sesion = "'".$_COOKIE['cobrador']."'";
	$check_tipousuario=$mysql->query("select * from asesores where imei=$revisar_sesion") or die ("problemas en la consulta asesores");
		if($revisar_usu=$check_tipousuario->fetch_array()){
		 $autor_registro=$revisar_usu['nombre'];
		}
	}
  
  $cedula=$_REQUEST['cedula'];
  
  $mysql = new mysqli("localhost", "u629086351_usuario", "pokemongo", "u629086351_ClientesMora");
	if ($mysql->connect_error) die('Problemas con la conexion a la base de datos'); 
	$cedula=$_REQUEST['cedula'];
	$consultar=$mysql->query("select cedula, autor_registro from clientesCCM where cedula=$cedula");
	if($get=$consultar->fetch_array()){
		$check=$get['cedula'];
		$check_autor_registro=$get['autor_registro'];
	}
	
	if($cedula==$check){
			if($autor_registro==$check_autor_registro){
				echo '<h1>Ya haz hecho un reporte de este cliente!</h1>';
				echo '<a href="Editar_cliente_opciones.php?cedula='.$_REQUEST['cedula'].'">Regresar</a>';
				echo '<br>';
				echo '<form action="http://consultatusaldomirey.site/CCM/Detalle_cuentas_CCM.php">';
				echo '<input type="hidden" name="cedula" value='.$cedula.'><br>';
				echo '<input style="background-color:#008f39" type="submit" value="Ver registro" />';
				echo '</form>';
				echo '<br>';
			} else {
				echo '<h1>El cliente que vas a reportar ya esta reportado como moroso!</h1>';
				echo '<p>Deseas ver el registro actual antes de reportarlo?</p>';
				echo '<br>';
				echo '<form action="http://consultatusaldomirey.site/CCM/Detalle_cuentas_CCM.php">';
				echo '<input type="hidden" name="cedula" value='.$cedula.'><br>';
				echo '<input style="background-color:#008f39" type="submit" value="Ver registro antes de reportar" />';
				echo '</form>';

				echo '<form action="reportarCCM.php" id"formReportar">';
				echo '<input type="hidden" name="cedula" value='.$cedula.'><br>';
				echo '<input style="background-color:red" type="submit" value="Reportar de todos modos" />';
				echo '</form>';
			}
	}else{
		echo '<h1>Estas seguro de reportar este cliente como moroso?</h1>';
		echo '<p>Una vez reportado ya no lo podras eliminar.</p>';
		echo '<a href="Editar_cliente_opciones.php?cedula='.$_REQUEST['cedula'].'">Cancelar</a>';
		echo '<br>';
		echo '<form action="reportarCCM.php">';
		echo '<input type="hidden" name="cedula" value='.$cedula.'><br>';
        echo '<input style="background-color:red" type="submit" value="Reportar cliente" />';
        echo '</form>';
	}
	
 
  echo '<table class="tablalistado" style="margin: 0 auto;" >'; 
  echo '<tr> <th colspan="4">Descripcion cliente</th></tr>';
   echo '<tr>';

      echo '<td>';

      echo "Nombre";

      echo '</td>';  	  

      echo '<td>';

      echo $_REQUEST['nombre'];

      echo '</td>'; 

	  echo '<td>';

      echo "Cedula";

      echo '</td>';  

      echo '<td>';

      echo $_REQUEST['cedula'];

      echo '</td>'; 

	  echo '</tr>';	

echo '</table>';
	
  ?>

</body> 

</html>
