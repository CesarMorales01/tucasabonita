<?php
include("datos.php");
?>
window.addEventListener('load', inicializar_eventos, false);
var url, check_session;
function inicializar_eventos(){
    url="<?php echo $url;?>";
	revisarSesion();
}

function revisarSesion(){
	check_session="<?php echo $chequeando;?>";
	if(check_session==""){
		var notificacion="Se requiere iniciar sesión!";
		var url1 = url+"lobby_casa_bonita/Form_login.php?notificacion="+notificacion;
		window.location.href = url1;
	}
}

function irProductos(){
   window.location.href = url+"ListaProductos.php";
}
function irCategorias(){
    window.location.href = url+"Lista_categorias.php";
}

function irPromociones(){
    window.location.href = url+"ListaPromos.php";
}

function irClientes(){
    window.location.href = url+"ListaClientes.php";
}
function irListaCompras(){
    window.location.href = url+"ListaCompras.php";
}