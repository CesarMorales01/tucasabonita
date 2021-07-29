<?PHPinclude("datos.php");

$cedula=$_REQUEST['cedula'];
$nombre=$_REQUEST['nombre'];

if(isset($_REQUEST['lugarexp'])){
$lugarexp=$_REQUEST['lugarexp']; 
}

if(isset($_REQUEST['fechaexp'])){
$fechaexp=$_REQUEST['fechaexp'];
}

if(isset($_REQUEST['usuario'])){
	$usuario=$_REQUEST['usuario']; 
}
if(isset($_REQUEST['clave'])){
	$clave=$_REQUEST['clave']; 
  }
    
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	

    $actualizar="update crear_clave set lugarexp='$_REQUEST[lugarexp]' where cedula=$_REQUEST[cedula]";
    $resultado_actualizar=mysqli_query($conexion,$actualizar) or die ("problemas al actualizar");
    
    $actualizar1="update crear_clave set fechaexp='$_REQUEST[fechaexp]' where cedula=$_REQUEST[cedula]";
    $resultado_actualizar1=mysqli_query($conexion,$actualizar1) or die ("problemas al actualizar1");
    
    $actualizar2="update crear_clave set usuario='$_REQUEST[usuario]' where cedula=$_REQUEST[cedula]";
    $resultado_actualizar2=mysqli_query($conexion,$actualizar2) or die ("problemas al actualizar2");
    
    $actualizar3="update crear_clave set clave='$_REQUEST[clave]' where cedula=$_REQUEST[cedula]";
    $resultado_actualizar3=mysqli_query($conexion,$actualizar3) or die ("problemas al actualizar3");
    
    $notificacion="Tabla crear clave actualizada ";
    header("Location: $url/Form_%20detalle_cuentas_todos.php?cedula=$cedula.&notificacion=$notificacion");
    

    
		
?>