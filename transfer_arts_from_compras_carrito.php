<?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$cliente=$_REQUEST['cliente'];
$ced_session=$_REQUEST['ced_session'];
$valor_compra=$_REQUEST['valor_compra'];
$fecha=$_REQUEST['fecha'];
$tok_f = strtok($fecha, "T");
$fecha="'".$tok_f."'";
$ref=$_REQUEST['ref'];
$texto="ref_wompi=".$ref;
$texto="'".$texto."%'";
$string_request="select * from lista_compras where cliente=$cliente and comentarios like $texto";
$get=$mysql->query($string_request) or die ("problemas en la consulta info compras");
if($datos=$get->fetch_array()){	
		$compra_n=$datos['compra_n'];
}

$get_arts=$mysql->query("select * from lista_productos_comprados where cliente=$cliente and compra_n=$compra_n") or die ("problemas en la consulta arts");

while($articulos=$get_arts->fetch_array()){	
	$cod=$articulos['codigo'];
	$get_otros=$mysql->query("select * from productos where id=$cod");
		if($otros=$get_otros->fetch_array()){	
			$precio=$otros['valor'];
			$nombre="'".$otros['nombre']."'";
			$descripcion="'".$otros['descripcion']."'";
			$token = strtok($otros['imagen'], "||");
			if($token !== false) {
				 $imagen="'".$token."'";
			}
			 $cantidad=$articulos['cantidad'];	
			$codigo_insert="insert into carrito_compras_casabonita (cod, producto, descripcion, imagen, valor, cantidad, cliente) values ($cod, $nombre, $descripcion, $imagen, $precio, $cantidad, $ced_session)";
			 $insert1=$mysql->query($codigo_insert) or die ("problemas insert arts");
			 if($insert1){
					$string_delete="delete from lista_compras where cliente=$cliente and fecha=$fecha and comentarios like $texto";
					$borrar=$mysql->query($string_delete) or die ("delete lista compras");
					$borrar1=$mysql->query("delete from lista_productos_comprados where cliente=$cliente and compra_n=$compra_n") or die ("delete arts");
					echo "transferido";
				}
		}
	
}
?>