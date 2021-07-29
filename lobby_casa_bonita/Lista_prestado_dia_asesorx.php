<html>
<head>
 <link rel="StyleSheet" href="estilos.php" type="text/css">    
  <title>Lista vendido</title>
  <br>
</head>  
<body>
<?php
include("datos.php");
$Cobro=$_REQUEST['Cobro'];
$asesor=$_REQUEST['asesor'];


if(isset($_REQUEST['fecha'])){
    $fecha1=$_REQUEST['fecha'];
}else{
   date_default_timezone_set('America/Los_Angeles');

  $get_fecha=date("Y-m-d");

  $fecha1=$get_fecha; 
}
 $fecha="'".$fecha1."'";
$asesor="'".$asesor."'";
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");    
$mysql->set_charset("utf8");
  
 $registros=$mysql->query("SELECT nombre, fecha_prest, valorprestamo, asesor from creditos_casa_bonita JOIN clientes on creditos_casa_bonita.cedula=clientes.cedula where asesor=$asesor and fecha_prest=$fecha");

$registros1=$mysql->query("SELECT sum(valorprestamo) from creditos_casa_bonita WHERE asesor=$asesor and fecha_prest=$fecha") or die ("problemas en la consulta sumatoria");


$reg1=$registros1->fetch_array();

echo '<h1>Ventas a crédito</h1>';
echo '<table class="tablalistado1" style="margin: 0 auto;">';

echo '<tr><th>Fecha</th><th>Valor credito</th><th>Nombre cliente</th><th>Asesor</th></tr>';	


while ($reg=$registros->fetch_array()){


	  echo '<tr>';


      echo '<td>';


      echo $reg['fecha_prest'];


      echo '</td>';  


	 echo '<td>';

    echo number_format($reg['valorprestamo'],2,",",".");
  
     echo '</td>';  

	 echo '<td>';


      echo $reg['nombre'];


      echo '</td>';  

	 echo '<td>';


     echo $reg['asesor'];


     echo '</td>';  
  
	 echo '</tr>';	


	 }  


	   echo '<tr>';

      echo '<td>';

      echo "Total prestado";

      echo '</td>';  

	  

	 echo '<td>';
	 
    echo number_format($reg1['sum(valorprestamo)'],2,",",".");

     echo '</td>';  


    echo '</tr>';
	echo '</table>'; 
  
echo "<h2>Ventas de contado por $asesor</h2>";
$contado="contado";
$contado="'".$contado."'";
$registros=$mysql->query("SELECT cliente, compra_n, fecha, total_compra, comentarios from lista_compras where comentarios=$asesor and medio_de_pago=$contado and fecha=$fecha") or die ("problemas en la consulta lista clientes");

echo '<table class="tablalistado1"style="margin: 0 auto;">';
echo '<tr><th>Fecha</th><th>Cliente</th><th>Compra N°</th><th>Total compra</th><th>Asesor</th></tr>';	
$sumar=0;
while ($reg=$registros->fetch_array()){

	  echo '<tr>';

      echo '<td>';

      echo $reg['fecha'];

      echo '</td>';  

	  

	 echo '<td>';
	 $cedula=$reg['cliente'];
    $getCliente=$mysql->query("select * from clientes where cedula=$cedula") or die ("problemas al consultar cliente");
        if($info=$getCliente->fetch_array()){      
            echo  $info['nombre'];
        }

     echo '</td>';  


	 echo '<td>';
        echo  $reg['compra_n'];
      echo '</td>';  
	 
	 echo '<td>';
	 $sumar=$sumar+$reg['total_compra'];
   echo number_format($reg['total_compra'],2,",",".");
     

     echo '</td>';  

	 
	 echo '<td>';
   echo $reg['comentarios'];    

     echo '</td>';
	 

	 echo '</tr>';	

	 }  

	  echo '<tr>';

      echo '<td>';

      echo "Total contados";

      echo '</td>';  

	  

	 echo '<td>';
	 
   echo number_format($sumar,2,",",".");

     echo '</td>';  

	 

     echo '</tr>';	 

    echo '</tr>';

  	echo '</table>';



?>
</body>
</html>