<?PHP
include("datos.php");


$cedula=$_REQUEST['cedula'];
$nombre=$_REQUEST['nombre'];
$lugarexp=$_REQUEST['lugarexp'];
$fechaexp=$_REQUEST['fechaexp'];




$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or di("Problemas al conectar");	
$insert="INSERT INTO crear_clave (nombre, cedula, lugarexp, fechaexp) VALUES ('$nombre', '$cedula', '$lugarexp', '$fechaexp')"; 
		
$resultado_insert=mysqli_query($conexion,$insert) or die ("porblemas al insertar");
if($resultado_insert){
	$notificacion="Se han ingresado los datos en crear clave";
header("Location: $url/Form_%20detalle_cuentas_todos.php?cedula=$cedula.&notificacion=$notificacion");
}
		
 
?>