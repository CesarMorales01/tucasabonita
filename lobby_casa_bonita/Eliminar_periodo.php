<?PHP

include("datos.php");

$Id=$_REQUEST['Id'];

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");


$eliminar=$mysql->query("DELETE from totales where Id=$Id;") or die ("problemas al eliminar");

if($eliminar){
header("Location: $url/Form_Cuadrar_cuentas.php");
}

?>
