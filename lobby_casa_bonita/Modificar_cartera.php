<?PHP
include("datos.php");

$id1=$_REQUEST['id'];
$id="'".$id1."'";

$nombre1=$_REQUEST['nombre'];
$nombre="'".$nombre1."'";

$nombre_viejo1=$_REQUEST['nombre_viejo'];
$nombre_viejo="'".$nombre_viejo1."'";

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
    if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

$mysql->query("update Carteras set Nombre=$nombre where id=$id") or die ("problemas al actualizar tabla Carteras");

$mysql->query("update clientes set Cobro=$nombre where Cobro=$nombre_viejo") or die ("problemas al actualizar tabla clientes");

$mysql->query("update prestamos set Cobro=$nombre where Cobro=$nombre_viejo") or die ("problemas al actualizar tabla prestamos");

$mysql->query("update abonos set Cobro=$nombre where Cobro=$nombre_viejo") or die ("problemas al actualizar tabla abonos");

$mysql->query("update abonos_historial set Cobro=$nombre where Cobro=$nombre_viejo") or die ("problemas al actualizar tabla abonos");

$mysql->query("update prestamos_historial set Cobro=$nombre where Cobro=$nombre_viejo") or die ("problemas al actualizar tabla abonos");

header("Location: $url/Form_carteras.php");
		
?>