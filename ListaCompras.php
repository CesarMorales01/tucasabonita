<!doctype html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<!-- Este boostrap es necesario para cargar la barra de acciones -->
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="funciones.js"></script>
    <link rel="stylesheet" href="estilos.php" type="text/css">
 </head>  
<body>    
<title>Lista compras</title>
<br>
<div class="container">
<nav style="background-color:#fb6a4b;" class="navbar navbar-expand-md  ">
	<a class="navbar-brand" style="color:white; padding-left:30px; padding-right:30px;" href="#"> <i class="fas fa-shopping-cart"></i>  Merca Ya</a>
	<button class="navbar-toggler active" style="background-color:white; width:13%;" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
		aria-expanded="false" aria-label="Toggle navigation"></button>
	<div class="collapse navbar-collapse" id="collapsibleNavId">
		
		<ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
			<li class="nav-item active">
				<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irProductos()" href="#"> <i class="fas fa-box-open"></i>  Productos</a>
			</li>

			<li class="nav-item active">
				<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irCategorias()" href="#"><i class="fas fa-align-justify"></i> Categorias<span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item active">
			<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irPromociones()" href="#"> <i class="fab fa-adversal"></i>  Promociones</a>	
			</li>
			<li class="nav-item active">
				<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irClientes()" href="#"><i class="fas fa-user-friends"></i>  Clientes</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px;" onClick="irListaCompras()" href="#"><i class="fas fa-shopping-cart"></i>  Lista compras</a>
			</li>
		</ul>
	</div>
</nav>
</div>
<br>
<h1 align="center">Lista Compras</h1>
<br>
<?php
include("datos.php");
echo '<br>';
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if(isset($_REQUEST['cedula'])){
	 $cedula=$_REQUEST['cedula'];
	$get=$mysql->query("select * from lista_compras where cliente=$cedula order by fecha desc") or die ("problemas al consultar");
}else{
	$get=$mysql->query("select * from lista_compras order by fecha desc") or die ("problemas al consultar");
} 
    echo '<div id="divTabla">'; 
    echo '<table class="table">';
    echo '<tr><th>Cliente</th><th>Numero compra</th><th>Fecha</th><th>Total valor compra // Credito</th><th>Domicilio</th><th>Medio de pago</th><th>Comentarios</th><th>Cambio</th><th  data-toggle="tooltip" title="Diferente a entregada para que cargue la activity detalle credito en la app.">Estado</th><th>Eliminar</th><th>Vendedor</th></tr>';	
    $arrayEstado=[];
    $arrayIds=[];
    while ($items=$get->fetch_array()){   
    echo '<tr class="table-success" >';
    echo '<td>';
    $cedula=$items['cliente'];
    $getCliente=$mysql->query("select * from clientes where cedula=$cedula") or die ("problemas al consultar cliente");
        if($info=$getCliente->fetch_array()){
            echo '<a href="lobby_casa_bonita/Editar_cliente_opciones.php?cedula=';
            echo $info['cedula'];
            echo '">';
            echo  $info['nombre'];
            echo '</a>';
        }
    echo '</td>';
    echo '<td>';
        echo '<a href="Detalle_compra.php?cedula=';
        echo $info['cedula'];
        echo '&compra_n=';
        echo  $items['compra_n'];
        echo '">';
        echo '<i class="far fa-eye"></i>';
        echo "   ";
        echo  $items['compra_n'];
        echo '</a>';
    echo '</td>';
    echo '<td>';
    echo  $items['fecha'];
    echo '</td>';
    echo '<td>';
    $credito=$items['descripcion_credito'];
    if($credito=="0"){
        echo  $items['total_compra'];
    }else{
        //ENLACE PARA IR A CONSOLA CREDITOS CASA BONITA
        echo '<a href="lobby_casa_bonita/Form_%20detalle_cuentas_todos.php?cedula=';
            echo $info['cedula'];
            echo '">';
            echo  $items['descripcion_credito'];
            echo '</a>';
    }
    echo '</td>';
    echo '<td>';
    echo $items['domicilio'];    
    echo '</td>';
    echo '<td>';
    $m_pago=$items['medio_de_pago'];
	$first_token  = strtok($m_pago, ':');
	$second_token = strtok(':');
	if($second_token!=null){
		 echo '<a href="https://comercios.wompi.co/transactions/';
            echo trim($second_token);
            echo '"  target="_blank">';
			echo $items['medio_de_pago'];
            echo '</a>';
	}else{
		echo  $items['medio_de_pago'];
	}
    echo '</td>';
    echo '<td>';
    echo  $items['comentarios'];
    echo '</td>';
    echo '<td>';
    echo  $items['cambio'];
    echo '</td>';
    echo '<td>';
    $id=$items['id'];
    $arrayIds[]=$id;
    $arrayEstado[]=$items['estado'];
    echo '<button type="button" id="';
    echo $id;
    echo '" style="cursor:pointer; background-color:#FFF9C4; color:#0101DF;" onclick="abrirDialogoEstado(';
    echo $id;
    echo ')">';
    echo $items['estado'];
    echo '</button>';
    echo '</td>';
	 echo '<td>';
	echo '<a href="#" onClick="AlertEliminar('.$items['id'].')"><img height="20" width="20" src="Imagenes_productos/eliminar.png"></a>';
	echo '<br><br>';
	echo '<a  href="Form_editar_compra.php?id='.$items['id'].'"><i style="color:red;" class="fas fa-pencil-alt"></i></a>';
	echo '<br><br>';
	$compra_codif=base64_encode(urldecode($items['compra_n']));
	echo '<a  href="Ver_factura.php?cedula='.$info['cedula'].'&compra_n='.$compra_codif.'"><i class="fas fa-file-invoice"></i></a>';
	 echo '</td>';
	  echo '<td>';
	  echo $items['vendedor'];
	 echo '</td>';
    echo '</tr>';
    }
    echo '</table>';
    echo '</div>';  
