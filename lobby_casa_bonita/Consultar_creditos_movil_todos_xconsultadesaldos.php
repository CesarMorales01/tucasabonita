<?php
include("datos.php");
$cedula=$_REQUEST['cedula'];
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
$registros=$mysql->query("SELECT * from creditos_casa_bonita") or die ("problemas en la consulta");

while($get_datos=$registros->fetch_array()){
	$datos['fecha_prest']=$get_datos['fecha_prest'];
	$datos['cedula']=$get_datos['cedula'];
	$cedula=$get_datos['cedula'];
    $fecha="'".$get_datos['fecha_prest']."'";
	$get_lista=$mysql->query("SELECT * from lista_compras where cliente=$cedula and fecha=$fecha") or die ("problemas lista c");
	if($gc=$get_lista->fetch_array()){
	 $datos['compra_n']=$gc['compra_n'];
	 $n_c=$datos['compra_n'];
		$get_pro=$mysql->query("SELECT * from lista_productos_comprados where cliente=$cedula and compra_n=$n_c") or die ("problemas lista c");
		$productos="";
		$slash=". ";
		while($gp=$get_pro->fetch_array()){	
		$productos=$productos.$gp['producto'].$slash;
		}
		$datos['productos']=$productos;
	}
   $json['datos'][]=$datos;  	
}

echo json_encode($json,JSON_UNESCAPED_UNICODE);
$mysql->close();
?>