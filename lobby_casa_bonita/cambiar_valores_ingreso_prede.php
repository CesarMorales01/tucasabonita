<?PHP
include("datos.php");

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
 if ($mysql->connect_error) die("Problemas con la conexiÃ³n a la base de datos");

 $mysql->query("update settings set valor_prestamo='$_REQUEST[valor_prestamo]'") or die ("problemas al actualizar valor_prestamo");
  $mysql->query("update settings set tiempo_meses='$_REQUEST[tiempo_meses]'") or die ("problemas al actualizar tiempo_meses");
   $mysql->query("update settings set periodicidad='$_REQUEST[periodicidad]'") or die ("problemas al actualizar periodicidad");
    $mysql->query("update settings set n_cuotas='$_REQUEST[n_cuotas]'") or die ("problemas al actualizar n_cuotas");
	 $mysql->query("update settings set interes='$_REQUEST[interes]'") or die ("problemas al actualizar interes");

$notificacion="Informacion actualizada";
header("Location: $url/form_cambiar_valores_ingreso_prede.php?notificacion=$notificacion");

?>