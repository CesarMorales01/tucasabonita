<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
include("datos.php");
if(isset($_COOKIE['cobrador'])){
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
} 

echo '<a href="Cerrar_sesion.php" style="float:right">Cerrar sesión</a>';

?>
<html>

<head>

<link rel="StyleSheet" href="estilos.php?v=<?php echo time(); ?>" />     

  <title>Cuadrar cuentas </title>

<meta http-equiv="Expires" content="0">
 
<meta http-equiv="Last-Modified" content="0">
 
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
 
<meta http-equiv="Pragma" content="no-cache">
</head>  

<body>
<br><br>
<?php

if(isset($_REQUEST['notificacion'])){
	echo $_REQUEST['notificacion'];
}

//FORM FILTRAR CARTERA
echo '<div style="width: 650px; text-align:center; margin: 0 auto;" class="container">';
echo '<form method="post" action="Form_Cuadrar_cuentas_cobrox_superusuario.php">'; 

echo '<select name="Cobro" name="id_Cobro">';
    
 
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

$registros1=$mysql->query("select * from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta1");

while($reg=$registros1->fetch_array()){
$Cobro0=trim($reg['unable']);
$asesorx=$reg['nombre'];
$imeix=$reg['imei'];
}
$tok = strtok($Cobro0, ",");
$n=0;
$nombres=[];
while ($tok !== false) {
   $n++;
   $nombres[$n]= "$tok";
   $tok = strtok(",");
}
$size_array= count($nombres, COUNT_RECURSIVE);

for($x=1;$x<=$size_array;$x++){
   echo "<option value='".trim($nombres[$x])."'>".$nombres[$x]."</option>";
}
      
echo '</select>';
echo '<input  class="botonsubmit" type="submit" value="Filtrar">'; 
echo '</form>';

$Cobro="'".trim($_REQUEST['Cobro'])."'";

//ESTABLECER CARTERA PREDETERMINADA
echo '<form method="post" action="Form_cartera_prede_superusuario.php">'; 
$xcomparar=$_REQUEST['Cobro'];
$GET_CARTE_PREDE=$mysql->query("select variable from cartera_prede where asesor=$revisar_sesion_comis") or die ("problemas al consutar cartera prede");
if($get_prede=$GET_CARTE_PREDE->fetch_array()){
    $Cobro2=$get_prede['variable'];
    if($xcomparar==$Cobro2){
     echo '<input type="hidden" value='.$Cobro2.' name="cartera">';
     echo '<input type="hidden" value='.$revisar_sesion.' name="asesor">';
     echo '<input  class="botonsubmit" type="submit" value="'.$Cobro2.' establecida como cartera predeterminada">';  
    } else {
     echo '<input type="hidden" value='.$xcomparar.' name="cartera">';  
     echo '<input type="hidden" value='.$revisar_sesion.' name="asesor">';
     echo '<input  class="botonsubmit" type="submit" value="Establecer '.$xcomparar.' como cartera predeterminada">';   
    }
} else {
 echo '<input type="hidden" value='.$_REQUEST['Cobro'].' name="cartera">';
 echo '<input type="hidden" value='.$revisar_sesion.' name="asesor">';
 echo '<input  class="botonsubmit" type="submit" value="Establecer '.$_REQUEST['Cobro'].' como cartera predeterminada">'; 
}
echo '</form>'; 
echo '<h1>Cuadrando cuentas '.$_REQUEST['Cobro'].'</h1>';
// fin div titulo cuadrando cuentas
echo '</div>';
echo '<br>';


$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

if ($mysql->connect_error) die ("Problemas con la conexión a la base de datos");

$registros0=$mysql->query("SELECT sum(valor_abono) as todo FROM abonos where Cobro=$Cobro and fingreso=$get_global_fecha_hoy") or die ("problemas en la consulta0");

$reg0=$registros0->fetch_array(); 

// TABLA INGRESOS - EGRESOS   

echo '<table class="tabencabezado" style="margin: 0 auto;">';

echo '<tr><th>Ingresos</th> <th>Egresos</th> </tr>';	



//1 FILA

	echo '<tr>';

      echo '<td>';

      echo "Cobrado total en el dia";

      echo '</td>';  	  

      echo '<td>';

	  echo "Total prestado dia";

      echo '</td>'; 

      echo '</tr>';



