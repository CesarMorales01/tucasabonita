<?PHP
include("datos.php");
$Cobro=$_REQUEST['Cobro'];
$id=$_REQUEST['id'];
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");
$eliminar="DELETE from caja where id=$id";
$resultado_eliminar=mysqli_query($conexion,$eliminar) or die ("problemas al eliminar");
if($resultado_eliminar){
header("Location: $url/Cuadrar_caja_micro.php?Cobro=$Cobro");
}

?>