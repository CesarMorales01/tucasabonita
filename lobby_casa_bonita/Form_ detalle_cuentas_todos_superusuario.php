<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
header('Content-Type: text/html; charset=UTF-8');
include("datos.php");
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
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">   
</head>  
<body>
<br>  
<div style="display: flex; align-items: center; justify-content: center; width: 650px; margin: 0 auto;"  class="container">
  <div class="row ">
    <nav style="background-color:<?php echo $get_settings0['btituloTres']; ?>"  class="navbar navbar-expand-md">
      <div class="col-xl-3">
        <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="Lobby_superusuario.php"> <i class="fas fa-home"></i>  Lobby</a>
      </div>
      <div class="col-xl-3">
        <a class="navbar-brand" id="navBuscarClientes" style="color:black; padding-left:30px; padding-right:30px;" href="Form_buscar_clientes_web_superusuario.php"> <i class="fas fa-search"></i>  Buscar clientes</a>
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

<body>

 <br>  

  <h1>Informacion detallada del cliente.</h1>  
   

<h2>Notificacion: <?php if(isset($_REQUEST['notificacion']))

 { echo $_REQUEST['notificacion']; } ?></h2>

<br>



 <?php
if(isset($_REQUEST['cedula'])){
$cedula=$_REQUEST['cedula'];
}
if(isset($_REQUEST['dkfjas'])){
$cedula=base64_decode($_REQUEST['dkfjas']);
}

mysqli_set_charset($mysql,'utf8');

$registros=$mysql->query("select * from clientes where cedula=$cedula") or die ("problemas en la consulta");

// TABLA DETALLES CLIENTE Y PRESTAMO

$reg=$registros->fetch_array();


$Cobro=$reg['Cobro'];

$registros1=$mysql->query("select * from prestamos where cedula=$cedula") or die ("problemas en la consulta1");	  

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
echo '<tr><th style="text-align:center" colspan="2">Detalle cuenta</th>  <th style="text-align:center" colspan="2">Detalle prestamo</th> </tr>';	
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

     echo "Proximo pago";

     echo '</td>';	  

	  

	 echo '<td>';

	//HAYANDO PROXIMA FECHA DE PAGO 
	 $get_fechas_pagos=$mysql->query("select * from programacion_cuotas where cedula=$cedula") or die ("problemas en la consultar_programa_pagos");		 

	$guardar_prox_fecha=null;
	 while($get1=$get_fechas_pagos->fetch_array()){
		if($fecha_hoy_comi<=$get1['fecha']){
				 $guardar_prox_fecha=$get1['fecha'];
				 break;
			
			}	
	 }
	 echo $guardar_prox_fecha;
     echo '</td>';

     

	 echo '</tr>';

	 echo '</table>';

echo  "<br>";

	// TABLA ACCIONES

	 echo '<table class="tabencabezado" style="margin: 0 auto;" >';

	 echo '<tr><th style="text-align:center" colspan="4">Acciones</th> </tr>';	

	 echo '<tr>';

   echo '<td>';

   echo '<a href="Editar_cliente_opciones_superusuario.php?cedula='.$reg['cedula'].'">Editar info cliente</a>';

   echo '</td>'; 

	  
// BOTON AGREGAR ABONO
     echo '<form method="post" action="Form_ingresar_abono_superusuario.php" id="Form_ingresar_abono">';
    echo '<input type="hidden"  name="cedula" value="'.$reg['cedula'].'">';
    echo '<input type="hidden"  name="Cobro" value="'.$Cobro.'">';
	echo '<td>';

     if($reg1['tt_saldo']<=0){
	    echo '<input type="submit" class="botondesactivado" value="Agregar abono" id="confirmar"> ';
	} else {
	   echo '<input type="submit" class="botonactivado" value="Agregar abono" id="confirmar"> '; 
	}
      
    echo '</form>';
    ?>
     <script>
  window.addEventListener('load', inicio1, false);

  function inicio1() {
    document.getElementById("Form_ingresar_abono").addEventListener('submit', validar1, false);
  }

  function validar1(evt) {
    var saldo1 = parseInt(<?php echo $reg1['tt_saldo'] ?>);
   if(isNaN(saldo1)){
       saldo1=0;
    }
    
        if(saldo1<=0){
            alert('El cliente no tiene saldo!');
            evt.preventDefault();
        }
    
  }
</script>
<?php 

echo '</td>';  

// BOTON AGREGAR PRESTAMO
    echo '<form method="post" action="Form_ingresar_prestamo_superusuario.php" id="Form_ingresar_prestamo">';
    echo '<input type="hidden"  name="cedula" value="'.$reg['cedula'].'">';
    echo '<input type="hidden"  name="Cobro" value="'.$Cobro.'">';
	 echo '<td>';
    if($reg1['tt_saldo']<=0){
      echo '<input type="submit" class="botonactivado" value="Agregar prestamo" id="confirmar"> ';  
    } else {
      echo '<input type="submit" class="botondesactivado" value="Agregar prestamo" id="confirmar"> ';    
    }
    
    echo '</form>';
    ?>
     <script>
  window.addEventListener('load', inicio, false);

  function inicio() {
    document.getElementById("Form_ingresar_prestamo").addEventListener('submit', validar, false);
  }

  function validar(evt) {
    var cla1 = <?php echo $reg1['tt_saldo'] ?>;
    
    if (cla1>0) {
      alert('El cliente ya tiene un prestamo activo!');
      evt.preventDefault();
    }
  }
</script>
<?php 
     echo '</td>';

    

	 echo '</tr>';

	

	 echo '<tr>';

     echo '<td>';

     echo '<a href="Alerta_guardar_historial_superusuario.php?cedula='.$reg['cedula'].'">Guardar en historial</a>';

     echo '</td>';  

	  

     echo '<td>';

     echo "Cartera: ";
     echo $Cobro;

     echo '</td>'; 



	 echo '<td>';

     echo '<a href="Ver_historial_superusuario.php?cedula='.$reg['cedula'].'&nombre='.$reg['nombre'].'">Ver historial y fiador</a>';

     echo '</td>';	  

	 

	echo '</tr>';

	echo '</table>';	  


    $registros2=$mysql->query("select * from abonos where cedula=$cedula order by fecha asc") or die ("problemas en la consulta");	
 echo '<div class="container">';
 echo '<a style="display:scroll;position:fixed; left:14px; bottom:33px;" href="#" ><img height="40" src="Imagenes/flecha_verde.jpg"></a>';
 echo '</div>';
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
	 
	 if($get_fecha==$reg2['fecha']){
	   echo '<a href="Alerta_eliminar_abono_web_superusuario.php?id='.$reg2['id'].'&Cobro='.$Cobro.'&cedula='.$reg['cedula'].'">Eliminar</a>';  
	 }


     echo '</td>';  

	 

	 echo '</tr>';	

	 }  


  	 echo '</table>';
  

   echo '</div>';

?>



</p>

</body>

</html>