<!doctype html>
<html> 
<head> 
<title>Detalle de cuenta</title> 
<meta charset="UTF-8">
 <link rel="StyleSheet" href="estilos.php" type="text/css">
</head> 
<body >
<?php
session_start();
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
if (isset($_SESSION['ced'])){
 $usuario=$_SESSION['usuario'];
 $cliente=$_SESSION['ced'];
 $cedula=$_SESSION['ced'];
 $fecha_prest=$_SESSION['fecha_prest'];
 $valor_compra=$_SESSION['abono_neto'];
	if($cedula==""){
		header("Location: https://tucasabonita.site"); 
	 }
}else{
	header("Location: https://tucasabonita.site");
}	
 if(isset($_REQUEST['id'])){
	$id_trans=$_REQUEST['id'];	
	$query_string="select * from crear_clave where cedula=$cliente";
	$get_i=$mysql->query($query_string) or die ("problemas en la consulta cliente");
	if($get_id=$get_i->fetch_array()){
		$_SESSION['cedula']=$get_id['id'];
	}
}

// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");

echo '<br>';
echo '<div class"container">';
echo '<h2 style="text-align: center;">'.$usuario.' nos agrada que nos visites! </h2>';
echo '<br>';
$registros_cre=$mysql->query("select * from creditos_casa_bonita where cedula=$cliente") or die ("probl");

while($reg_cre=$registros_cre->fetch_array()){
	$creditos_x_fechas[]=$reg_cre['fecha_prest'];
}
if(isset($_REQUEST['fecha_prest'])){
	$fecha_prest=$_REQUEST['fecha_prest'];
}


if($fecha_prest==""){
	$fecha_credito="'".$creditos_x_fechas[0]."'";
	$registros1=$mysql->query("select * from creditos_casa_bonita where cedula=$cliente and fecha_prest=$fecha_credito") or die ("probl");
}else{
	$fecha_credito="'".$fecha_prest."'";
	$registros1=$mysql->query("select * from creditos_casa_bonita where cedula=$cliente and fecha_prest=$fecha_credito") or die ("probl");
}

$reg1=$registros1->fetch_array();
$compara=$reg1['vencimiento'];
$saldo=$reg1['tt_saldo'];

$fecha_venci_comi="'".$compara."'";

date_default_timezone_set('America/Bogota');

$get_fecha=date("Y-m-d");
// datos para registro wompi
$get_fecha_hora=date("Y-m-d h:i:s A");
$cobro=$reg1['Cobro'];
$fecha_hoy_comi="'".$get_fecha."'";

$checksivenci=$mysql->query("SELECT datediff($fecha_venci_comi, $fecha_hoy_comi) as difer");

$obt=$checksivenci->fetch_array();	

$obt0= $obt['difer'];
if ($obt0<0){
 echo '<h1>Estimado cliente tu credito ha vencido el '.$compara.'</h1>';  
 echo '<br>';
} 
echo '<table class="tablalistado1" style="margin: 0 auto;" >'; 
echo '<tr><th colspan="4">Estos son los detalles de tu cuenta </th> </tr>';	
	

	  echo '<tr>';
	  echo '<td>';

      echo "Fecha de crédito";

      echo '</td>';  

	  

      echo '<td>';
	 $fecha_credito_sin_comi=$reg1['fecha_prest'];	
      echo $reg1['fecha_prest'];

      echo '</td>'; 

	
	  

	   
	  echo '<td>';

      echo "Valor del crédito";

      echo '</td>';  

	  

      echo '<td>';

	  echo number_format($reg1['valorprestamo'],2,",",".");

      echo '</td>'; 

	  echo '</tr>';
	     
	 echo '<tr>';
	  echo '<td>';

      echo "Para pagar en";

      echo '</td>';  

	  

      echo '<td>';

      echo $reg1['tiempo_meses'];
	  echo " meses";

      echo '</td>'; 
      
	  echo '<td>';

      echo "Frecuencia de pago";

      echo '</td>';  

	  

      echo '<td>';

      echo $reg1['periodicidad'];

      echo '</td>'; 

      echo '</tr>';

      
	  echo '<tr>';
	  echo '<td>';

      echo "Numero cuotas";

      echo '</td>';  
   
     echo '<td>';

      echo $reg1['n_cuotas'];

      echo '</td>'; 
	  echo '<td>';
      echo "Valor de las cuotas";

      echo '</td>';  

	  

      echo '<td>';

	  echo number_format($reg1['valor_cuotas'],2,",",".");

      echo '</td>'; 
	  
	  echo '</tr>';
	
	  echo '<tr>';
	  
	 echo '</tr>';
    

    
	  echo '<tr>';
      echo '<td  > ';

      echo "Vencimiento";

      echo '</td>'; 

    

      echo '<td>';

      echo $reg1['vencimiento'];

      echo '</td>'; 

	   echo '<td>';

     echo "Cuotas en mora";

     echo '</td>';

     echo '<td>';
