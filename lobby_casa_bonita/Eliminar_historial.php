<?PHP

include("datos.php");

$nombre=$_REQUEST['nombre'];

$cedula=$_REQUEST['cedula'];

if(isset($_POST['fechas'])){
  $fechas=$_POST['fechas'];
}



$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

if(isset($fechas)){
	$size_array= count($fechas, COUNT_RECURSIVE);
	for($x=0;$x<=$size_array-1;$x++){
	   $fecha_comis="'".$fechas[$x]."'";
	   $eliminar_clientes_historial0=$mysql->query("DELETE from clientes_historial where cedula=$cedula and fecha_prest=$fecha_comis") or die ("problemas al eliminar el clientes_historial");     

	$eliminar_prestamo_historial0=$mysql->query("DELETE from creditos_casa_bonita_historial where cedula=$cedula and fecha_prest=$fecha_comis") or die ("problemas al eliminar el prestamo_historial");

	$eliminar_abonos_historial=$mysql->query("delete from abonos_historial_casa_bonita where cedula=$cedula and fecha_prest=$fecha_comis") or die ("problemas al eliminar los abonos_historial");

	if($eliminar_abonos_historial){

	header("Location: $url/Ver_historial.php?cedula=$cedula&nombre=$nombre");

		}
	}
} else {
 header("Location: $url/Ver_historial.php?cedula=$cedula&nombre=$nombre");
}	
		

?>