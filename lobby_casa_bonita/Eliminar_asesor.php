<?PHP
include("datos.php");
$imei="'".$imei1."'";
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$eliminar=$mysql->query("DELETE from asesores where imei=$imei;") or die ("problemas al eliminar el asesor");
			
?>