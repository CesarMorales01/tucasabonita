<?php
include("datos.php");
if(isset($_COOKIE['cobrador'])){
$imei=$_COOKIE['cobrador'];
$imei="'".trim($imei)."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}     

// Cobro
$Cobro=$_REQUEST['Cobro'];
//Fecha
$fecha1=$_REQUEST['Fecha'];
$fecha="'".$fecha1."'";
//Cobrado
$Ingresos1=$_REQUEST['Ingresos'];
$Ingresos = str_replace(".", "", $Ingresos1);
$buscar_coma1 = strstr($Ingresos, ',');
if($buscar_coma1!=null){
$Ingresos = substr($Ingresos, 0, -3);
}	
$Ingresos="'".$Ingresos."'";
//Otros_ingresos
$otros_ingresos=$_REQUEST['Otro_ingresos'];
$otros_ingresos = str_replace(".", "", $otros_ingresos);
$buscar_coma0 = strstr($otros_ingresos, ',');
if($buscar_coma0!=null){
$otros_ingresos = substr($otros_ingresos, 0, -3);
}	
$otros_ingresos="'".$otros_ingresos."'";
//Comentario ingresos
$Observaciones_I=$_REQUEST['Observaciones_I'];
$Observaciones_I="'".$Observaciones_I."'";
//Total ingresos
$Total_ingresos=$_REQUEST['Total_ingresos'];
$Total_ingresos = str_replace(".", "", $Total_ingresos);
$buscar_coma = strstr($Total_ingresos, ',');
if($buscar_coma!=null){
$Total_ingresos = substr($Total_ingresos, 0, -3);
}
if($Total_ingresos==null){
	$Total_ingresos=0;
}	
$Total_ingresos="'".$Total_ingresos."'";
//Prestado
$Prestado=$_REQUEST['Prestado'];
$Prestado = str_replace(".", "", $Prestado);
$buscar_coma2 = strstr($Prestado, ',');
if($buscar_coma2!=null){
$Prestado = substr($Prestado, 0, -3);
}
if($Prestado==null){
	$Prestado=0;
}
$Prestado="'".$Prestado."'";
//Otros gastos
$Gastos=$_REQUEST['Gastos'];
$Gastos = str_replace(".", "", $Gastos);
$buscar_coma3 = strstr($Gastos, ',');
if($buscar_coma3!=null){
$Gastos = substr($Gastos, 0, -3);
}
if($Gastos==null){
	$Gastos=0;
}	
$Gastos="'".$Gastos."'";

$Observaciones_E=$_REQUEST['Observaciones_E'];
$Observaciones_E="'".$Observaciones_E."'";
// Total egresos
$Total_egresos=$_REQUEST['Total_egresos'];
$Total_egresos = str_replace(".", "", $Total_egresos);
$buscar_coma4 = strstr($Total_egresos, ',');
if($buscar_coma4!=null){
$Total_egresos = substr($Total_egresos, 0, -3);
}
if($Total_egresos==null){
	$Total_egresos=0;
}	
$Total_egresos="'".$Total_egresos."'";
//
$Ingresos_netos=$_REQUEST['Ingresos_netos'];
$Ingresos_netos = str_replace(".", "", $Ingresos_netos);
$buscar_coma5 = strstr($Ingresos_netos, ',');
if($buscar_coma5!=null){
$Ingresos_netos = substr($Ingresos_netos, 0, -3);
}
if($Ingresos_netos==null){
	$gastos=0;
}	
$Ingresos_netos="'".$Ingresos_netos."'";

$Total_caja=$_REQUEST['Total_caja'];
$Total_caja = str_replace(".", "", $Total_caja);
$buscar_coma6 = strstr($Total_caja, ',');
if($buscar_coma6!=null){
$Total_caja = substr($Total_caja, 0, -3);
}
	
$Total_caja="'".$Total_caja."'";

$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);	

$buscar_asesor="SELECT nombre FROM asesores where imei=$imei";
$get_asesor=mysqli_query($conexion,$buscar_asesor);
if($get_asesor0=$get_asesor->fetch_array()){
	$get_nombre_asesor=$get_asesor0['nombre'];
	$asesor="'".$get_nombre_asesor."'";
	}



$insert_abono="INSERT INTO caja(fecha, cobrado, otros_ingresos, comentario_ingresos, total_ingresos, prestado, otros_gastos, comentario_egresos, total_egresos, entradas_neto, total_caja, Cobro, asesor) VALUES (
$fecha, $Ingresos, $otros_ingresos, $Observaciones_I, $Total_ingresos, $Prestado, $Gastos, $Observaciones_E, $Total_egresos, $Ingresos_netos, $Total_caja, $Cobro, $asesor)";

$resultado_insert=mysqli_query($conexion,$insert_abono) or die ("problemas al insertar");

if($resultado_insert){
$Cobro = str_replace("'", "", $Cobro);	
$Cobro=trim($Cobro);
header("Location:  $url/Cuadrar_caja_superusuario.php?Cobro=$Cobro");
}else{
echo " no registra";
}


?>
