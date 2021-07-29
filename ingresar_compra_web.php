<?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$cedula=$_REQUEST['cedula'];
$id=$_REQUEST['id'];
// establecer numero de compra
$get_compra_n=$mysql->query("select * from lista_compras where cliente=$cedula order by fecha desc") or die ("problemas en la consulta lista compras");	  
	if($get_compra=$get_compra_n->fetch_array()){
		$compra_n1= $get_compra['compra_n'];	
	}else{
		$compra_n1="0";
	}
$compra_n=$compra_n1+1;
$fecha="'".$get_global_fecha_hoy_comis."'";
$total_compra=$_REQUEST['subtotal'];
$envio=$_REQUEST['envio'];
$envio_texto=" envio gratis por compras superiores a 100 mil.";
$envio=$envio.$envio_texto;
$envio="'".$envio."'";
$medio_de_pago=$_REQUEST['medio_de_pago'];
if($medio_de_pago=="0"){
	$texto_medio_pago=". Pago contraentrega.";
}else{
	$texto_medio_pago="Pago realizado por wompi. Ref: ".$medio_de_pago;
}
$medio_de_pago=$texto_medio_pago;
$medio_de_pago="'".$medio_de_pago."'";
$comentarios="Compra desde pagina web.";
$comentarios="'".$comentarios."'";
$estado="Recibida";
$estado="'".$estado."'";
$vendedor="WebPage";
$vendedor="'".$vendedor."'";
// CONSULTAR CARRITO
$cargar_carrito=$mysql->query("select * from carrito_compras_casabonita where cliente=$id") or die ("problemas en la consulta cargar carrito");
				while($cargar_c=$cargar_carrito->fetch_array()){
				 $codigo=$cargar_c['cod'];
				 $producto="'".$cargar_c['producto']."'";
				 $descripcion="'".$cargar_c['descripcion']."'";
				 $cantidad=$cargar_c['cantidad'];
				 $precio=$cargar_c['valor'];
					// ingresar lista articulos de la compra
					$insert=$mysql->query("insert into lista_productos_comprados (cliente, compra_n, codigo, producto, descripcion, cantidad, precio) VALUES ($cedula, $compra_n, $codigo, $producto, $descripcion, $cantidad, $precio)") or die ("problemas al insertar");
				}
				
$insert1=$mysql->query("insert into lista_compras (cliente, compra_n, fecha, total_compra, domicilio, medio_de_pago, comentarios, estado, vendedor) VALUES ($cedula, $compra_n, $fecha, $total_compra, $envio, $medio_de_pago, $comentarios, $estado, $vendedor)") or die ("problemas al insertar lista compras");
	if($insert1){
		$response = "registrada1"; 
		notificar();
		$delete=$mysql->query("delete from carrito_compras_casabonita where cliente=$id") or die ("problemas delete");
		header("Location: https://tucasabonita.site/mis_compras.php");
	}	
				
				
function notificar(){
	$subject=utf8_decode("Nueva compra!"); 
	$texto= $url."ListaCompras.php";
    $message=$texto;
    $from="Tucasabonita";
    $correo= "cezar_mh86@hotmail.com";
    mail($correo, $subject, $message, $from);
}				
?>