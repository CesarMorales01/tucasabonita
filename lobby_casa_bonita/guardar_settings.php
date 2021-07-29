<?php
$fuente = "'".$_REQUEST['fuente']."'";
$btituloUno = "'".$_REQUEST['btituloUno']."'";
$bcasillaUno = "'".$_REQUEST['bcasillaUno']."'";
$btituloDos = "'".$_REQUEST['btituloDos']."'";
$bcasillaDos = "'".$_REQUEST['bcasillaDos']."'";
$btituloTres = "'".$_REQUEST['btituloTres']."'";
$bcasillaTres = "'".$_REQUEST['bcasillaTres']."'";
$bcontenedor = "'".$_REQUEST['bcontenedor']."'";
$bboton = "'".$_REQUEST['bboton']."'";


include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");

$consultar=$mysql->query("SELECT * from settings") or die ("problemas al consultar");

if($reg=$consultar->fetch_array()){
$mysql->query("update settings set fuente=$fuente where id=1") or die ("problemas al actualizar fuente");
$mysql->query("update settings set btituloUno=$btituloUno where id=1") or die ("problemas al actualizar btituloUno");
$mysql->query("update settings set bcasillaUno=$bcasillaUno where id=1") or die ("problemas al actualizar bcasillaUno");
$mysql->query("update settings set btituloDos=$btituloDos where id=1") or die ("problemas al actualizar btituloDos");
$mysql->query("update settings set bcasillaDos=$bcasillaDos where id=1") or die ("problemas al actualizar bcasillaDos");
$mysql->query("update settings set btituloTres=$btituloTres where id=1") or die ("problemas al actualizar btituloTres");
$mysql->query("update settings set bcasillaTres=$bcasillaTres where id=1") or die ("problemas al actualizar bcasillaTres");
$mysql->query("update settings set bcontenedor=$bcontenedor where id=1") or die ("problemas al actualizar bcontenedor");
$mysql->query("update settings set bboton=$bboton where id=1") or die ("problemas al actualizar bboton");
header("Location:  $url/settings.php");
} else {
$insertar=$mysql->query("INSERT INTO settings(fuente, btituloUno, bcasillaUno, btituloDos, bcasillaDos, btituloTres, bcasillaTres, bcontenedor, bboton) VALUES ($fuente, $btituloUno, $bcasillaUno, $btituloDos, $bcasillaDos, $btituloTres, $bcasillaTres, $bcontenedor, $bboton)") or die ("problemas al insertar");
header("Location:  $url/settings.php");
}
?>