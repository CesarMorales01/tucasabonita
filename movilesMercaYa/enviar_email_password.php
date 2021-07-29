<?php 
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$correo=$_REQUEST['correo'];
$correo_comi;
if($correo!=null){
$correo_comi="'".$correo."'";
$consultar=$mysql->query("select cedula, correo from crear_clave where correo=$correo_comi") or die ("problemas en consulta");
	if($get=$consultar->fetch_array()){
        $cedula=$get["cedula"];
		$email=$get["correo"];
		}else{
            echo "noexiste";
        }		
}

if($email!=null){
    $subject=utf8_decode("Restauracion de contraseña");
    $nueva_contra= generateRandomString();
    
    $texto=utf8_decode("Nueva contraseña: ".$nueva_contra);
    $message=$texto;
    $from="visita http://tucasabonita.ga";
    
    mail($correo, $subject, $message, $from);
        if(mail){
        $nueva_contra_comis="'".$nueva_contra."'";
        $correo_comi;
        $actualizar= $mysql->query("update crear_clave set clave=$nueva_contra_comis where correo=$correo_comi") or die ("problemas al actualizar");
            if($actualizar){
                echo $cedula;
                }
            }
}

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>  