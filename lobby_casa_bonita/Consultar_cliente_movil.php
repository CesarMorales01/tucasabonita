<?phpheader('Content-type: text/html; charset=utf-8');include("datos.php");$cedula=$_REQUEST['cedula'];$json=array();$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);    if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");$mysql->set_charset("utf8");$registros=$mysql->query("SELECT * from clientes where cedula=$cedula") or die ("problemas en la consulta");if($get_datos=mysqli_fetch_array($registros)){	$datos['nombre']=$get_datos['nombre'];	$datos['cedula']=$get_datos['cedula'];	$datos['direccion']=$get_datos['direccion'];	$datos['telefono']=$get_datos['telefono'];	$datos['direccion_trabajo']=$get_datos['direccion_trabajo'];	$datos['telefono_trabajo']=$get_datos['telefono_trabajo'];	$datos['Cobro']=$get_datos['Cobro'];	$json['datos'][]=$datos;	echo json_encode($json,JSON_UNESCAPED_UNICODE);	} else{	$get_info["nombre"]='No se encuentran datos';	$get_info["cedula"]='No se encuentran datos';	$json['datos'][]=$get_info;	echo json_encode($json);}	$mysql->close();?>