<?php
include("datos.php");
header('Content-type: text/html; charset=utf-8');
$cate=$_REQUEST['categoria'];
$cate="'".$cate."'";
$dir_subida = 'ImagenesCategorias/';
include("datos.php");	
if(isset($_FILES['imagen'])){
   $file_name= $_FILES['imagen']['name'];
   $file_temp= $_FILES['imagen']['tmp_name'];
    $upload= move_uploaded_file($file_temp, $dir_subida.$file_name);
    if($upload){
        $mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
        if ($mysql->connect_error)die("Problemas con la conexión a la base de datos");
        $mysql->set_charset("utf8");
        $nombre_image=$dir_subida.$file_name;
        $nombre_image="'".$nombre_image."'";
        $insert=$mysql->query("insert categorias (nombre, imagen) VALUES ($cate, $nombre_image)") or die ("problems insert");
        if($insert){
            $href="https://tucasabonita.site/Lista_categorias.php";
            header("Location:  $href"); 
        }
    }
}else{
    $id=$_REQUEST['id'];
    $select=$mysql->query("select imagen from categorias where id=$id") or die ("problems select");
        if($img=$select->fetch_array()){
            $delete=$mysql->query("delete from categorias where id=$id") or die ("problems delete");
            if($delete){
                unlink($img['imagen']);
                $href="https://tucasabonita.site/Lista_categorias.php";
                header("Location:  $href"); 
            }
        }
}
$mysql->close(); 

?>