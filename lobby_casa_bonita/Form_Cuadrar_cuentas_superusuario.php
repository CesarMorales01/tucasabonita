<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
include("datos.php");
 //  CONFIRMAR INICIO DE SESION             
if(isset($_COOKIE['cobrador'])){
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
} 
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");  
// consultado propiedades de estilos
$getStyles=$mysql->query("SELECT * FROM settings") or die ("problemas en la consulta styles");
$get_settings0=$getStyles->fetch_array();
?>
<!DOCTYPE html>
<html>

<!DOCTYPE html>
<html>

<head>
 <script src="Chart.min.js"></script>
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

  <title>Cuadrar cuentas</title>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
</head>   
<body>
<body>
<br>
<div style="display: flex; align-items: center; justify-content: center; width: 650px; margin: 0 auto;"  class="container">
  <div class="row ">
    <nav style="background-color:<?php echo $get_settings0['btituloTres']; ?>"  class="navbar navbar-expand-md">
      <div class="col-xl-3">
        <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="Lobby_superusuario.php"> <i class="fas fa-home"></i>  Lobby</a>
      </div>
      <div class="col-xl-3">
        <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="Form_buscar_clientes_web_superusuario.php"> <i class="fas fa-search"></i>  Buscar clientes</a>
      </div>
      <div class="col-xl-3">
        <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="#tema2"> <i class="fas fa-file-invoice-dollar"></i>  Totales</a>
      </div>
      <div class="col-xl-3">
      <a class="navbar-brand" style="color:black; padding-left:30px; padding-right:30px;" href="Cerrar_sesion.php"><i class="fas fa-lock"></i>  Salir</a>
      </div>
    </nav> 
  </div>
</div>
<br>

<?php

if(isset($_REQUEST['notificacion'])){
	echo $_REQUEST['notificacion'];
}
echo '<div style="width: 650px; text-align:center; margin: 0 auto;" class="container">';
// FORM FILTRAR CARTERA 
echo '<form method="post" action="Form_Cuadrar_cuentas_cobrox_superusuario.php">'; 
  
echo '<select name="Cobro">'; 

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
   $nombres1[$x]=trim($nombres[$x]);
}

for($x=1;$x<=$size_array;$x++){
   echo "<option value='".$nombres[$x]."'>".$nombres[$x]."</option>";
}      
echo '</select>';
echo '<input  class="botonsubmit" type="submit" value="Filtrar">'; 
echo '</form>';
if($nombres[1]!=null){
  $Cobro1=$nombres[1];  
}
//ESTABLECER CARTERA PREDETERMINADA
echo '<form method="post" action="Form_cartera_prede_superusuario.php">';
$xcomparar=$Cobro1;
$GET_CARTE_PREDE=$mysql->query("select variable from cartera_prede where asesor=$revisar_sesion_comis") or die ("problemas al consutar cartera prede");
if($get_prede=$GET_CARTE_PREDE->fetch_array()){
      if (in_array($get_prede['variable'], $nombres1)) {
         $Cobro1=$get_prede['variable']; 
             if($xcomparar==$Cobro1){
             echo '<input type="hidden" value='.$revisar_sesion.' name="asesor">';
             echo '<input type="hidden" value='.$Cobro1.' name="cartera">';
             echo '<input  class="botonsubmit" type="submit" value="'.$Cobro1.' establecida como cartera predeterminada">';  
            } else {
             echo '<input type="hidden" value='.$revisar_sesion.' name="asesor">';
             echo '<input type="hidden" value='.$xcomparar.' name="cartera">';    
             echo '<input  class="botonsubmit" type="submit" value="Establecer '.$xcomparar.' como cartera predeterminada">';   
            }
        } else {
           echo '<input type="hidden" value='.$revisar_sesion.' name="asesor">';
         echo '<input type="hidden" value='.$xcomparar.' name="cartera">';    
         echo '<input  class="botonsubmit" type="submit" value="Establecer '.$xcomparar.' como cartera predeterminada">';  
        }
    
} else {
   echo '<input type="hidden" value='.$revisar_sesion.' name="asesor">';
   echo '<input type="hidden" value='.$xcomparar.' name="cartera">';    
   echo '<input  class="botonsubmit" type="submit" value="Establecer '.$xcomparar.' como cartera predeterminada">'; 
}


echo '</form>';
echo '<br>';
echo '<h1>Cuadrando cuentas '.$Cobro1.'</h1>';
$Cobro="'".$Cobro1."'";
// fin div titulo cuadrando cuentas
echo '</div>';

if ($mysql->connect_error) die ("Problemas con la conexión a la base de datos");

