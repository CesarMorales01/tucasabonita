<?PHP
include("datos.php");$imei1=$_REQUEST['imei'];
$imei="'".$imei1."'";$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$eliminar=$mysql->query("DELETE from asesores where imei=$imei;") or die ("problemas al eliminar el asesor");if($eliminar){header("Location: $url/Form_asesores.php");}
			
?>
