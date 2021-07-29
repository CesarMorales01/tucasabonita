<?PHP

include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
$id=$_REQUEST['id'];
echo $cobro=$_REQUEST['cartera'];
$eliminar=$mysql->query("DELETE from lista_cobrado where id=$id;") or die ("problemas al eliminar");

if($eliminar){
header("Location: $url/Form_lista_cobrado_superusuario.php?cobro=$cobro");
}

?>