?>
				<a class="nav-link" id="btn_dialogo_estado" data-toggle="modal" data-target="#dialogo1" ></a>
			  <!-- INICIO DIALOGO NUEVO REGISTRO --> 
					<div class="modal fade" id="dialogo1">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <!-- TItulo diálogo -->
                                <div class="modal-header">
                                <h5 class="modal-title col-11 text-center">Cambiar estado de pedido</h5>
							    </div>
                                <br>    
						  <!-- cuerpo diálogo -->
						<div class="row justify-content-around">
						  <div class="col-3">
                          <button type="button" id="btn_cancelar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						  </div>
						  <div class="col-3">
                                <select id="select" onchange="cambiarEstado()" name="estado">
                                
                                <option value=0>Recibida</option> 
                                <option value=1>Preparando</option>
                                <option value=2>En camino</option>
                                <option value=3>Entregada</option>
                                </select>
						  </div>
						</div> 
						<br><br>	
						</div>
					  </div>
					</div>
			    <!-- FIN DIALOGO -->
<script src="functions_my_system.php"></script>  				
<script>
var id;
var ids;
var estados;
var select;
function abrirDialogoEstado(cod){
    id=cod;
    ids= <?php echo json_encode($arrayIds);?>;
    estados= <?php echo json_encode($arrayEstado);?>;
    iniciarSelect();
    var btn_dialogo_estado=document.getElementById('btn_dialogo_estado');
    btn_dialogo_estado.click();
}

function AlertEliminar(param) {
	var retVal = confirm("Eliminar compra?");
               if( retVal == true ) {
				   var url="<?php echo $url; ?>";
				    var url = url+"lobby_casa_bonita/Alerta_eliminar_compra.php?id="+param;
				   //var url = "http://tucasabonita.site/lobby_casa_bonita/Alerta_eliminar_compra.php?id="+param;
                  location.href =url;
                  return true;
               } else {
                  return false;
               }
}

function iniciarSelect(){
    select = document.getElementById("select");
    var getId;
    ids.forEach( function(valor, indice, array) {
        if(id==valor){
            getId=indice;
        }
    });
    if(estados[getId]=="Recibida"){
        select.selectedIndex="0";
    } 
    if(estados[getId]=="Preparando"){
        select.selectedIndex="1";
    }
    if(estados[getId]=="En camino"){
        select.selectedIndex="2";
    } 
    if(estados[getId]=="Entregada"){
        select.selectedIndex="3";
    } 
}
var conexion1;
var estado;
function cambiarEstado() {
  conexion1=new XMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','Cambiar_estado_compra.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(enviarDatos());  
}
function enviarDatos(){
  var select = document.getElementById("select");
  estado = select.value;  
  var cadena='id='+encodeURIComponent(id)+'&estado='+encodeURIComponent(estado);
  return cadena;
}
function procesarEventos(){
    if(conexion1.readyState == 4){ 
        if(conexion1.responseText=="actualizado"){
            var btn_cancelar=document.getElementById('btn_cancelar');
            btn_cancelar.click();
            var btn = document.getElementById(id);
            if(estado=="0"){
                btn.innerText="Recibida";
            } 
            if(estado=="1"){
                btn.innerText="Preparando";
            }
            if(estado=="2"){
                btn.innerText="En camino";
            } 
            if(estado=="3"){
                btn.innerText="Entregada";
            } 
        }else{
            alert("Problemas en la conexion...")     
        }
    } 
    
}
// Poner clase scroll en pantallas pequeñas
let x = $(document);
x.ready(ponerClase);
function ponerClase(){
    var tamañoPant= screen.width;
    var divtabla = document.getElementById("divTabla");
   if(tamañoPant<450){
    divTabla.style.overflow = "scroll";
    divTabla.style.width= '405px';
    divTabla.style.marginLeft = "10px";
   }else{
    divTabla.className += "container";
   }
 }
</script>
</body>
</html>