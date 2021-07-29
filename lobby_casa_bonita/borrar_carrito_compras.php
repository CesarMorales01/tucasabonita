<?PHP
include("datos.php");
$cliente=$_REQUEST['cliente'];
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");
$eliminar="DELETE from carrito_compras where cliente=$cliente";
$resultado_eliminar=mysqli_query($conexion,$eliminar) or die ("problemas al eliminar");
if($resultado_eliminar){
	echo 'eliminado';
}
?>