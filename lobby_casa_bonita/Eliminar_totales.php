<?PHP
include("datos.php");
$Cobro="'".$_REQUEST['Cobro']."'";
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

if(isset($_POST['id'])){
	$array=$_POST['id'];
	$size_array= count($array, COUNT_RECURSIVE);
	for($x=0;$x<=$size_array-1;$x++){
	   $id=$array[$x];
	   $eliminar=$mysql->query("DELETE from totales where id=$id") or die ("problemas al eliminar");     
	}
	header("Location: $url/OpcionesTotales.php?Cobro=$Cobro");
			
} else {
 header("Location: $url/OpcionesTotales.php?Cobro=$Cobro");
}		

?>