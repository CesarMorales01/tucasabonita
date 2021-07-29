<html> 

  <head> 

   <link rel="StyleSheet" href="estilos.php" type="text/css">
   <script src="funciones.js"></script> 

  <title>Nuevo ingreso a salarios</title> 

  </head>  
<br>  
 <?php 
include("datos.php");
echo '<h1>Realizar ingreso a salarios</h1>';	
echo '<body onLoad="operacion_online()">';

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
echo '<table class="tablalistado1"style="margin: 0 auto;">';

echo '<tr><th>Fecha</th><th>Ingresos</th><th>Retiros</th><th>Comentarios</th><th>Ingreso neto </th><th>Total</th></tr>';
?>	
		
<!– TABLA NUEVOS DATOS PARA CAJA

<br><br>    
<form method="post" action="Actualizar_salarios.php">

    <tr> 
        <td>
         <input type="text" name="Fecha" size="7" value="<?PHP echo $get_global_fecha_hoy_comis;?>">   
        </td>
		
        <td>
         <input type="text" id="Ingresos" onChange="operacion_online()" name="Ingresos" size="7">   
        </td>
        
		<td>
         <input type="text" id="Retiros" onChange="operacion_online()" name="Retiros" size="7">   
        </td>
        <td>
         <textarea name="Comentarios" rows="1" cols="8"></textarea>   
        </td>
        
        <td>
         <input type="text" id="Total_ingresos"  name="Ingreso_neto" size="7" >   
        </td>
     
         <td>
        <input type="text" name="Total" size="7" id="Total" value="<?PHP $_REQUEST['total'];?>">   
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
	   var ing=document.getElementById('Ingresos').value;
	  var ing = ing.replace(".", "");
	  if(ing==""){
		 ing=0;
	  }
	  var retiros=document.getElementById('Retiros').value;
	  if(retiros==""){
		 retiros=0;
	  }
	
	  var total_ingresos=parseInt(ing)-parseInt(retiros);
	  document.getElementById('Total_ingresos').value=total_ingresos;  
	  var caja="<?PHP echo $_REQUEST['total'];?>";	 
	  var total_todo=parseInt(total_ingresos)+parseInt(caja);
	  document.getElementById('Total').value=total_todo;

	  
}
</script>
</html>
