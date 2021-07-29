<?php
include("datos.php"); 

//Fecha
$fecha1=$_REQUEST['Fecha'];
$fecha="'".$fecha1."'";

$Ingresos1=$_REQUEST['Ingresos'];
$Ingresos = str_replace(".", "", $Ingresos1);	
if($Ingresos==null){
	$Ingresos=0;
}
$Ingresos="'".$Ingresos."'";

$Retiros=$_REQUEST['Retiros'];
$Retiros = str_replace(".", "", $Retiros);
if($Retiros==null){
	$Retiros=0;
}
$Retiros="'".$Retiros."'";

$Comentarios=$_REQUEST['Comentarios'];
echo $Comentarios="'".$Comentarios."'";

 $Ingresos_netos=$_REQUEST['Ingreso_neto'];
$Ingresos_netos = str_replace(".", "", $Ingresos_netos);
if($Ingresos_netos==null){
	$Ingresos_netos=0;
}	
echo $Ingresos_netos="'".$Ingresos_netos."'";

$Total=$_REQUEST['Total'];
$Total = str_replace(".", "", $Total);
echo $Total="'".$Total."'";

$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);	


echo $insert="INSERT INTO salarios(Fecha, Ingresos, Retiros, Comentarios, Ingreso_neto, Total) VALUES (
$fecha, $Ingresos, $Retiros, $Comentarios, $Ingresos_netos, $Total)";

$resultado_insert=mysqli_query($conexion,$insert) or die ("problemas al insertar");

if($resultado_insert){
	header("Location:  $url/salarios.php");
}else{
echo " no registra";
}


?>
