<?php
include("datos.php");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado 

if(isset($_COOKIE['cobrador'])){	
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'"; 
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  

$tipo_usuario1 = $_COOKIE['tipo_usuario'];
$tipo_usuario="'".$tipo_usuario1."'";
//REVISAR TIPO DE USUARIO

if(isset($_COOKIE['tipo_usuario'])){
$tipo_usuario1 = $_COOKIE['tipo_usuario'];
$tipo_usuario="'".$tipo_usuario1."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  
	 
$check_tipousuario=$mysql->query("select * from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta asesores");
if($revisar_usu=$check_tipousuario->fetch_array()){
  $type_usu=$revisar_usu['tipo_usuario'];
}
if($type_usu!="administrador"){
$notificacion="Se requiere iniciar sesión!";
header("Location:  $url/Form_login.php?notificacion=$notificacion");  		
}     

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
// consultado propiedades de estilos
$getStyles=$mysql->query("SELECT * FROM settings") or die ("problemas en la consulta styles");
$get_settings0=$getStyles->fetch_array();
?>
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
    <script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>
    <link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" /> 
 <title>Detalle cuenta</title> 
</head>  
<body>
<br>  
<div style="display: flex; align-items: center; justify-content: center; width: 650px; margin: 0 auto;"  class="container">
  <div class="row ">
    <nav style="background-color:<?php echo $get_settings0['btituloTres']; ?>"  class="navbar navbar-expand-md">
      <div class="col-xl-3">
        <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="Lobby.php"> <i class="fas fa-home"></i>  Lobby</a>
      </div>
      <div class="col-xl-3">
        <a class="navbar-brand" id="navBuscarClientes" style="color:black; padding-left:30px; padding-right:30px;" href="Form_buscar_clientes_web.php"> <i class="fas fa-search"></i>  Buscar clientes</a>
      </div>
      <div class="col-xl-3">
        <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="#tema2"> <i class="fas fa-file-invoice-dollar"></i>  Abonos</a>
      </div>
      <div class="col-xl-3">
      <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="Cerrar_sesion.php"><i class="fas fa-lock"></i>  Salir</a>
      </div>
    </nav> 
  </div>
</div>
 <br>  
<h1 style="display: flex; align-items: center; justify-content: center; width: 650px; margin: 0 auto;">Creditos Casa Bonita</h1>    
<br>
<?php
if(isset($_REQUEST['notificacion'])) { 
echo '<h2>Notificacion: ';
echo $_REQUEST['notificacion']; 
echo '</h2> <br>';
}  

$cedula=$_REQUEST['cedula'];

mysqli_set_charset($mysql,'utf8');

$registros=$mysql->query("select * from clientes where cedula=$cedula") or die ("problemas en la consulta");

// TABLA DETALLES CLIENTE Y PRESTAMO

$reg=$registros->fetch_array();
$Cobro=$reg['Cobro'];  

if(isset($_REQUEST['fecha'])){
	$fecha_cred="'".$_REQUEST['fecha']."'";
	$registros1=$mysql->query("select * from creditos_casa_bonita where fecha_prest=$fecha_cred and cedula=$cedula") or die ("problemas en la consulta1");
}else{
	$registros1=$mysql->query("select * from creditos_casa_bonita where cedula=$cedula") or die ("problemas en la consulta1");
}	  

$reg1=$registros1->fetch_array();

$compara=$reg1['vencimiento'];

$fecha_venci_comi="'".$compara."'";

date_default_timezone_set('America/Bogota');

$get_fecha=date("Y-m-d");

$fecha_hoy_comi="'".$get_fecha."'";

$checksivenci=$mysql->query("SELECT datediff($fecha_venci_comi, $fecha_hoy_comi) as difer");

$obt=$checksivenci->fetch_array();	

$obt0= $obt['difer'];

echo '<table class="tabencabezado" style="margin: 0 auto;" >'; 
if ($obt0<0){
  echo '<h1 style="color:red;">Prestamo vencido!</h1>';
} 

echo '<tr><th colspan="2" style="text-align:center">Detalle cuenta</th> <th colspan="2" style="text-align:center">Detalle prestamo</th> </tr>';	

	  echo '<tr  >';

      echo '<td>';

      echo "Nombre";

      echo '</td>';  

	  

      echo '<td>';

      echo $reg['nombre'];

      echo '</td>'; 

	    

	  echo '<td>';

      echo "Cedula";

      echo '</td>';  

	  

      echo '<td>';

      echo $reg['cedula'];

      echo '</td>'; 

	  

	  echo '</tr>';	



	  echo '<tr>';

      echo '<td>';

      echo "Direccion domicilio";

      echo '</td>';  

	  
        
      echo '<td>';
      echo '<div class="scroll_1casilla">';  
      echo $reg['direccion'];
      echo '</div>';
      echo '</td>'; 
	  

	  echo '<td>';

      echo "Fecha de prestamo";

      echo '</td>';  

	  

      echo '<td>';

      echo $reg1['fecha_prest'];

      echo '</td>'; 

	  

	  echo '</tr>';

	  echo '<td>';

      echo "Telefonos";

      echo '</td>';  

	  

      echo '<td>';
	  echo '<div class="scroll_1casilla">';
	   echo $reg['telefono'];
	  echo '</div>';
      echo '</td>';

	  

	  echo '<td>';

      echo "Valor del prestamo";

      echo '</td>';  

	  

      echo '<td>';

	  echo number_format($reg1['valorprestamo'],2,",",".");

      echo '</td>';

	  

	  echo '</tr>';

	  echo '<td>';

      echo "Direccion del trabajo";

      echo '</td>';  

	  

      echo '<td>';
      echo '<div class="scroll_1casilla">';  
      echo $reg['direccion_trabajo'];
      echo '</div>';    
      echo '</td>'; 

	  

	  echo '<td>';

      echo "Tiempo(Meses)";

      echo '</td>';  

	  

      echo '<td>';

      echo $reg1['tiempo_meses'];

      echo '</td>'; 

	  

	  echo '</tr>';

	  echo '<td>';

      echo "Telefono del trabajo";

      echo '</td>';  

	  

      echo '<td>';
	   echo '<div class="scroll_1casilla">';  
      echo $reg['telefono_trabajo'];
      echo '</div>';	
    
      echo '</td>'; 

	  

	  echo '<td>';

      echo "Periodicidad";

      echo '</td>';  

	  

      echo '<td>';

      echo $reg1['periodicidad'];

      echo '</td>'; 

	  

      echo '</tr>';

      

	  echo '<td>';

      echo "Numero cuotas";

      echo '</td>';  

	  

      echo '<td>';

      echo $reg1['n_cuotas'];

      echo '</td>'; 

	  

	  echo '<td>';

      echo "Total a pagar";

      echo '</td>';  

	  

      echo '<td>';

	  echo number_format($reg1['totalapagar'],2,",",".");

      echo '</td>';

	  

	  echo '</tr>';

	

	  echo '<td>';

      echo "Valor de las cuotas";

      echo '</td>';  

	  

      echo '<td>';

	  echo number_format($reg1['valor_cuotas'],2,",",".");

      echo '</td>'; 

    

    

     echo '<td  > ';

      echo "Vencimiento";

      echo '</td>'; 

    

      echo '<td>';

      echo $reg1['vencimiento'];

      echo '</td>'; 

	

	 echo '</tr>';

	

	 echo '<td>';

     echo "Total abonos";

     echo '</td>';  

	  

     echo '<td>';

	 echo number_format($reg1['tt_abonos'],2,",",".");

     echo '</td>'; 



	 echo '<td>';

     echo "Saldo";

     echo '</td>';	  
// ALERTA SI PRESTAMO VENCIDO
   if ($obt0<0){
   echo '<td style="background-color:red;" >';
   }else{
    echo '<td>';
   }
	 echo number_format($reg1['tt_saldo'],2,",",".");
     echo '</td>';
     echo '</tr>';

     

     echo '<tr>';

     echo '<td>';

     echo "Cuotas en mora";
     echo '</td>';

     

    echo '<td>';
     if($reg1['tt_saldo']>0){
	  $calc_dias_hastahoy=calc_dias_hastahoy($reg1['fecha_prest']);
      $periodicidad=check_periodicidad($reg1['periodicidad']);
      $calcular_cuotas_enmora=calcular_cuotas_enmora($periodicidad, $calc_dias_hastahoy, $reg1['tt_abonos'], $reg1['valor_cuotas'], $reg1['n_cuotas']);
      echo number_format($calcular_cuotas_enmora,2,",",".");
		 }else{
		  echo "";  
		 }
    echo '</td>';

     
     echo '<td>';
     echo "Cartera";
     echo '</td>';	  

	   echo '<td>';
     echo $Cobro;
     echo '</td>';
   echo '</tr>';

   echo '<tr>';
   echo '<td >';
   echo "Otros créditos";    
   echo '</td>';

   echo '<td>';
   echo '<div >'; 
   // Consultar otros creditos
   $credits=$mysql->query("select * from creditos_casa_bonita where cedula=$cedula order by fecha_prest desc") or die ("problemas al consultar creditos");
   while($cre=$credits->fetch_array()){
	   $array_fechas_creditos[]=$cre['fecha_prest'];
	   $fecha_cred_comi="'".$cre['fecha_prest']."'";
	   $get_art=$mysql->query("select compra_n from lista_compras where cliente=$cedula and fecha=$fecha_cred_comi") or die ("problemas al consultar creditos compra n");
	   while($fec=$get_art->fetch_array()){
		    $n_c=$fec['compra_n'];
		    $get_arts=$mysql->query("select producto from lista_productos_comprados where cliente=$cedula and compra_n=$n_c") or die ("problemas al consultar creditos productos compra n");
			   while($aaa=$get_arts->fetch_array()){
				  $get_articulos[]=$aaa['producto'];  
			   }
	   }
   }
   
   
   for($y=0;$y<count($array_fechas_creditos);$y++){
	    echo '<a href="Form_ detalle_cuentas_todos.php?cedula=';
        echo $cedula;
		echo '&fecha=';
		echo $array_fechas_creditos[$y];
        echo '">';
        echo '<i class="fas fa-cart-arrow-down"></i>';
        echo "   ";
        echo  $array_fechas_creditos[$y];
		echo " :";
		echo $get_articulos[$y];
        echo '</a>';
		echo '<br>';
   }   
   echo '</div>'; 
   echo '</td>';

   echo '<td>';
   echo 'Credito CasaBonita:';
   echo '</td>';
   echo '<td>';
   if($reg['otro_rifa']==""){
    echo '<div>';
   }else{
    echo '<div class="scroll_1casilla">';
   }
   $registered=$mysql->query("select * from crear_clave where cedula=$cedula") or die ("problemas al consultar cedula");
   if($registered1=$registered->fetch_array()){
	 echo $registered1['credito'];  
   }
   echo '</div>'; 
   echo '</td>'; 
   echo '</tr>';
	 echo '</table>';

echo  "<br>";

  // TABLA ACCIONES
  echo '<div style="width: 650px; margin: 0 auto;" >';
	 echo '<table class="tabencabezado" style="margin: 0 auto;" >';
	 echo '<tr><th colspan="4" style="text-align:center">Acciones</th> </tr>';	
	 echo '<tr>';
     echo '<td>';
     echo '<a href="Form_check_crear_clave.php?cedula='.$reg['cedula'].'&nombre='.$reg['nombre'].'">Ingresar/modificar claves</a>';
     echo '</td>';  
    
// BOTON AGREGAR ABONO
    echo '<form method="post" action="Form_ingresar_abono.php" id="Form_ingresar_abono">';
    echo '<input type="hidden"  name="cedula" value="'.$reg['cedula'].'">';
    echo '<input type="hidden"  name="Cobro" value="'.$Cobro.'">';
	echo '<input type="hidden"  name="fecha_prest" value="'.$reg1['fecha_prest'].'">';
	echo '<td>';
	if($reg1['tt_saldo']<=0){
	    echo '<input type="submit" class="botondesactivado" value="Agregar abono" id="confirmar"> ';
	} else {
	   echo '<input type="submit" class="botonactivado" value="Agregar abono" id="confirmar"> '; 
	}   
    echo '</form>';

     echo '</td>'; 
// BOTON AGREGAR PRESTAMO
    echo '<form method="post" action="Lista_compras_cliente_x.php" id="Form_ingresar_prestamo">';
    echo '<input type="hidden"  name="cedula" value="'.$reg['cedula'].'">';
	echo '<input type="hidden"  name="nombre" value="'.$reg['nombre'].'">';
    echo '<input type="hidden"  name="Cobro" value="'.$Cobro.'">';
	 echo '<td>';
    if($reg1['tt_saldo']<=0){
      echo '<input type="submit" class="botonactivado" value="Registrar venta" id="confirmar"> ';  
    } else {
      echo '<input type="submit" class="botondesactivado" value="Registrar venta" id="confirmar"> ';    
    }
    
    echo '</form>';
    ?>
<?php 
     echo '</td>';


	 echo '</tr>';
	 echo '<tr>';

     echo '<td>';

     echo '<a href="Alerta_guardar_historial.php?cedula='.$reg['cedula'].'">Guardar en historial</a>';

     echo '</td>';  

	 // BOTON eliminar prestamo y abonos
    echo '<form method="post" action="Alerta_eliminar_web.php" id="eliminar_web">';
    echo '<input type="hidden"  name="cedula" value="'.$reg['cedula'].'">';
    echo '<input type="hidden"  name="Cobro" value="'.$Cobro.'">';
	echo '<input type="hidden"  name="fecha_prest" value="'.$reg1['fecha_prest'].'">';
	
	echo '<input type="hidden"  name="compra_n" value="'.$n_c.'">';		
	echo '<td>';
	if($reg1['valorprestamo']==null){
	    echo '<input type="submit" class="botondesactivado" value="Eliminar credito y abonos" id="confirmar"> ';
	} else {
	   echo '<input type="submit" class="botonactivado" value="Eliminar credito y abonos" id="confirmar"> '; 
	}     
    echo '</form>';
     echo '</td>'; 

	 echo '<td>';

     echo '<a href="Ver_historial.php?cedula='.$reg['cedula'].'&nombre='.$reg['nombre'].'">Historial de creditos</a>';

     echo '</td>';	  
	  echo '</tr>';

  	echo '<tr>';
     echo '<td style="text-align:center;">';
     // CHECKBOX REVISADO
    echo '<div style="cursor:pointer;" id="divRevisado">'; 
    echo '<a id="hrefRevisado" style"margin-right:10px;" href="https://tucasabonita.site/ListaCompras.php?cedula='.$reg['cedula'].'">Lista compras  <i class="fas fa-shopping-cart"></i></a>';
    echo '</div>';
     echo '</td>';  

     echo '<td>';
     echo '<a href="Editar_cliente_opciones.php?cedula='.$reg['cedula'].'&Cobro='.$Cobro.'">Editar info cliente</a>';
     echo '</td>'; 
     // BOTON editar prestamo  
   echo '<form method="post" action="Form_editar_prestamo_web.php" id="Form_editar_prestamo_web">';
   echo '<input type="hidden"  name="cedula" value="'.$reg['cedula'].'">';
   echo '<input type="hidden"  name="fecha_prest" value="'.$reg1['fecha_prest'].'">';
   echo '<td>'; 
   echo '<input type="submit" class="botonactivado" value="Editar credito" id="confirmar"> ';   
   echo '</form>';
  echo '</td>';
  echo '</tr>';  
  echo '</table>';
  echo '</div>';
  // fin tabla acciones
  // llenar con 0 si la varialbe saldo esta vacio para que la funcion en script si funcione.
  $checkSaldo;
  if($reg1['tt_saldo']==""){
    $checkSaldo="-1";
  }else{
    $checkSaldo=$reg1['tt_saldo'];
  }
  ?>
  <script>
  window.addEventListener('load', crono, false);
  var saldo;
// ACCESOS DIRECTOS PRESIONANDO TECLAS
$(document).keydown(function(event) { 
  var key = (event.keyCode);
  if(key==65){
    if(saldo<="0"){
        alert('El cliente no tiene saldo!');
        evt.preventDefault();
      }else{
        document.getElementById("Form_ingresar_abono").submit();
      }
  }
  if(key==80){
        document.getElementById("Form_ingresar_prestamo").submit();
  }
  if(key==66){
    document.getElementById("navBuscarClientes").click();
  }
  if(key==82){
    document.getElementById("hrefRevisado").click();
  }
});
  
  function crono() {
    setTimeout(iniciarFunciones, 100);
  }

  function iniciarFunciones() {
    saldo = "<?php echo $checkSaldo ?>";
    document.getElementById("Form_ingresar_abono").addEventListener('submit', validarAbonos, false);
    document.getElementById("Form_editar_prestamo_web").addEventListener('submit', validarEditar, false);
    document.getElementById("eliminar_web").addEventListener('submit', validarEliminar, false);
  }

  function validarEditar(evt) {
    if(saldo<"0"){
        alert('El cliente no tiene saldo!');
       // evt.preventDefault();
      }
  }

  function validarAbonos(evt) {
      if(saldo<="0"){
        alert('El cliente no tiene saldo!');
        evt.preventDefault();
      }
  }

  function validarEliminar(evt) {
    if(saldo<"0"){
        alert('El cliente no tiene saldo!');
        evt.preventDefault();
      }
  }
</script>
<div class="container">
<a style="display:scroll;position:fixed; left:14px; bottom:33px;" href='#' ><img height="40" src="Imagenes/flecha_verde.jpg"></a>
</div>
<?php
$fecha_prest_comis="'".$reg1['fecha_prest']."'"; 
$registros2=$mysql->query("select * from abonos_creditos_casa_bonita where fecha_prest=$fecha_prest_comis and cedula=$cedula order by fecha asc") or die ("problemas en la consulta");
	
    // TABLA ABONOS	
echo '<A Name="tema2"></a>';
    echo  "<br>";
 echo '<div class="scroll">';
    echo '<table class="tablalistado1" style="margin: 0 auto">';

    echo '<tr><th>Fecha</th><th>Abono</th><th>Altura cuota</th><th>Asesor</th><th>Eliminar</th></tr>';	

    $sumar_abonos=0;

    while ($reg2=$registros2->fetch_array()){

	 echo '<tr>';

     echo '<td>';

     echo $reg2['fecha'];

     echo '</td>';  

	  

	 echo '<td>';

	 echo number_format($reg2['valor_abono'],2,",",".");

     echo '</td>';  

	 

	 echo '<td>';

     echo $reg2['altura_cuota'];

     echo '</td>';  

	  

	 echo '<td>';

     echo $reg2['asesor'];

     echo '</td>';  
 
     echo '<td>';

    echo '<a href="Alerta_eliminar_abono_web.php?id='.$reg2['id'].'">Eliminar</a>';
    
     echo '</td>';

	 

	 echo '</tr>';	

	 }  
echo '</table>';
echo '</div>';
?>
</body>
</html>