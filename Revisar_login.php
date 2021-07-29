<?php
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$usu="'".trim($_REQUEST['user1'])."'";
$clave="'".trim($_REQUEST['contra1'])."'";
$query_string="select * from crear_clave where correo=$usu or cedula=$usu  and clave=$clave";	
$get=$mysql->query($query_string) or die ("problemas en la consulta promos");
if($get1=$get->fetch_array()){
			// session para saber si el usuario inicio sesion.
			session_start();
			$_SESSION['cedula'] = $get1['id'];
			$_SESSION['usuario'] = $get1['usuario'];
				if($_REQUEST['save_index']==true){
					// cookies para guardar los datos de inicio si el usuario elige guardar datos.
					setcookie("usuario_cliente",$_REQUEST['user1'],time()+60*60*24*365,"/");
					setcookie("clave_cliente",$_REQUEST['contra1'],time()+60*60*24*365,"/"); 
					} else {
					 setcookie("usuario_cliente","","0","/");
					 setcookie("clave_cliente","","0","/");		
				}			
	 $send_cedula= $get1['id'];
	 $send_usuario= $get1['usuario'];
	 echo "{
				\"cedula\":\"$send_cedula\",
				\"usuario\":\"$send_usuario\"
			  }";
}else{
	echo "{
		\"cedula\":\"0\",
		\"usuario\":\"0\"
	  }";
}	
?>