<?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

 $cedula=$_REQUEST['cedula'];
 $direccion="'".$_REQUEST['direccion']."'";
 $telefonos="'".$_REQUEST['telefonos']."'";
 $correo="'".$_REQUEST['correo']."'";
 $contraseña="'".$_REQUEST['contraseña']."'";
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");

$update=$mysql->query("update clientes set direccion=$direccion, telefono=$telefonos where cedula=$cedula") or die ("problemas al actualizar");
$update1=$mysql->query("update crear_clave set correo=$correo, clave=$contraseña where cedula=$cedula") or die ("problemas al actualizar1");
if($update){
echo $cedula; 	
}


?>