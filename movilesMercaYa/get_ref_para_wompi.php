<?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$select_ref=$mysql->query("select max(id) from pagos_wompi_casabonita") or die ("problemas en la consulta ref pagos wompi");	  
if($get_r=$select_ref->fetch_array()){
		echo $ref=$get_r['max(id)']+1;
}
$mysql->close();
?>