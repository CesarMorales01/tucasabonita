<?php
header('Content-type: text/html; charset=utf-8');

include("datos.php");
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$usuario=$_REQUEST['usuario_login_admin'];
$clave1=$_REQUEST['clave_login_admin'];
$clave="'".$clave1."'";

$getdatos=$mysql->query("select * from asesores where imei=$clave") or die ("problemas al consultar tab usuarios");
         
$registro=mysqli_fetch_array($getdatos);
$clave0= $registro['imei'];
$nombre= $registro['nombre'];   
$tipo_usuario= $registro['tipo_usuario'];
if(strcmp($clave0, $clave1) != 0){	
$notificacion="Contraseña incorrecta!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
 } else {
    if(strcmp($nombre, $usuario) !== 0){
      $notificacion="Contraseña incorrecta!";
     header("Location:  $url/Form_login.php?notificacion=$notificacion");      
    } else {
         if(isset($_REQUEST['save'])){
            setcookie("save",$_REQUEST['usuario_login_admin'],time()+60*60*24*365,"/");
            setcookie("contra",$_REQUEST['clave_login_admin'],time()+60*60*24*365,"/");
         } else { 
				setcookie("save","","0","/"); 
				}      
		 setcookie("cobrador",$clave0,time()+60*60*24*365,"/");       
         setcookie("tipo_usuario",$tipo_usuario,time()+60*60*24*365,"/");
         $superusuario='superusuario';
         $administrador='administrador';
                if(strcmp($tipo_usuario, $administrador)===0){
                    header("Location:  $url/Lobby.php");
                }else {        
                    if(strcmp($tipo_usuario, $superusuario)===0){
                   header("Location:  $url/Lobby_superusuario.php");
                    } else {
                          header("Location:  $url/Lobby_micro.php");
                    }
            
                }
       
    }
}

?>