<?PHP

include("datos.php");

$id=$_REQUEST['id'];

$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");

$eliminar="DELETE from Solicitudes_primera_vez where id=$id";

$resultado_eliminar=mysqli_query($conexion,$eliminar) or die ("problemas al eliminar");


if($resultado_eliminar){
header("Location: $url/Respuestas_solicitudes_uno.php");
}
		
?>