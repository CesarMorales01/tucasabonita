<html> 
<head> 
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Cuadrando Caja</title> 
</head> 
<body>
<?php 
echo $estilos;
if(isset($_REQUEST['Cobro'])){
   $Cobro1=$_REQUEST['Cobro'];
	$Cobro="'".$Cobro1."'";
} 
$total_caja=null;
echo '<br>';
echo '  <h1>Caja '.$Cobro1.'</h1>'; 
include("datos.php");
echo '<form method="post" id="form_nuevo_registro" action="nuevo_ingreso.php">';
echo '<input type="hidden" id="cobro" name="Cobro" value="'.$Cobro1.'">';
echo '<input type="hidden" id="total_caja" name="total_caja" >'; 
echo '<br>';   
echo '<input type="checkbox" name="ifcaja" value="concaja" > Tener en cuenta valor de caja anterior.';
echo '<br>';
echo '<input class="botonsubmit" type="submit" value="Realizar nuevo ingreso">';
echo '</form>';
echo '<a href="Form_Cuadrar_cuentas.php">Ir a cuadrar cuentas</a>';
echo '<br>';
echo '<br>';

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos"); 
$registros=$mysql->query("select * from caja where Cobro=$Cobro order by fecha desc") or die ("problemas en la consulta");

//TABLA CONSULTAR HISTORIAL CAJA
echo '<table class="tablalistado1"style="margin: 0 auto;">';
echo '<tr><th>Fecha</th><th>Ingresos</th><th>Otros ingresos</th><th>Observaciones</th><th>Total ingresos</th>';
echo '<th>Prestado</th><th>Gastos</th><th>Observaciones</th><th>Total Egresos</th><th>Ingresos netos</th><th>Total caja</th><th>Ingresado por</th>';
echo '<th>Eliminar todo?';
echo '<input type="checkbox" onClick="selectAlls(this)"/>';
echo '</th></tr>';
echo '<form method="post" id"form_eliminar" action="alerta_eliminar_caja.php">';
    while ($reg=$registros->fetch_array()) {
		
	  $id=$reg['id'];

      echo '<tr>';

      echo '<td>';
      echo $reg['fecha'];

      echo '</td>';      

      echo '<td>';

      echo number_format($reg['cobrado'],2,",",".");

      echo '</td>';   
      
      echo '<td>';    
      echo $reg['otros_ingresos'];
      echo '</td>'; 
	  echo '<td>';
	
      echo $reg['comentario_ingresos'];      

      echo '</td>'; 
      
      echo '<td>';
      
      echo number_format($reg['total_ingresos'],2,",",".");

      echo '</td>';
   
      echo '<td>';

      echo number_format($reg['prestado'],2,",",".");      

      echo '</td>';
      
      echo '<td>';
      
      echo number_format($reg['otros_gastos'],2,",",".");      

      echo '</td>';
	  
	  echo '<td>';
        
      echo $reg['comentario_egresos'];     

      echo '</td>';
      
      echo '<td>';
        
      echo number_format($reg['total_egresos'],2,",",".");     

      echo '</td>';
      
      echo '<td>';
      echo number_format($reg['entradas_neto'],2,",",".");      
      echo '</td>';
      
	    echo '<td>';
      echo number_format($reg['total_caja'],2,",",".");     
      echo '</td>';
	  
	    echo '<td>';
	    echo $reg['asesor'];    
      echo '</td>';

      echo '<td>';
      echo '<input type="checkbox" name="ids[]" value="'.$reg['id'].'"/>';
      echo '<input type="hidden" name="Cobro" value="'.$Cobro1.'"/>';
      echo '<input type="submit" style="background-color:red" value="Eliminar seleccionados">';   
      echo '</td>';  
      echo '</td>';
      echo '</tr>';      

    } 
echo '</form>';   
echo '</table>'; 
//  TOTAL CAJA DE ULTIMA FECHA
$get_total_caja=$mysql->query("select total_caja from caja where Cobro=$Cobro") or die ("problemas en la consultar total caja");
$total_caja;
while ($caj=$get_total_caja->fetch_array()) {
  $total_caja=$caj['total_caja'];
}
if($total_caja==null){
  echo 'No se han encontrado registros. Puedes ir a "Realizar nuevo registro" para efectuar el primer registro.';
  $total_caja=0;
}

//CONSULTAR NUMERO DE FILAS EN LA TABLA CAJA
$n_registros=mysqli_num_rows($registros);
 
 // CONSULTAR INGRESO MAS ANTIGUO PARA ELIMINARLO
 
$check_ufecha=$mysql->query("select min(id) from caja where Cobro=$Cobro") or die ("check_ufecha");

 if($get_ufecha=$check_ufecha->fetch_array()){
 $ufecha=$get_ufecha['min(id)'];  
 }
 

 if($n_registros>31){
$borrar_uid=$mysql->query("delete from caja where id=$ufecha") or die ("Problemas borrar primera fila");
 }
echo '<br>';
echo '<br>';
?> 
<script>
window.addEventListener('load', inicializar, false);

function inicializar() {
	document.getElementById("form_nuevo_registro").addEventListener('submit', validar, false);
}

function validar(evt) {
     var total_caja=document.getElementById('total_caja');
     total_caja.value="<?php echo $total_caja; ?>";
}

function selectAlls(source) {
  checkboxes = document.getElementsByName('ids[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;	
  }
}
</script>
</body>
</html>