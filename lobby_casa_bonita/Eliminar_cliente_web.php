<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");
$eliminar="DELETE from clientes where cedula=$cedula";
$resultado_eliminar=mysqli_query($conexion,$eliminar) or die ("problemas al eliminar");
if($resultado_eliminar6){
header("Location: $url/Form_buscar_clientes_web.php");
}
?>