$registros0=$mysql->query("SELECT sum(valor_abono) as todo FROM abonos where Cobro=$Cobro and fingreso=$get_global_fecha_hoy") or die ("problemas en la consulta0");

$reg0=$registros0->fetch_array(); 

// TABLA INGRESOS - EGRESOS   
echo '<div style="width: 650px; margin: 0 auto;" class="container">';
echo '<table class="tabencabezado" style="margin: 0 auto;">';

echo '<tr><th style="text-align:center;" >Ingresos</th> <th style="text-align:center;">Egresos</th> </tr>';	



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
 
     echo '<a href="Cuadrar_caja_superusuario.php?Cobro='.$Cobro1.'">Caja</a>';

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
 // fin div tabla ingresos y egresos
 echo '</div>';
      echo "<br>"; 

     echo "<br>"; 
     echo '<div style="width: 650px; margin: 0 auto;" class"container">';
     // BLOQUE A LA IZQUIERDA
     echo '<div class="row justify-content-center">';
     echo '<div class="col-5">';
      // TABLA OPCIONES   
echo '<table class="tabencabezado" style="margin: 0 auto;">';

echo '<tr><th style="text-align:center;" colspan="2">Otras Opciones</th> </tr>';	

//1 FILA

	echo '<tr>';

      	echo '<tr>';

      echo '<td>';

      echo '<a href="Cuentas_canceladas_hoy_superusuario.php?Cobro='.$Cobro.'">Cuentas canceladas hoy</a>';

      echo '</td>'; 
      
       echo '<td>';

       echo '<a href="Form_lista_cobrado_superusuario.php?cobro='.$Cobro1.'&asesor='.$asesorx.'">Lista cobrandoApp</a>';

      echo '</td>'; 

      echo '</tr>';

     echo '</table>';

     echo "<br>"; 

     echo '</div>'; 
     // BLOQUE DERECHA	  
     echo '<div <div class="col-5" >';	 
        // Grafico totales
     echo '<div id="chart_div"></div>';	 
     echo '</div>';
   echo '</div>'; 
   echo '</div>'; 

    

  // TABLA TOTALES

  echo '<A Name="tema2"></a>';
 // TABLA TOTALES
 echo '<div style="display: flex; align-items: center; justify-content: center; width: 650px; margin: 0 auto;"  id="divTotales">'; 
 echo '<table class="tablalistado">';
 echo '<tr><th colspan="8">TOTALES</th>';
 echo '</tr>';	
 echo '<tr><th>PERIODO</th> <th>TOTAL CUENTAS</th> <th>TOTAL ABONOS</th><th>%</th> <th>TOTAL SALDOS</th><th>%</th><th> <a href="Fechax_clientes_enmora_superusuario.php?Cobro='.$Cobro.'&fecha='.$get_global_fecha_hoy_comis.'">TOTAL CARTERA EN MORA</a></th><th>%</th></tr>';
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
$total_abonos_grafico=$get_total_cobrado['sum(tt_abonos)'];
  echo '</td>';

   echo '<td>';
$abonos_actual_p=($get_total_cobrado['sum(tt_abonos)']*100)/$get_total_cobrado['sum(totalapagar)'];
echo round($abonos_actual_p,2);
echo "%";

  echo '</td>';		

  echo '<td>';

echo number_format($get_total_cobrado['sum(tt_saldo)'],2,",",".");
 $total_saldos_grafico=$get_total_cobrado['sum(tt_saldo)'];

  echo '</td>'; 

 echo '<td>';
$saldos_actual_p=($get_total_cobrado['sum(tt_saldo)']*100)/$get_total_cobrado['sum(totalapagar)'];
echo round($saldos_actual_p,2);
echo "%";

  echo '</td>';	
  
// TOTAL CARTERA EN MORA   A FECHA DE HOY   
$consultar_cartera_enmora=$mysql->query("SELECT  sum(tt_saldo)  FROM `prestamos` where vencimiento < $get_global_fecha_hoy and Cobro=$Cobro") or die("problemas al consultar cartera en mora");      
$get_cartera_enmora=$consultar_cartera_enmora->fetch_array();      
  echo '<td>';

echo number_format($get_cartera_enmora['sum(tt_saldo)'],2,",",".");

  echo '</td>';

echo '<td>';
$mora_actual_p=($get_cartera_enmora['sum(tt_saldo)']*100)/$get_total_cobrado['sum(totalapagar)'];
echo round($mora_actual_p,2);
echo "%";

  echo '</td>';
  echo '</tr>';
  