$consultar_total_prestado=$mysql->query("SELECT sum(valorprestamo) as total_prestado_dia FROM prestamos where fecha_prest=$get_global_fecha_hoy and Cobro=$Cobro") or die ("problemas en consultar total prestado");

   $get_total_cobrado=$consultar_total_prestado->fetch_array();	  

	// 2 FILA

	  echo '<tr>';

      echo '<td>';
      $Cobrado_dia=$reg0['todo'];    
      echo number_format($reg0['todo'],2,",",".");

      echo '</td>';  

	  

      echo '<td>';
      $Prestado_dia=$get_total_cobrado['total_prestado_dia'];    
	  echo number_format($get_total_cobrado['total_prestado_dia'],2,",",".");

      echo '</td>'; 

      echo '</tr>';    
	  //3 FILA

	  echo '<tr>';

      echo '<td>';

      echo '<a href="Lista_cobrado_hoy.php?Cobro='.$Cobro.'">Ver lista cobrados hoy todo</a>';

      echo '</td>';  

	  

      echo '<td>';

      echo '<a href="Lista_prestado_hoy.php?Cobro='.$Cobro.'">Ver lista prestado hoy todo</a>';

      echo '</td>'; 

      echo '</tr>';

      // 4 FILA

      echo '<tr>';

      echo '<td>';
      echo '<a href="Form_Lista_cobrado_select_dia.php?fecha='.$get_global_fecha_hoy_comis.'&Cobro='.$Cobro.'">Mostrar lista de cobrados seleccionando el dia</a>';

      echo '</td>';  

	  

     echo '<td>';
     echo '<a href="Form_Lista_prestado_select_dia.php?fecha='.$get_global_fecha_hoy_comis.'&Cobro='.$Cobro.'">Mostrar lista de prestado seleccionando el dia</a>';
    
      echo '</td>'; 

	  echo '</tr>';
	  
	  // QUINTA FILA
	  
	   echo '<tr>';

      echo '<td>';   
    echo '<a href="Lista_cobrado_asesores.php?Cobro='.$Cobro.'">Ver listas prestados y cobrado hoy por asesores</a>';
      echo '</td>';  

	  

     echo '<td>';

     echo '<a href="Cuadrar_caja_superusuario.php?Cobro='.$_REQUEST['Cobro'].'">Caja</a>';

      echo '</td>'; 

	  echo '</tr>';
	  
	  // SEXTA FILA
	  
	  echo '<tr>';

      echo '<td>';
      
      echo '<a href="Form_cobrado_select_rango_superusuario.php?Cobro='.$Cobro.'">Total cobrado seleccionando rango</a>';
     echo '</td>';  
      echo '<td>';

     echo '<a href="Form_prestado_select_rango_superusuario.php?Cobro='.$Cobro.'">Total prestado seleccionando rango</a>';

      echo '</td>'; 

	  echo '</tr>'; 

      echo '</table>';

      echo "<br>"; 

     echo "<br>"; 

      // TABLA OPCIONES   

echo '<table class="tabencabezado" style="margin: 0 auto;">';

echo '<tr><th colspan="2">Otras Opciones</th> </tr>';	



//1 FILA

	echo '<tr>';

      echo '<td>';

     echo '<a href="Lobby_superusuario.php">Ir a Lobby</a>';

      echo '</td>';  

	  

      echo '<td>';

	   echo '<a href="Form_buscar_clientes_web_superusuario.php">Buscar clientes</a>';

      echo '</td>'; 
   
      echo '</tr>';

      

      	echo '<tr>';

      echo '<td>';

      echo '<a href="Cuentas_canceladas_hoy_superusuario.php?Cobro='.$Cobro.'">Cuentas canceladas hoy</a>';

      echo '</td>'; 
      
       echo '<td>';

       echo '<a href="Form_lista_cobrado_superusuario.php?cobro='.$_REQUEST['Cobro'].'&asesor='.$asesorx.'">Lista cobrandoApp</a>';
       
      echo '</td>'; 
      
      echo '</tr>';

     echo '</table>';

     echo "<br>"; 

     echo "<br>";

    

 // TABLA TOTALES

   

     echo '<table class="tablalistado" style="margin: 0 auto;">';

          

     echo '<tr><th colspan="5">TOTALES</th>';
    
     echo '</tr>';	

     echo '<tr><th>PERIODO</th> <th>TOTAL CUENTAS</th> <th>TOTAL ABONOS</th> <th>TOTAL SALDOS</th><th><a href="Fechax_clientes_enmora_superusuario.php?Cobro='.$Cobro.'&fecha='.$get_global_fecha_hoy_comis.'">TOTAL CARTERA EN MORA</a></th></tr>';