/*
     if($reg1['tt_saldo']>0){

      $calc_dias_hastahoy=calc_dias_hastahoy($reg1['fecha_prest']);

      $periodicidad=check_periodicidad($reg1['periodicidad']);

      $calcular_cuotas_enmora=calcular_cuotas_enmora($periodicidad, $calc_dias_hastahoy, $reg1['tt_abonos'], $reg1['valor_cuotas'], $reg1['n_cuotas']);
    
     echo number_format($calcular_cuotas_enmora,2,",",".");     

     }else{

      echo "";  

     }
*/	 
     echo '</td>';
	

	 echo '</tr>';

	
	 echo '<tr>';
	 echo '<td>';

     echo "Total abonos";

     echo '</td>';  

	  

     echo '<td>';

	 echo number_format($reg1['tt_abonos'],2,",",".");

     echo '</td>'; 
	
    echo '<td>';

     echo "Saldo";

     echo '</td>';	  
	echo '<td>';
	echo number_format($reg1['tt_saldo'],2,",",".");
    echo '</td>';
	
	echo '</tr>';
	echo '<td>';
	echo "Productos:";
    echo '</td>';
	echo '<td colspan="3">';
	$get_n_c=$mysql->query("select * from lista_compras where cliente=$cliente and fecha=$fecha_credito") or die ("problemas al consultar n");
	if($n_comp=$get_n_c->fetch_array()){
		$n_compra=$n_comp['compra_n'];;
	}
	$get_p=$mysql->query("select * from lista_productos_comprados where cliente=$cliente and compra_n=$n_compra") or die ("problemas al consultar productos");
	echo '<div style="width: 520px; height: 80px;" class="scroll_1casilla">';
	while($prod=$get_p->fetch_array()){
		echo  "- ".$prod['producto']." x ".$prod['cantidad'].".";
		echo '<br>';
	}
	 echo '</div>';
echo '</td>';



echo '<tr>';
   echo '<td >';
   echo "Otros créditos";    
   echo '</td>';

   echo '<td colspan="3">';
   echo '<div style="width: 520px; height: 120px;" class="scroll_1casilla">'; 
   // Consultar otros creditos
   $credits=$mysql->query("select * from creditos_casa_bonita where cedula=$cliente order by fecha_prest desc") or die ("problemas al consultar creditos");
   while($cre=$credits->fetch_array()){
	   $array_fechas_creditos[]=$cre['fecha_prest'];
	   $fecha_cred_comi="'".$cre['fecha_prest']."'";
	   $get_art=$mysql->query("select compra_n from lista_compras where cliente=$cliente and fecha=$fecha_cred_comi") or die ("problemas al consultar creditos compra n");
	   while($fec=$get_art->fetch_array()){
		    $n_c=$fec['compra_n'];
		    $get_arts=$mysql->query("select producto from lista_productos_comprados where cliente=$cliente and compra_n=$n_c") or die ("problemas al consultar creditos productos compra n");
			   while($aaa=$get_arts->fetch_array()){
				  $get_articulos[]=$aaa['producto'];  
			   }
	   }
   }
   
   
   for($y=0;$y<count($array_fechas_creditos);$y++){
	    echo '<a href="check_out_credito_from_app.php?fecha_prest=';
        echo $array_fechas_creditos[$y];
        echo '">';
        echo '<i class="fas fa-cart-arrow-down"></i>';
        echo "   ";
        echo  $array_fechas_creditos[$y];
		echo " :";
		echo $get_articulos[$y];
        echo '</a>';
		echo '<br>';
		echo '<hr>';
   }   
   echo '</div>'; 
   echo '</td>';





