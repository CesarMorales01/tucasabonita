<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">
   <script src="funciones.js"></script> 

  <title>Nuevo ingreso a caja</title> 

  </head>  

<?php 
$Cobro1=$_REQUEST['Cobro'];
$Cobro="'".$Cobro1."'";
   $tota1_caja1=$_REQUEST['total_caja'];
if(isset($_REQUEST['ifcaja'])){
	$checkcaja="sicaja";
	echo '<body onLoad="checkifcaja()">';
}else {
	 $checkcaja="nocaja";
	echo '<body onLoad="checkifcaja()">';
}
include("datos.php");
$set_fecha=date("Y-m-d H:i:s");
echo '<h1>Realizar ingreso en caja '.$Cobro1.'</h1>';	

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
     
$registros0=$mysql->query("SELECT sum(valor_abono) as todo FROM abonos_creditos_casa_bonita where fingreso=$get_global_fecha_hoy") or die ("problemas en la consulta0");
$get_total_cobrado=$registros0->fetch_array();
$Cobrado_dia=$get_total_cobrado['todo'];    
	  
$consultar_total_prestado=$mysql->query("SELECT sum(valorprestamo) as total_prestado_dia FROM creditos_casa_bonita where fecha_prest=$get_global_fecha_hoy") or die ("problemas en consultar total prestado");
$get_total_prestado=$consultar_total_prestado->fetch_array();
$Prestado_dia=$get_total_prestado['total_prestado_dia'];  	  
echo '<table class="tablalistado1"style="margin: 0 auto;">';
echo '<tr><th>Fecha</th><th>Cobrado</th><th>Otros ingresos</th><th>Observaciones</th><th>Total ingresos</th>
<th>Prestado</th><th>Gastos</th><th>Observaciones</th><th>Total Egresos</th><th>Ingresos netos</th><th>Total caja</th></tr>';	
?>	
		
<!– TABLA NUEVOS DATOS PARA CAJA

<br></br>    
<form method="post" action="Actualizar_caja.php">

    <tr> 
        <td>
         <input type="text" name="Fecha" size="7" value="<?PHP echo $set_fecha;?>">   
        </td>
		<input type="hidden" name="Cobro" value="<?PHP echo $Cobro;?>">  
        <td>
         <input type="text" id="Ingresos" onChange="operacion_online()" name="Ingresos" size="7" value="<?PHP echo number_format($Cobrado_dia,2,",",".");?>">   
        </td>
        
		<td>
         <input type="text" id="Otros_ingresos" onChange="operacion_online()" name="Otro_ingresos" size="7">   
        </td>
        <td>
         <textarea name="Observaciones_I" rows="1" cols="8"></textarea>   
        </td>
        
        <td>
         <input type="text" name="Total_ingresos" size="7" id="Total_ingresos" >   
        </td>
        
        <td>
		<input type="text" name="Prestado" onChange="operacion_online()" size="7" id="Prestado" onChange="sumar_egresos()" value="<?PHP echo number_format($Prestado_dia,2,",",".");?>">		 
        </td>
		
		<td>
		<input type="text" name="Gastos" id="Gastos" onChange="operacion_online()" size="5" ">		 
        </td>
		
		<td>
         <textarea name="Observaciones_E" rows="1" cols="8"></textarea>   
        </td>
        
        <td>
         <input type="text" name="Total_egresos" id="Total_egresos" size="5">   
        </td>
		
		<td>
        <input type="text" name="Ingresos_netos" id="Ingresos_netos" size="5" ">   
        </td>
        
         <td>
        <input type="text" name="Total_caja" size="7" id="Total_caja" value="<?PHP echo number_format($_REQUEST['total_caja'],2,",",".");?>">   
        </td>
           
    </tr>
</table>

  <table class="tabencabezado"style="margin: 0 auto;">
    <tr>
        <td>
        <input class="botonsubmit" type="submit" value="Ingresar registro">
        </td>
	
    </tr>     
</body>
<script>

function operacion_online(){
	   plus_ingresos();
	  plus_egresos();
	  total_ingresos_netos();
	  totaly_caja(); 
}

function plus_ingresos(){
	  var ing=document.getElementById('Ingresos').value;
	   ing = ing.replace(".", "");
	   ing = ing.replace(".", "");
	   ing = ing.replace(".", "");
	  if(ing==""){
		 ing=0;
	  }
	  var mas_ingresos=document.getElementById('Otros_ingresos').value;
	  if(mas_ingresos==""){
		 mas_ingresos=0;
	  }
	  var total_ingresos=parseInt(ing)+parseInt(mas_ingresos);
	  document.getElementById('Total_ingresos').value=total_ingresos;  
}

function plus_egresos(){
  var eg=document.getElementById('Prestado').value;
  eg = eg.replace(".", "");
  eg = eg.replace(".", "");
  eg = eg.replace(".", "");
  if(eg==""){
	 eg=0;
  } 
  var gastos=document.getElementById('Gastos').value;
  if(gastos==""){
	 gastos=0;
  }
  var total_egresos=parseInt(eg)+parseInt(gastos);
  document.getElementById('Total_egresos').value=total_egresos;   
}

