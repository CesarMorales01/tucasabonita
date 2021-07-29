<?PHP
include("datos.php");

$imei1=$_REQUEST['imei'];
$imei="'".$imei1."'";

$nombre1=$_REQUEST['nombre'];
$nombre="'".$nombre1."'";

$nombre_viejo1=$_REQUEST['nombre_viejo'];
$nombre_viejo="'".$nombre_viejo1."'";

$tipo_usuario1=$_REQUEST['clase_usuario'];
$tipo_usuario="'".$tipo_usuario1."'";
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
    if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

$mysql->query("update asesores set nombre=$nombre where imei=$imei") or die ("problemas al actualizar tabla asesores");

$mysql->query("update asesores set tipo_usuario=$tipo_usuario where imei=$imei") or die ("problemas al actualizar tabla asesores tipo_usuario");

$mysql->query("update prestamos set asesor=$nombre where asesor=$nombre_viejo") or die ("problemas al actualizar tabla prestamos");

$mysql->query("update abonos set asesor=$nombre where asesor=$nombre_viejo") or die ("problemas al actualizar tabla abonos");

$mysql->query("update abonos_historial set asesor=$nombre where asesor=$nombre_viejo") or die ("problemas al actualizar tabla abonos_historial");

$mysql->query("update prestamos_historial set asesor=$nombre where asesor=$nombre_viejo") or die ("problemas al actualizar tabla prestamos_historial");

header("Location: $url/Form_asesores.php");
		
?>