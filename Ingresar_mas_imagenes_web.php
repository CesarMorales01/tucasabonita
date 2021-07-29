<?php
include("datos.php");
header('Content-type: text/html; charset=utf-8');
$id=$_REQUEST['id'];
$dir_subida = 'Imagenes_productos/';
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$mysql->set_charset("utf8");	
if(isset($_FILES['imagen'])){
   $file_name= $_FILES['imagen']['name'];
   $file_temp= $_FILES['imagen']['tmp_name'];
   $imagen_array=$_REQUEST['array'];
   $sep="||";
   $nuevo_array=$imagen_array.$sep.$file_name;
    $upload= move_uploaded_file($file_temp, $dir_subida.$file_name);
    if($upload){
        $id=$_REQUEST['id'];
        $nombre_image="'".$nuevo_array."'";
        $upd=$mysql->query("update productos set imagen=$nombre_image where id=$id") or die ("problems udpate");
        if($upd){
            $href="https://tucasabonita.site/FormMasImagenes.php?id=";
            $href1=$href.$id;
            header("Location:  $href1"); 
        }
    }
}