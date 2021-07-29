<?PHP
include("datos.php");
$Cobro=$_REQUEST['Cobro'];
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");
if(isset($_POST['ids'])){
    $ids=$_POST['ids'];
	$size_array= count($ids, COUNT_RECURSIVE);
	for($x=0;$x<=$size_array-1;$x++){
        $eliminar="DELETE from caja where id=$ids[$x]";
        $resultado_eliminar=mysqli_query($conexion,$eliminar) or die ("problemas al eliminar");
    }    
}
header("Location: $url/Cuadrar_caja.php?Cobro=$Cobro");    
?>