<?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

$nombres="'".$_REQUEST['nombres']."'";
$cedula="'".$_REQUEST['cedula']."'";
$direccion="'".$_REQUEST['direccion']."'";
$telefonos="'".$_REQUEST['telefonos']."'";
$correo="'".$_REQUEST['correo']."'";
$contraseña="'".$_REQUEST['contraseña']."'";
$Cobro="'".$_REQUEST['Cobro']."'";
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$registros=$mysql->query("select *  from clientes where cedula=$cedula");
    if($reg=$registros->fetch_array()){
    echo 'existe';
    }else{
        $insert=$mysql->query("insert into clientes (nombre, cedula, direccion, telefono, Cobro) VALUES ($nombres, $cedula, $direccion, $telefonos, $Cobro)") or die ("problemas al insertar");
        $insert1=$mysql->query("insert into crear_clave (nombre, cedula, clave, correo, cartera) VALUES ($nombres, $cedula, $contraseña, $correo, $Cobro)") or die ("problemas al insertar");
        if($insert){
        echo "creada"; 	
        }
    }

?>