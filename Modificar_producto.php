<?php
include("datos.php");
header('Content-type: text/html; charset=utf-8');
$id="'".$_REQUEST['id']."'";
$referencia="'".$_REQUEST['referencia']."'";
$nombre="'".$_REQUEST['nombre']."'";
$descripcion="'".$_REQUEST['descripcion']."'";
$precio=$_REQUEST['precio'];
$n_cuotas="'".$_REQUEST['n_cuotas']."'";
$valor_cuotas="'".$_REQUEST['valor_cuotas']."'";
$text_credito="'".$_REQUEST['text_credito']."'";
$cate=$_REQUEST['categoria'];
$cate="'".$cate."'";
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
  $nombre_image="'".$_REQUEST['imageDir']."'";
}
$update=$mysql->query("update productos set referencia=$referencia, categoria=$cate, nombre=$nombre, descripcion=$descripcion, valor=$precio, text_credito=$text_credito, n_cuotas=$n_cuotas, valor_cuotas=$valor_cuotas, imagen=$nombre_image where id=$id") or die ("problems update");
if($update){
  $href=$url."ListaProductos.php?producto=".$_REQUEST['nombre'];
  header("Location:  $href");
}
$mysql->close();
?>