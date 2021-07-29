<?php
include("datos.php");
$id=$_REQUEST['id'];
$id="'".$id."'";
$hora="''";
$get_if_time_blocked="UPDATE asesores set time_blocked=$hora where id=$id";
$insert=mysqli_query($conexion,$get_if_time_blocked) or die ("Problems to update!");

if($insert){
$notificacion="Se quitado la hora de bloqueo";
header("Location:  $url/Form_asesores.php?notificacion=$notificacion");
}
  ?> 