// CARGAR TOTALES GUARDADOS
$consultar_totales_saved=$mysql->query("SELECT * FROM totales where Cobro=$Cobro ORDER by Mes DESC" ) or die ("problemas en consultar totales saved");
$totalesCuentasArray=[];
$totalesSaldosArray=[];
$totalesAbonosArray=[];
$totalesMoraArray=[];
$totalesFechasArray=[];
while($get_totales_saved=$consultar_totales_saved->fetch_array()){
$totalesFechasArray[]=$get_totales_saved['Mes'];
$totalesCuentasArray[]=$get_totales_saved['Total_cuentas'];
$totalesSaldosArray[]=$get_totales_saved['Total_saldos'];
$totalesAbonosArray[]=$get_totales_saved['Total_abonos'];
$totalesMoraArray[]=$get_totales_saved['cartera_mora'];
} 
$arrayLenght=count($totalesMoraArray);
$reps;
if($arrayLenght<3){
$reps=$arrayLenght;
}else{
 $reps="3";
}  
for($s=0;$s<$reps;$s++){
echo '<tr>';
echo '<td>';
echo $totalesFechasArray[$s];
echo '</td>';
echo '<td>';
echo number_format($totalesCuentasArray[$s],2,",",".");
echo '</td>';
echo '<td>';
echo number_format( $totalesAbonosArray[$s],2,",",".");
echo '</td>';
echo '<td>';
$abonos_p=($totalesAbonosArray[$s]*100)/$totalesCuentasArray[$s];
echo round($abonos_p,2);
echo "%";
echo '</td>';
echo '<td>';
echo number_format( $totalesSaldosArray[$s],2,",",".");
echo '</td>';
echo '<td>';
$saldos_p=($totalesSaldosArray[$s]*100)/$totalesCuentasArray[$s];
echo round($saldos_p,2);
echo "%";
echo '</td>';
echo '<td>';
echo number_format( $totalesMoraArray[$s],2,",",".");
echo '</td>';
echo '<td>';
$mora_p=($totalesMoraArray[$s]*100)/$totalesCuentasArray[$s];
echo round($mora_p,2);
echo "%";
echo '</td>';
echo '</tr>';

}
echo '</table>';
// fin tabla totales
echo '</div>';	  
echo '<br>';
echo '<br>';
echo '<div style="width: 650px; margin: 0 auto;" class="container">';
echo '<div class="row justify-content-center" >';
    echo '<div class="col-2">';
    echo '<a style="left:14px; bottom:33px;" href="#" ><img height="40" src="Imagenes/flecha_verde.jpg" title="Ir a inicio de pagina." /> </a>';
    echo '</div>';
    echo '<div class="col-8">';
    echo '<h2>Comportamiento totales ultimos 6 meses </h2>';
    echo '</div>';
echo '</div>';
echo '</div>';	  
echo '<br>';
echo '<br>';

$consultar_totales_ultimo_cuadre=$mysql->query("SELECT * FROM totales where Cobro=$Cobro ORDER by Id DESC LIMIT 6") or die ("problemas en consultar totales");
$totalCuentas= array();
$totalAbonos=array();
$totalSaldos=array();
$carteMora=array();
$fechas=array();
while($get_totales=$consultar_totales_ultimo_cuadre->fetch_array()){
$fechas[]=$get_totales['Mes'];
$totalCuentas[]=$get_totales['Total_cuentas'];
$totalAbonos[]=$get_totales['Total_abonos'];
$totalSaldos[]=$get_totales['Total_saldos'];
$carteMora[]=$get_totales['cartera_mora'];
}

