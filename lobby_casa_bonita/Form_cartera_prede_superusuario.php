<?php

include("datos.php");
if ($_REQUEST['cartera']){
$cartera="'".$_REQUEST['cartera']."'";
$asesor="'".$_REQUEST['asesor']."'";
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

$consulta="SELECT * from cartera_prede where asesor=$asesor";
$resultado=mysqli_query($conexion,$consulta);
if($reg=$resultado->fetch_array()){
$actualizar="update cartera_prede set variable=$cartera where asesor=$asesor";
$resultado_actualizar=mysqli_query($conexion,$actualizar) or die ("problemas al actualizar");
header("Location:  $url/Form_Cuadrar_cuentas_superusuario.php");
} else {
$ingresar="INSERT INTO cartera_prede(variable, asesor) VALUES ($cartera, $asesor)";
$resultado_insert=mysqli_query($conexion,$ingresar) or die ("problemas al insertar");
header("Location:  $url/Form_Cuadrar_cuentas_superusuario.php");
}

}

?>