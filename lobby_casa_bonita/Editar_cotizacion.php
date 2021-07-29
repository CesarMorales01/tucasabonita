<?PHP
include("datos.php");
$id=$_REQUEST['id'];
$producto=$_REQUEST['producto']; 
$producto1="'".$producto."'";
$descripcion="'".$_REQUEST['descripcion']."'";
$precio="'".$_REQUEST['precio']."'";
$proveedor="'".$_REQUEST['proveedor']."'";
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
echo $producto1;
echo $descripcion;
echo $precio;
echo $id;
$mysql->query("update cotizaciones set producto=$producto1, descripcion=$descripcion, precio=$precio, proveedor=$proveedor where id=$id") or die ("problemas al actualizar");
if($mysql){
	$notificacion="Producto actualizado";
	header("Location: $url/Form_lista_cotizacion.php?producto=$producto&notificacion=$notificacion");	
}

?>

