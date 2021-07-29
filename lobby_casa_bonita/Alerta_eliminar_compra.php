<?PHP
	include("datos.php");
	$id=$_REQUEST['id'];
	$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
	if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
	$get_cliente=$mysql->query("select cliente, compra_n from lista_compras where id=$id;") or die ("problemas select ");
	$check="";
	if($reg2=$get_cliente->fetch_array()){
		$cliente=$reg2['cliente'];
		$compra_n=$reg2['compra_n'];
		$eliminar1=$mysql->query("DELETE from lista_productos_comprados where cliente=$cliente and compra_n=$compra_n;") or die ("problemas al eliminar 1");
		if($eliminar1){
			$eliminar=$mysql->query("DELETE from lista_compras where id=$id;") or die ("problemas al eliminar ");
			if($eliminar){
				$url1="https://tucasabonita.site/ListaCompras.php?cedula=$cliente";
				header("Location: $url1");
			}
		}
	}
  ?>
