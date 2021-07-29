<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<title>Check out casa bonita app</title>
</head>
<body >

<?php
header('Content-type: text/html; charset=utf-8');
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");
session_start();
if(isset($_REQUEST['id'])){
	$id_trans=$_REQUEST['id'];	
	$cliente=$_SESSION['ced'];
	
	$query_string="select * from crear_clave where cedula=$cliente";
	$get_i=$mysql->query($query_string) or die ("problemas en la consulta promos");
	if($get_id=$get_i->fetch_array()){
		$_SESSION['cedula']=$get_id['id'];
		$ced_session=$get_id['id'];
	}	
}

?>


<script>
var id_trans, ref, cliente, ced_session, valor_compra, fecha, estado_trans;
check_id_trans();

var conexion_transfer_carrito;
function transfer_compra_to_carrito(){
  conexion_transfer_carrito=new XMLHttpRequest();
  conexion_transfer_carrito.onreadystatechange = terminar_transfer_to_carrito;
  conexion_transfer_carrito.open('POST','transfer_arts_from_compras_carrito.php', true);
  conexion_transfer_carrito.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion_transfer_carrito.send(cargar_datos_transfer_to_carrito());  
}
function cargar_datos_transfer_to_carrito(){
	var cadena='cliente='+encodeURIComponent(cliente)+'&valor_compra='+encodeURIComponent(valor_compra)+'&fecha='+encodeURIComponent(fecha)+'&ref='+encodeURIComponent(ref)+'&ced_session='+encodeURIComponent(ced_session);
	return cadena;
}
function terminar_transfer_to_carrito(){
  if(conexion_transfer_carrito.readyState == 4){  
    var dato=conexion_transfer_carrito.responseText;
	if(dato.trim()=="transferido"){
		location.href ="https://tucasabonita.site/mis_compras.php?error=true";
	}
  }
}

function check_id_trans() {
  id_trans="<?php echo $id_trans;?>";
  if(id_trans==""){}else{
		 var uri='https://production.wompi.co/v1/transactions/'+id_trans;
		 $.getJSON(uri, function(datos) {
			    var arreglo = JSON.stringify(datos.data);
				var datas=JSON.parse(arreglo);
				fecha=datas.created_at;
				valor_compra=datas.amount_in_cents;
				estado_trans=datas.status;
				ref=datas.reference;
				cliente="<?php echo $cliente;?>";
				ced_session="<?php echo $ced_session;?>";
				if(estado_trans=="APPROVED"){
					actualizar_lista_compra_pago(); 
				 }else{
					 transfer_compra_to_carrito();
					}
			});
	 } 	 
}
var conexion1;
function actualizar_lista_compra_pago() {
  conexion1=new XMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','actualizar_lista_compra_pago_app.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(cargarDatos());  
}
function cargarDatos(){
	var cadena='id_trans='+encodeURIComponent(id_trans)+'&cliente='+encodeURIComponent(cliente)+'&valor_compra='+encodeURIComponent(valor_compra)+'&fecha='+encodeURIComponent(fecha)+'&estado='+encodeURIComponent(estado_trans)+'&ref='+encodeURIComponent(ref);
	return cadena;
}
function procesarEventos(){
  if(conexion1.readyState == 4){  
    var dato=conexion1.responseText;
	if(dato.trim()=="updated"){
		location.href ="https://tucasabonita.site/mis_compras.php";
	}
  }
}

var conexion2;
function guardar_transaccion() {
  conexion2=new XMLHttpRequest();
  conexion2.onreadystatechange = terminar_save_transaccion;
  conexion2.open('POST','Guardar_ref_wompi.php?', true);
  conexion2.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion2.send(cargar_parametros());  
}
function cargar_parametros(){
	var cadena='ref='+encodeURIComponent(id_trans)+'&cliente='+encodeURIComponent(cliente)+'&valor_compra='+encodeURIComponent(valor_compra)+'&fecha='+encodeURIComponent(fecha)+'&estado='+encodeURIComponent("Iniciada");
	return cadena;
}
function terminar_save_transaccion(){
	
} 	
</script>
</body>
</html>