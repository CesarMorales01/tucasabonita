  <?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
$notificacion="";
if(isset($_POST['cedulas'])){
$cedulas=$_POST['cedulas'];
$credito="True";
$credito="'".$credito."'";
$size_array= count($cedulas, COUNT_RECURSIVE);
	for($x=0;$x<=$size_array-1;$x++){   
	   $cedula= $cedulas[$x];
	   $registered=$mysql->query("select * from crear_clave where cedula=$cedula") or die ("problemas al consultar cedula");
	   if($reg=$registered->fetch_array()){
		  $mysql->query("update crear_clave set credito=$credito where cedula=$cedula") or die ("problemas al actualizar cedula");
	   }else{
		   $insert=$mysql->query("insert into crear_clave (cedula, credito) values($cedula, $credito) ") or die ("problemas al insertar");
	   }   
	} 
	if($size_array<=0){
		$notificacion="Cero seleccionados";
	}else{
		$notificacion="Creditos aprobados";
	}		
}
header("Location: $url/Form_aprobar_credito.php?notificacion=$notificacion");		
?>