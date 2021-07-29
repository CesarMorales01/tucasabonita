<?PHP

include("datos.php");

 $nueva_contra1=$_REQUEST['nueva_contra'];
 $nueva_contra="'".$nueva_contra1."'";
 $contra_vieja1=$_REQUEST['contra_vieja'];
 $contra_vieja="'".$contra_vieja1."'";
 
 $mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");

$mysql->query("update asesores set imei=$nueva_contra where imei=$contra_vieja") or die ("problemas al actualizar contra");
cerrar_sesion();
$notificacion="Contraseña actualizada";
header("Location: $url/Form_login.php?notificacion=$notificacion");


?>