function total_ingresos_netos(){
  var tt_ingresos=document.getElementById('Total_ingresos').value;
  if(tt_ingresos==""){
	 eg=0;
  }  
  var tt_egresos=document.getElementById('Total_egresos').value;  
  if(tt_egresos==""){
	 tt_egresos=0;
  }   
  var total_ingreso_neto=parseInt(tt_ingresos)-parseInt(tt_egresos);
  document.getElementById('Ingresos_netos').value=total_ingreso_neto;  
}

function totaly_caja(){
  var valor_caja_antes="<?php echo $tota1_caja1; ?>";
  var tt_ingresos=document.getElementById('Ingresos_netos').value;  
  if(tt_ingresos==""){
	 tt_ingresos=0;
  }   
  var total_caja=parseInt(valor_caja_antes)+parseInt(tt_ingresos);
  document.getElementById('Total_caja').value=total_caja;  
}

function checkifcaja(){
	    var scja="<?php echo $checkcaja; ?>";
		if(scja=="sicaja"){
			ejecutar();
		} else {
		  	sincaja(); 
		}   
	}
  
function sincaja(){
	  sumar_ingresos_sincaja();
	  sumar_egresos_sincaja();
	  totalizar_ingresos_netos_sincaja();
	  total_caja_sincaja();
  }	
 
  
  function sumar_ingresos_sincaja(){
	  var ing=document.getElementById('Ingresos').value;
	   ing = ing.replace(".", "");
	   ing = ing.replace(".", "");
	   ing = ing.replace(".", "");
	  if(ing==""){
		 ing=0;
	  }
	  var mas_ingresos=document.getElementById('Otros_ingresos').value;
	  if(mas_ingresos==""){
		 mas_ingresos=0;
	  }
	  var total_ingresos=parseInt(ing)+parseInt(mas_ingresos);
	  document.getElementById('Total_ingresos').value=total_ingresos;  
}

  function sumar_egresos_sincaja(){
  var eg=document.getElementById('Prestado').value;
   eg = eg.replace(".", "");
   eg = eg.replace(".", "");
   eg = eg.replace(".", "");
  if(eg==""){
	 eg=0;
  } 
  var gastos=document.getElementById('Gastos').value;
  if(gastos==""){
	 gastos=0;
  }
  var total_egresos=parseInt(eg)+parseInt(gastos);
  document.getElementById('Total_egresos').value=total_egresos;   
}

 function totalizar_ingresos_netos_sincaja(){
  var tt_ingresos=document.getElementById('Total_ingresos').value;
  if(tt_ingresos==""){
	 eg=0;
  }  
  var tt_egresos=document.getElementById('Total_egresos').value;  
  if(tt_egresos==""){
	 tt_egresos=0;
  }   
  var total_ingreso_neto=parseInt(tt_ingresos)-parseInt(tt_egresos);
  document.getElementById('Ingresos_netos').value=total_ingreso_neto;  
}

function total_caja_sincaja(){
  var valor_caja_antes="<?php echo $tota1_caja1; ?>";
  var tt_ingresos=document.getElementById('Ingresos_netos').value;  
  if(tt_ingresos==""){
	 tt_ingresos=0;
  }   
  var total_caja=parseInt(valor_caja_antes)+parseInt(tt_ingresos);
  document.getElementById('Total_caja').value=total_caja;  
}

  function ejecutar(){
	  sumar_ingresos();
	  sumar_egresos();
	  totalizar_ingresos_netos();
	  total_caja();
  }	  
 
  function sumar_ingresos(){
	  var ing="<?php echo $Cobrado_dia; ?>";
	  if(ing==""){
		 ing=0;
	  } 
	  var mas_ingresos=document.getElementById('Otros_ingresos').value;
	  if(mas_ingresos==""){
		 mas_ingresos=0;
	  }
	  var total_ingresos=parseInt(ing)+parseInt(mas_ingresos);
	  document.getElementById('Total_ingresos').value=total_ingresos;  
}

  function sumar_egresos(){
  var eg="<?php echo $Prestado_dia; ?>";
 
  if(eg==""){
	 eg=0;
  } 
  var gastos=document.getElementById('Gastos').value;
  if(gastos==""){
	 gastos=0;
  }
  var total_egresos=parseInt(eg)+parseInt(gastos);
  document.getElementById('Total_egresos').value=total_egresos;   
}

 function totalizar_ingresos_netos(){
  var tt_ingresos=document.getElementById('Total_ingresos').value;
  if(tt_ingresos==""){
	 eg=0;
  }  
  var tt_egresos=document.getElementById('Total_egresos').value;  
  if(tt_egresos==""){
	 tt_egresos=0;
  }   
  var total_ingreso_neto=parseInt(tt_ingresos)-parseInt(tt_egresos);
  document.getElementById('Ingresos_netos').value=total_ingreso_neto;  
}

function total_caja(){
  var valor_caja_antes="<?php echo $tota1_caja1; ?>";
  if(valor_caja_antes==""){
	 valor_caja_antes=0;
  }  
  var tt_ingresos=document.getElementById('Ingresos_netos').value;  
  if(tt_ingresos==""){
	 tt_ingresos=0;
  }   
  var total_caja=parseInt(valor_caja_antes)+parseInt(tt_ingresos);
  document.getElementById('Total_caja').value=total_caja;  
}
</script>
</html>
