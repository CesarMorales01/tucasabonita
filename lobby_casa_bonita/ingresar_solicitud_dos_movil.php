<?PHP
include("datos.php");

if($_REQUEST['nombre']!=null){
  $nombre1=$_REQUEST['nombre']; 
  $nombre="'".$nombre1."'";
}
$cedula1=$_REQUEST['cedula'];
$cedula="'".$cedula1."'";
$direccion_domicilio1=$_REQUEST['direccion_domicilio'];
$direccion_domicilio="'".$direccion_domicilio1."'";

if(isset($_REQUEST['tel_fijo'])){
  $tel_fijo1=$_REQUEST['tel_fijo'];
  $tel_fijo="'".$tel_fijo1."'";  
} else {
    $tel_fijo="''"; 
}

$celular1=$_REQUEST['celular'];
$celular="'".$celular1."'";
$valor1=$_REQUEST['valor'];
$valor="'".$valor1."'";
$periodicidad=$_REQUEST['periodicidad'];

            if($periodicidad=="Diario"){

		    $periodicidad=1;

		    }if ($periodicidad=="Semanal"){

			$periodicidad=2;

		    }if ($periodicidad=="Quincenal"){

			$periodicidad=3;

		    }if($periodicidad=="Mensual"){

			$periodicidad=4;

		    }
if(isset($_REQUEST['otros'])){
  $otros1=$_REQUEST['otros'];
  $otros="'".$otros1."'";  
} else {
    $otros=$otros="''";
}

if(isset($_REQUEST['sugerencias'])){
 $sugerencias1=$_REQUEST['sugerencias'];
 $sugerencias="'".$sugerencias1."'";  
} else{
   $sugerencias="''";   
}
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);	

$select=$mysql->query("select fecha from solicitudes_dos where cedula=$cedula order by fecha desc")or die ("problemas en la consulta");
$check="";
date_default_timezone_set('America/Bogota');
$fecha1=date("Y-m-d h:i:s");
$fecha="'".$fecha1."'";
if($get_info=mysqli_fetch_array($select)){
	$check="true";
	$fecha_registrada="'".$get_info['fecha']."'";	
		$add_fecha=$mysql->query("select date_add($fecha_registrada, interval 10 second) as f");
		if($get_sumado=mysqli_fetch_array($add_fecha)){
			 $date_sumada= $get_sumado['f'];
			if($date_sumada<$fecha1){
				$insert="INSERT INTO solicitudes_dos(fecha, nombre, cedula, direccion_domicilio, tel_fijo, celular, valor, periodicidad, otros, sugerencias) VALUES ($fecha, $nombre, $cedula, $direccion_domicilio, $tel_fijo, $celular, $valor, $periodicidad, $otros, $sugerencias)";
				$resultado_insert=mysqli_query($conexion,$insert) or die ("problemas al insertar");
				if($resultado_insert){
				echo "registra";
				notificar();
				}else{
				echo " no registra";
				}
				
			}else{
				echo "time out";
			}
		}
}
if($check==""){
	$insert="INSERT INTO solicitudes_dos(fecha, nombre, cedula, direccion_domicilio, tel_fijo, celular, valor, periodicidad, otros, sugerencias) VALUES ($fecha, $nombre, $cedula, $direccion_domicilio, $tel_fijo, $celular, $valor, $periodicidad, $otros, $sugerencias)";
				$resultado_insert=mysqli_query($conexion,$insert) or die ("problemas al insertar");
				if($resultado_insert){
				echo "registra";
				notificar();
				}else{
				echo " no registra";
				}
}


	function notificar(){
		$subject=utf8_decode("Nueva solicitud!"); 
		$texto= "http://consultatusaldomirey.site/financieramirey/Respuestas_solicitudes_dos.php";
		$name= utf8_decode($GLOBALS['nombre']);
		$correo= "cezar_mh86@hotmail.com";
		mail($correo, $subject, $texto, $name);
	}	
?>