<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");
$eliminar="DELETE from clientes where cedula=$cedula";$eliminar1="DELETE from prestamos where cedula=$cedula";$eliminar2="DELETE from abonos where cedula=$cedula";$eliminar3="DELETE from clientes_historial where cedula=$cedula";$eliminar4="DELETE from prestamos_historial where cedula=$cedula";$eliminar5="DELETE from abonos_historial where cedula=$cedula";$eliminar6="DELETE from crear_clave where cedula=$cedula";
$resultado_eliminar=mysqli_query($conexion,$eliminar) or die ("problemas al eliminar");$resultado_eliminar1=mysqli_query($conexion,$eliminar1) or die ("problemas al eliminar1");$resultado_eliminar2=mysqli_query($conexion,$eliminar2) or die ("problemas al eliminar2");$resultado_eliminar3=mysqli_query($conexion,$eliminar3) or die ("problemas al eliminar3");$resultado_eliminar4=mysqli_query($conexion,$eliminar4) or die ("problemas al eliminar4");$resultado_eliminar5=mysqli_query($conexion,$eliminar5) or die ("problemas al eliminar5");$resultado_eliminar6=mysqli_query($conexion,$eliminar6) or die ("problemas al eliminar6");
if($resultado_eliminar6){
header("Location: $url/Form_buscar_clientes_web.php");
}
?>