echo '</tr>';
echo '</table>';
echo  "<br>";

    $registros2=$mysql->query("select * from abonos_creditos_casa_bonita where cedula=$cliente and fecha_prest=$fecha_credito order by fecha asc") or die ("problemas en la consulta");	
   $n_registros=mysqli_num_rows($registros2);
    // TABLA ABONOS	
	$size_scroll="100";
	$cal_size=$size_scroll*$n_registros;
    echo  "<br>";
	
	if($cal_size>350){
	echo '<div style="height: 350px;" class="scroll_index">';
	} else {
    echo '<div style="height: '.$cal_size.'px;" class="scroll_index">';
    }	
  
    echo '<table class="tablalistado1" style="margin: 0 auto">';
	
    echo '<tr ><th>Fecha</th><th>Valor abono</th><th>Cuota N°</th><th>Cobrado por</th></tr>';	

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

	 echo '</tr>';	
	 	
	 }  
	
  	 echo '</table>';
 echo '</div>';
?>
<!--- dialogo pago negado -->
<a class="nav-link" style="color:white; padding-left:30px; padding-right:30px; cursor:pointer;" data-toggle="modal" id="dialogo_error_pago" data-target="#dialogo1"></a>
			  <!-- INICIO DIALOGO NUEVO REGISTRO --> 
					<div class="modal fade" id="dialogo1">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <!-- cuerpo del diálogo -->
							  <div class="modal-body">
								Lo sentimos. Algo ha salido mal con tu pago!
							  </div>
						  <!-- pie del diálogo -->
						<div class="row justify-content-around"> 
							<button type="button" data-dismiss="modal" style="background-color:#228b22;">Aceptar</button>
						</div> 
						<br>	<br>	
						</div>
					  </div>
					</div>
 <!-- FIN DIALOGO -->
<script src="functions.php"></script>
<script>
check_id_trans();
var id_trans, fecha, valor_compra, estado_trans, cliente, ref, fecha_credito;
function check_id_trans() {
  id_trans="<?php echo $id_trans;?>";
  if(id_trans==""){}else{
		 var uri='https://production.wompi.co/v1/transactions/'+id_trans;
		 $.getJSON(uri, function(datos) {
			    var arreglo = JSON.stringify(datos.data);
				var datas=JSON.parse(arreglo);
				fecha=datas.created_at;
				valor_compra="<?php echo $valor_compra;?>";
				estado_trans=datas.status;
				ref=datas.reference;
				cliente="<?php echo $cliente;?>";
				fecha_credito="<?php echo $fecha_credito_sin_comi;?>";
				if(estado_trans=="APPROVED"){
					actualizar_wompi_credito(); 
				 }else{
					dialogo_error_pago();
				}
			});
	 } 	 
}

var conexion1;
function actualizar_wompi_credito() {
  conexion1=new XMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos;
  conexion1.open('POST','actualizar_wompi_and_credito.php', true);
  conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  conexion1.send(cargarDatos());  
}
function cargarDatos(){
	var cadena='id_trans='+encodeURIComponent(id_trans)+'&cliente='+encodeURIComponent(cliente)+'&valor_compra='+encodeURIComponent(valor_compra)+'&fecha='+encodeURIComponent(fecha)+'&estado='+encodeURIComponent(estado_trans)+'&ref='+encodeURIComponent(ref)+'&fecha_credito='+encodeURIComponent(fecha_credito);
	return cadena;
}
function procesarEventos(){
  if(conexion1.readyState == 4){  
    var dato=conexion1.responseText;
	if(dato.trim()=="updated"){
		location.href ="https://tucasabonita.site/check_out_credito_from_app.php";
	}
  }
}

function dialogo_error_pago(){
	document.getElementById('dialogo_error_pago').click();
}
</script>
</body> 
</html>