<?PHPinclude("datos.php");$cedula=$_REQUEST['cedula'];$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);    if ($mysql->connect_error)     die("Problemas con la conexión a la base de datos"); $mysql->query("update clientes set cedula='$_REQUEST[cedula]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar cedula");$mysql->query("update clientes set nombre='$_REQUEST[nombre]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar nombre");$mysql->query("update clientes set direccion='$_REQUEST[direccion]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar direccion");$mysql->query("update clientes set telefono='$_REQUEST[telefono]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar telefono");$mysql->query("update clientes set direccion_trabajo='$_REQUEST[direccion_trabajo]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar direccion_trabajo");$mysql->query("update clientes set telefono_trabajo='$_REQUEST[telefono_trabajo]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar telefono_trabajo");$mysql->query("update clientes set nombre_fiador='$_REQUEST[nombre_fiador]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizarnombre_fiador");$mysql->query("update clientes set dir_fiador='$_REQUEST[dir_fiador]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar dir_fiador");$mysql->query("update clientes set tel_fiador='$_REQUEST[tel_fiador]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar tel_fiador");$mysql->query("update clientes set otro_rifa='$_REQUEST[rifa]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar otro_rifa");$mysql->query("update clientes set valor_letra='$_REQUEST[valor_letra]' where cedula=$_REQUEST[cedula]") or die ("problemas al actualizar valor_letra");$notificacion="La informacion del cliente se ha actualizado";header("Location: $url/Form_%20detalle_cuentas_todos_micro.php?cedula=$cedula.&notificacion=$notificacion");		?>