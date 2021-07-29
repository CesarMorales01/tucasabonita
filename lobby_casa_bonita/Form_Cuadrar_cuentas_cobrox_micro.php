<?php
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

 <link rel="StyleSheet" href="estilos.php" type="text/css">    

  <title>Cuadrar cuentas </title>

</head>  
<br>
<h1>Filtrar cartera</h1>
<body>

<?php

if(isset($_REQUEST['notificacion'])){
	echo $_REQUEST['notificacion'];
}

// FORM FILTRAR CARTERAS
echo '<form method="post" action="Form_Cuadrar_cuentas_cobrox_micro.php">'; 
  
echo '<select name="Cobro">';
    

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

$registros1=$mysql->query("select * from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta1");
while($reg=$registros1->fetch_array()){
$Cobro0=$reg['unable'];
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
   echo "<option value='".$nombres[$x]."'>".$nombres[$x]."</option>";
}
      
echo '</select>';
echo '<input  class="botonsubmit" type="submit" value="Filtrar">'; 
echo '</form>';

$Cobro="'".trim($_REQUEST['Cobro'])."'";

//ESTABLECER CARTERA PREDETERMINADA
echo '<form method="post" action="Form_cartera_prede_micro.php">';
$xcomparar=trim($_REQUEST['Cobro']);
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
   echo '<input type="hidden" value='.$xcomparar.' name="cartera">';  
   echo '<input type="hidden" value='.$revisar_sesion.' name="asesor">';
   echo '<input  class="botonsubmit" type="submit" value="Establecer '.$xcomparar.' como cartera predeterminada">';  
}
echo '</form>'; 
echo '<h1>Cuadrando cuentas '.$_REQUEST['Cobro'].'</h1>';
echo '<br>';

$asesor="'".$asesorx."'";

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

if ($mysql->connect_error) die ("Problemas con la conexión a la base de datos");

$registros0=$mysql->query("SELECT sum(valor_abono) as todo FROM abonos where Cobro=$Cobro and fingreso=$get_global_fecha_hoy and asesor=$asesor") or die ("problemas en la consulta0");

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



$consultar_total_prestado=$mysql->query("SELECT sum(valorprestamo) as total_prestado_dia FROM prestamos where fecha_prest=$get_global_fecha_hoy and Cobro=$Cobro and asesor=$asesor") or die ("problemas en consultar total prestado");

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

     echo '<a href="Lista_cobrado_dia_asesorx.php?Cobro='.$Cobro.'&nombre='.$asesorx.'">Ver lista cobrados hoy</a>';

      echo '</td>';  

	  

      echo '<td>';

      echo '<a href="Lista_prestado_dia_asesorx.php?Cobro='.$Cobro.'&imei='.$imeix.'&nombre='.$asesorx.'">Ver lista prestado hoy</a>';

      echo '</td>'; 

      echo '</tr>';

      // 4 FILA

      echo '<tr>';

      echo '<td>';
      echo '<a href="Form_Lista_cobrado_select_dia_micro.php?fecha='.$get_global_fecha_hoy_comis.'&Cobro='.$Cobro.'&nombre='.$asesorx.'">Mostrar lista de cobrados seleccionando el dia</a>';

      echo '</td>';  

	  

     echo '<td>';

     echo '<a href="Form_Lista_prestado_select_dia_micro.php?fecha='.$get_global_fecha_hoy_comis.'&Cobro='.$Cobro.'&imei='.$imeix.'">Mostrar lista de prestado seleccionando el dia</a>';

      echo '</td>'; 
	   echo '</tr>';
	   
	   
	  echo '</tr>';
	  
	  echo '<tr>';

      echo '<td>';
      echo '<a href="Form_cobrado_select_rango_micro.php?fecha='.$get_global_fecha_hoy_comis.'&Cobro='.$Cobro.'&nombre='.$asesorx.'">Total cobrado seleccionando rango</a>';

      echo '</td>';  

	  

     echo '<td>';

     echo '<a href="Form_prestado_select_rango_micro.php?fecha='.$get_global_fecha_hoy_comis.'&Cobro='.$Cobro.'&nombre='.$asesorx.'">Total prestado seleccionando rango</a>';

      echo '</td>'; 

	  echo '</tr>';

      echo '</table>';

      echo "<br>"; 

     echo "<br>"; 

      // TABLA OPCIONES   

echo '<table class="tabencabezado" style="margin: 0 auto;">';

echo '<tr><th colspan="3">Otras Opciones</th> </tr>';	



//1 FILA

	echo '<tr>';

      echo '<td>';

     echo '<a href="Lobby_micro.php">Ir a Lobby</a>';

      echo '</td>';  

	  

      echo '<td>';

	   echo '<a href="Form_buscar_clientes_web_micro.php">Buscar clientes</a>';

      echo '</td>'; 

      echo '</tr>';
      echo '<tr>';
      echo '<td colspan="2">';

      echo '<a href="Form_lista_cobrado_superusuario.php?cobro='.$_REQUEST['Cobro'].'&asesor='.$asesorx.'">Lista cobrandoApp</a>';;

      echo '</td>';
      echo '</tr>';
     echo '</table>';

     echo "<br>"; 

     echo "<br>";

?>

</body>

</html>