$longitud = count($totalCuentas);
// GRAFICO Comportamiento totales ultimo año
?>
<div class="container">
<canvas id="chart1" width="800" height="200" ></canvas> 
</div>
<script>			
var ctx = document.getElementById("chart1");
// MUESTRA LA LEYENDA AL PASAR EL MOUSE
Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var data = {
    labels: [
<?php  for($i=$longitud-1; $i>=0; $i--) { ?>
"<?php echo $fechas[$i]; ?>",
<?php } ?>
],
    datasets: [{
        label: 'Total cuentas',
        data: [
  <?php  for($i=$longitud-1; $i>=0; $i--) { ?>
   <?php echo $totalCuentas[$i]; ?> ,
   <?php } ?>
   
  ],
  // background para colorear el fondo debajo de la linea.
      //  backgroundColor: "#eeeeee",
        borderColor: "#417dc1",
        borderWidth: 4,
  fill: false,
  pointBorderColor: 'blue',
  pointBackgroundColor: 'rgba(255,150,0,0.1)',
  pointRadius: 5,
  pointHoverRadius: 10,
  pointHitRadius: 30,
  pointBorderWidth: 4,
  pointStyle: 'rectRounded',
  
  // borderdash para linea puntuada.
  // borderDash: [5, 5]
    },
{
label: 'Total abonos',
        data: [
  <?php  for($i=$longitud-1; $i>=0; $i--) { ?>
   <?php echo $totalAbonos[$i]; ?> ,
   <?php } ?>
  ],
      //  backgroundColor: "#3898db",
        borderColor: "#9b59b6",
        borderWidth: 4,
  fill: false,
  pointBorderColor: 'purple',
  pointBackgroundColor: 'rgba(255,150,0,0.1)',
  pointRadius: 5,
  pointHoverRadius: 10,
  pointHitRadius: 30,
  pointBorderWidth: 4,
  pointStyle: 'rectRounded',
},
{
label: 'Total saldos',
        data: [
  <?php  for($i=$longitud-1; $i>=0; $i--) { ?>
   <?php echo $totalSaldos[$i]; ?> ,
   <?php } ?>
  ],
      //  backgroundColor: "#008f39",
        borderColor: "#008f39",
        borderWidth: 4,
  fill: false,
  pointBorderColor: 'green',
  pointBackgroundColor: 'rgba(255,150,0,0.1)',
  pointRadius: 5,
  pointHoverRadius: 10,
  pointHitRadius: 30,
  pointBorderWidth: 4,
  pointStyle: 'rectRounded',
    },
{
label: 'Total cartera en mora',
        data: [
  <?php  for($i=$longitud-1; $i>=0; $i--) { ?>
   <?php echo $carteMora[$i]; ?> ,
   <?php } ?>
  ],
      //  backgroundColor: "#ff0000",
        borderColor: "#ff0000",
        borderWidth: 4,
  fill: false,
  pointBorderColor: 'red',
  pointBackgroundColor: 'rgba(255,150,0,0.1)',
  pointRadius: 5,
  pointHoverRadius: 10,
  pointHitRadius: 30,
  pointBorderWidth: 4,
  pointStyle: 'rectRounded',
    }
]
};

var options = {
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero:true
            }
        }]
    }
};

var chart1 = new Chart(ctx, {
type: 'line',
data: data,
options: options
});
// Poner clase scroll en pantallas pequeñas
let x = $(document);
x.ready(ponerClase);
function ponerClase(){
var tamañoPant= screen.width;
let x = $("#divTotales");
if(tamañoPant<450){
  x.addClass("scrollTablaTotalesSuperUsuario"); 
  x.css('display','block');
  document.getElementById("chart1").style.marginLeft = "80px";
}else{
  x.addClass("container");
}
}
</script>
<?php
// FIN DE GRAFICO TOTALES.........

//CONSULTANDO NUMERO DE CLIENTES
$consultar_nclientes=$mysql->query("select count(*) from clientes where Cobro=$Cobro") or die ("problemas en consultar nclientes");
$get_nclientes=$consultar_nclientes->fetch_array();	

$consultar_nclientes_prest=$mysql->query("select count(*) from prestamos where Cobro=$Cobro") or die ("problemas en consultar nclientes");
$get_nclientes_prest=$consultar_nclientes_prest->fetch_array();
$nclientes_sinsaldo=$get_nclientes['count(*)']-$get_nclientes_prest['count(*)']; 
// DIV PARA ESTABLECER SCROLL           
echo '<div style="overflow:scroll;width: 650px; height: 260px;margin: 0 auto;">';      
echo '<table  id="tablaClientes" class="tabencabezado" style="margin: 0 auto;">';
echo '<br><br>';
echo '<tr><th>PERIODO</th><th style="text-align:center;">TOTAL CLIENTES</th><th style="text-align:center;"><a href="Clientes_con_prestamo_superusuario.php?Cobro='.$Cobro.'">TOTAL PRESTAMOS</a></th><th style="text-align:center;"><a href="Clientes_sin_saldo_superusuario.php?Cobro='.$Cobro.'">CLIENTES SIN SALDO</a></th></tr>';
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

$consultar_totales_ultimo_cuadre1=$mysql->query("SELECT * FROM totales where Cobro=$Cobro order by Mes DESC") or die ("problemas en consultar totales1");

while($get_totales1=$consultar_totales_ultimo_cuadre1->fetch_array()){
echo '<tr>'; 
echo '<td >';
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
echo '</div>';	 
?>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">

  // Load the Visualization API and the piechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table, 
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

  // Create the data table.
  var data = new google.visualization.DataTable();
var abonos="<?PHP echo $total_abonos_grafico;?>";
var saldos="<?PHP echo $total_saldos_grafico;?>";
  data.addColumn('string', 'Topping');
  data.addColumn('number', 'Slices');
  data.addRows([
    ['Total abonos', parseInt(abonos)],
    ['Total saldos', parseInt(saldos)],
  ]);

  // Set chart options
  var options = {'title':'Actual',
                 'width':300,
                 'height':250};

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}	
</script>
</body>
</html>