//1 FILA

	$consultar_totales=$mysql->query("SELECT sum(totalapagar), sum(tt_abonos), sum(tt_saldo)  FROM prestamos where Cobro=$Cobro") or die ("problemas en consultar totales");

    $get_total_cobrado=$consultar_totales->fetch_array();

	  echo '<tr>';

      echo '<td>';

	  echo "ACTUAL";	

      echo '</td>';  

	  

      echo '<td>';

      echo number_format($get_total_cobrado['sum(totalapagar)'],2,",",".");

      echo '</td>'; 



	  echo '<td>';

	  echo number_format($get_total_cobrado['sum(tt_abonos)'],2,",",".");

      echo '</td>';  

	  

      echo '<td>';

	  echo number_format($get_total_cobrado['sum(tt_saldo)'],2,",",".");

      echo '</td>'; 
      
// TOTAL CARTERA EN MORA   A FECHA DE HOY   
$consultar_cartera_enmora=$mysql->query("SELECT  sum(tt_saldo)  FROM `prestamos` where vencimiento < $get_global_fecha_hoy and Cobro=$Cobro") or die("problemas al consultar cartera en mora");      
$get_cartera_enmora=$consultar_cartera_enmora->fetch_array();      
      echo '<td>';

	  echo number_format($get_cartera_enmora['sum(tt_saldo)'],2,",",".");

      echo '</td>';      

	  echo '</tr>';

   $consultar_totales_ultimo_cuadre=$mysql->query("SELECT * FROM totales where Cobro=$Cobro") or die ("problemas en consultar totales");

while($get_totales=$consultar_totales_ultimo_cuadre->fetch_array()){
      echo '<tr>';

      echo '<td>';
       echo $get_totales['Mes'];

	  	

      echo '</td>';  

	  

      echo '<td>';

      echo number_format($get_totales['Total_cuentas'],2,",",".");

      echo '</td>'; 



	  echo '<td>';

	  echo number_format($get_totales['Total_abonos'],2,",",".");

      echo '</td>';  

	  

      echo '<td>';

	  echo number_format($get_totales['Total_saldos'],2,",",".");

      echo '</td>'; 
      
       echo '<td>';

	  echo number_format($get_totales['cartera_mora'],2,",",".");

      echo '</td>'; 

	  echo '</tr>';
}
   echo '</table>';
   
 //CONSULTANDO NUMERO DE CLIENTES
	$consultar_nclientes=$mysql->query("select count(*) from clientes where Cobro=$Cobro") or die ("problemas en consultar nclientes");
    $get_nclientes=$consultar_nclientes->fetch_array();	
   
  	$consultar_nclientes_prest=$mysql->query("select count(*) from prestamos where Cobro=$Cobro") or die ("problemas en consultar nclientes");
    $get_nclientes_prest=$consultar_nclientes_prest->fetch_array();
    $nclientes_sinsaldo=$get_nclientes['count(*)']-$get_nclientes_prest['count(*)'];        
      
echo '<table class="tabencabezado" style="margin: 0 auto;">';
echo '<br><br>';
echo '<tr><th>PERIODO</th><th>TOTAL CLIENTES</th><th><a href="Clientes_con_prestamo_superusuario.php?Cobro='.$Cobro.'">TOTAL PRESTAMOS</a></th><th><a href="Clientes_sin_saldo_superusuario.php?Cobro='.$Cobro.'">CLIENTES SIN SALDO</a></th></tr>';
echo '<tr>';

echo '<td>';
echo 'ACTUAL';
echo '</td>';

echo '<td>';
echo $get_nclientes['count(*)'];
echo '</td>';

echo '<td>';
echo $get_nclientes_prest['count(*)'];
echo '</td>';

echo '<td>';
echo $nclientes_sinsaldo;
echo '</td>';
echo '</tr>';

$consultar_totales_ultimo_cuadre1=$mysql->query("SELECT * FROM totales where Cobro=$Cobro") or die ("problemas en consultar totales1");


while($get_totales1=$consultar_totales_ultimo_cuadre1->fetch_array()){
echo '<tr>'; 
echo '<td>';
echo $get_totales1['Mes'];
echo '</td>';

echo '<td>';
echo $get_totales1['tt_clientes'];
echo '</td>';

echo '<td>';
echo $get_totales1['tt_prestamos'];
echo '</td>';

echo '<td>';
echo $get_totales1['clientes_sinsaldo'];
echo '</td>';

echo '</tr>';
}

echo '</table>';   

?>

</body>

</html>