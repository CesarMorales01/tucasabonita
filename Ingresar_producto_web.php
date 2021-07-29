<?php
include("datos.php");
header('Content-type: text/html; charset=utf-8');
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
        $nombre_image="'".$file_name."'";
        $insert=$mysql->query("insert productos (referencia, categoria, nombre, descripcion, valor, n_cuotas, valor_cuotas, text_credito, imagen) VALUES ($referencia, $cate, $nombre, $descripcion, $precio, $n_cuotas, $valor_cuotas, $text_credito, $nombre_image)") or die ("problems insert");
        if($insert){
            $href=$url."ListaProductos.php?producto=".$_REQUEST['nombre'];
            header("Location:  $href");  
        }
    }
}
 
if(isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
    $select=$mysql->query("select imagen from productos where id=$id") or die ("problems select");
        if($img=$select->fetch_array()){
            $delete=$mysql->query("delete from productos where id=$id") or die ("problems delete");
            if($delete){
				$img_borrar=$dir_subida.$img['imagen'];
                unlink($img_borrar);
                $href="https://tucasabonita.site/ListaProductos.php";
                header("Location:  $href"); 
            }
        }
} 
$mysql->close();     
?>