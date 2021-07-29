<?php
include("index_hipertext.php");		
?>
window.addEventListener('load', inicializar_eventos, false);

var codigos_promos;
var get_json_productos;
var vector_productos=[];
var vector_productos_id=[];
var categorias, cedula;
var url="<?php echo $url1;?>";
var tel="<?php echo $tel_whatsapp;?>";
function inicializar_eventos(){
  categorias= <?php echo json_encode($categorias);?>;
  codigos_promos= <?php echo json_encode($codigos_promos);?>;
  get_json_productos= <?php echo json_encode($productos);?>;
  get_json_productos_id= <?php echo json_encode($productos_id);?>;
  for(var i=0;i<get_json_productos.length;i++){
	 vector_productos[i]=get_json_productos[i];
	 vector_productos_id[i]=get_json_productos_id[i];
  }
  document.getElementById('input_autocomplete').addEventListener('keydown', showup_button, false);
  check_session();
}

function close_button_whatsapp(){
	document.getElementById("div_btn_whatsapp1").style.display="none";
	document.getElementById("div_btn_whatsapp2").style.display="none";
	document.getElementById("div_btn_whatsapp3").style.display="none";
}

function close_button_fb(){
	document.getElementById("div_btn_fb1").style.display="none";
	document.getElementById("div_btn_fb2").style.display="none";
	document.getElementById("div_btn_fb").style.display="none";
}

window.onresize = window.onload = function() {
    var width = this.innerWidth;
	if(width<2000 && width>1001){
		document.getElementById('div_btn_whatsapp1').style.right="-900px";
		document.getElementById('div_btn_whatsapp2').style.right="-820px";
		document.getElementById('div_btn_whatsapp3').style.right="-840px";	
		// cambio para btn fb
		document.getElementById('div_btn_fb').style.right="240px";
		document.getElementById('div_btn_fb2').style.right="240px";
		document.getElementById('div_btn_fb1').style.right="240px";		
	}
    if(width<1000 && width>785){
		document.getElementById('div_btn_whatsapp1').style.right="-540px";
		document.getElementById('div_btn_whatsapp2').style.right="-460px";
		document.getElementById('div_btn_whatsapp3').style.right="-480px";		
	}
	 if(width<785){
		document.getElementById('div_btn_whatsapp1').style.right="-340px";
		document.getElementById('div_btn_whatsapp2').style.right="-260px";
		document.getElementById('div_btn_whatsapp3').style.right="-280px";	
		// cambio para btn fb
		document.getElementById('div_btn_fb').style.right="-40px";
		document.getElementById('div_btn_fb2').style.right="-40px";
		document.getElementById('div_btn_fb1').style.right="-40px";		
	}  
	
	// cambio para btn fb
	 if(width<1400 && width>785){
		document.getElementById('div_btn_fb').style.right="40px";
		document.getElementById('div_btn_fb2').style.right="40px";
		document.getElementById('div_btn_fb1').style.right="40px";
	 }
}

function ir_fb(){
	href="https://www.facebook.com/TucasabonitaBmanga";
	window.open(href, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=600");
}

function ir_carrito(){
	if(cedula==""){
		location.href = url+"Login";
	}else{
		location.href = url+"Shopping_cart";
	}
}

 function check_session(){
	 cedula="<?php echo $_SESSION['cedula'];?>";
	 var usuario="<?php echo $_SESSION['usuario'];?>";
	 var drop= document.getElementById("dropdown_login");
	 var div_dropdown = document.getElementById("div_dropdown");
	 if(cedula==""){
		drop.innerHTML="Ingresar";
		div_dropdown.style.background="#FF0000";
		while (div_dropdown.firstChild) {
		  div_dropdown.removeChild(div_dropdown.firstChild);
		}
	}else{
		icono_carrito.innerHTML="<?php echo $numero_productos_carrito;?>";
		drop.innerHTML=usuario+"  ";
	}
 }
 
function showup_button() {
	document.getElementById("btn_limpiar_autocomplete").style.display = 'block';
} 

$(function(){
    $( "#input_autocomplete" ).autocomplete({
      source: vector_productos
    });
});

$("#input_autocomplete" ).on( "autocompleteselect", function( event, ui ) {
	var ind=vector_productos.indexOf(ui.item.value);
	var url1 = url+"Productos?producto="+encodeURIComponent(window.btoa(vector_productos_id[ind]));
    location.href =url1;
});
  
function limpiar_autocomplete() {
	document.getElementById("input_autocomplete").value="";
	document.getElementById("btn_limpiar_autocomplete").style.display = 'none';
}  

function cargar_promo(id) {
	var promo=codigos_promos[id];
var url1 =url+"Productos?producto="+encodeURIComponent(window.btoa(promo));
    location.href =url1;
} 

function cargar_producto(cod) {
    var url1 = url+"Productos?producto="+encodeURIComponent(window.btoa(cod));
    location.href =url1;
}

function mostrar_todo_categoria(cate) {
	var url1 = url+"Searched?lookingfor="+encodeURIComponent(window.btoa(categorias[cate]));
    location.href =url1;
}

document.getElementById("form_autocomplete").addEventListener("submit", function(event){
  event.preventDefault();
  var valor = document.getElementById("input_autocomplete").value;
  var codif=encodeURIComponent(window.btoa(valor));
  document.getElementById("lookingfor").value=codif;
  document.getElementById("form_autocomplete").submit();
});

var conexion_close_session;
function close_session() {
  conexion_close_session=new XMLHttpRequest();
  conexion_close_session.onreadystatechange = recargar_pagina;
  conexion_close_session.open('POST','close_session.php', true);
  conexion_close_session.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion_close_session.send();  
}

function recargar_pagina(){
  if(conexion_close_session.readyState == 4){
	    location.href =url;
  }
}

function ir_login(){
	if(cedula==""){
		location.href = url+"Login";
	}
}

function ir_mis_compras(){
	location.href = url+"mis_compras";
}

function ir_contacto(){
	location.href = url+"contacto";
}

function my_profile(){
	window.location=url+"my_profile";
}

function ventana_whatsapp(){
	 href="https://api.whatsapp.com/send?phone=057"+tel+"&text=";
	 window.open(href, "nuevo", "directories=no, location=no, menubar=no, scrollbars=yes, statusbar=no, tittlebar=no, width=800, height=600");
}
