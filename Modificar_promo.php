<?php
include("datos.php");
header('Content-type: text/html; charset=utf-8');
$id="'".$_REQUEST['id']."'";
$modifId="'".$_REQUEST['modifId']."'";
$descripcion="'".$_REQUEST['descripcion']."'";
$credito="'".$_REQUEST['credito']."'";

$producto=$_REQUEST['producto'];
if($producto=="no"){
    $producto="";
}
 $producto="'".$producto."'";
$categoria=$_REQUEST['categoria'];
if($categoria=="no"){
    $categoria="";
}
$categoria="'".$categoria."'";

$dir_subida = 'Imagenes_productos/';
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");	
if(isset($_FILES['imagen'])){
   $file_name= $_FILES['imagen']['name'];
   $file_temp= $_FILES['imagen']['tmp_name'];
   $upload= move_uploaded_file($file_temp, $dir_subida.$file_name);
    if($upload){ 
      $nombre_image=$dir_subida.$file_name;     
      $nombre_image="'".$nombre_image."'"; 
    }       
}

if($file_name==""){
  $nombre_image="'".$_REQUEST['labelImage']."'";
}

$update=$mysql->query("update promociones_mercaya set id=$modifId, descripcion=$descripcion, pago_credito=$credito, imagen=$nombre_image, ref_producto=$producto, categoria=$categoria where id=$id") or die ("problems update");
if($update){
   $href="https://tucasabonita.site/ListaPromos.php";
   header("Location:  $href");
}
$mysql->close();

?>