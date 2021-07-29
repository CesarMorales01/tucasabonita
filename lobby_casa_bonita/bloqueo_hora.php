<?php
include("datos.php");
$hora=$_REQUEST['hora'];
$hora="'".$hora."'";
$id=$_REQUEST['id'];
$id="'".$id."'";

$update_time_blocked="UPDATE asesores set time_blocked=$hora where id=$id";
$get_time_b=mysqli_query($conexion,$update_time_blocked)or die ("Problems to update!");
if($get_time_b){
$notificacion="Se ha modificado la hora de bloqueo";
header("Location:  $url/Form_asesores.php?notificacion=$notificacion");
}

  ?> 