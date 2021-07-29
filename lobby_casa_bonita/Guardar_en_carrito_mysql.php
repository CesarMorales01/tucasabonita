<?PHP
include("datos.php");
 $nombre="'".$_REQUEST['nombre']."'";
 $descripcion="'".$_REQUEST['descripcion']."'";
 $valor="'".$_REQUEST['valor']."'";
 $cant="'".$_REQUEST['cant']."'";
 $subtotal="'".$_REQUEST['subtotal']."'";
 $cliente="'".$_REQUEST['cliente']."'";
 $id="'".$_REQUEST['id']."'";

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
$insertar_cifras=$mysql->query("INSERT INTO carrito_compras(cod, producto, descripcion,
 valor, cantidad, subtotal, cliente) VALUES ($id, $nombre,$descripcion,
 $valor, $cant, $subtotal, $cliente)") or die ("problemas al insertar las cifras");
 
 if($insertar_cifras){
	 echo 'insert';
 }
 ?>