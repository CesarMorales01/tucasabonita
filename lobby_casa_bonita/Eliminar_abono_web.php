<?PHP
include("datos.php");

$id=$_REQUEST['id'];

$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");

$consulta0="SELECT * from abonos_creditos_casa_bonita where id=$id";

$resultado0=mysqli_query($conexion,$consulta0);
if($reg0=$resultado0->fetch_array()){
$cedula=$reg0['cedula'];$fecha_prest="'".$reg0['fecha_prest']."'";
$valor_abono=$reg0['valor_abono'];

$consulta="SELECT SUM(valor_abono), MAX(altura_cuota) from abonos_creditos_casa_bonita where fecha_prest=$fecha_prest and cedula=$cedula";

$resultado=mysqli_query($conexion,$consulta);
if($reg=$resultado->fetch_array()){
    $get_total_abonado=$reg['SUM(valor_abono)'];
    $get_altura_cuota=$reg['MAX(altura_cuota)'];
    
// ACTUALIZAR TOTALES
   $total_abonado= $get_total_abonado+$valor_abono;
    
   $consulta_tabla_prest="SELECT tt_abonos, tt_saldo FROM creditos_casa_bonita WHERE fecha_prest=$fecha_prest and CEDULA=$cedula";
   
   $resultado_tabla_prest=mysqli_query($conexion, $consulta_tabla_prest) or die ("problemas en la consulta tabla prestamos");
    
   $array_tabla_prest=$resultado_tabla_prest->fetch_array();
   $tt_abonos=$array_tabla_prest['tt_abonos'];
   $total_abonos=$tt_abonos-$valor_abono;
   $tt_saldo=$array_tabla_prest['tt_saldo'];
   $total_saldo=$tt_saldo+$valor_abono;
   
   $actualizar_totales="update creditos_casa_bonita set tt_abonos=$total_abonos, tt_saldo=$total_saldo where fecha_prest=$fecha_prest and cedula=$cedula";
		
	$resultado_actualizar_totales=mysqli_query($conexion, $actualizar_totales) or die ("problemas en la actualizacion de tabla prestamos");
		
	$eliminar="DELETE from abonos_creditos_casa_bonita where id=$id";
	
    $resultado_eliminar=mysqli_query($conexion,$eliminar) or die ("problemas al eliminar");
    
    if($resultado_eliminar){
	$notificacion="El abono se ha eliminado";
header("Location: $url/Form_%20detalle_cuentas_todos.php?cedula=$cedula.&notificacion=$notificacion");
    }
  }
}
			
?>