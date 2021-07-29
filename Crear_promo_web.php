<?php
include("datos.php");
header('Content-type: text/html; charset=utf-8');
$descripcion="'".$_REQUEST['descripcion']."'";
$producto=$_REQUEST['producto'];
if($producto=="no"){
    $producto="";
}
 $producto="'".$producto."'";
  $credito="'".$_REQUEST['credito']."'";
$categoria=$_REQUEST['categoria'];
if($categoria=="no"){
    $categoria="";
}
$categoria="'".$categoria."'";
$dir_subida = 'ImagenesPromo/';
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
        $insert=$mysql->query("insert promociones_mercaya (descripcion, pago_credito, imagen, ref_producto, categoria) VALUES ($descripcion, $credito, $nombre_image, $producto, $categoria)") or die ("problems insert");
        if($insert){
            $href="https://tucasabonita.site/ListaPromos.php";
            header("Location:  $href"); 
        }
    }
} 


if(isset($_REQUEST['labelImage'])){
        $nombre_image=$_REQUEST['labelImage'];
        $nombre_image="'".$nombre_image."'";
		echo $descripcion;
echo 		$credito;
echo  $nombre_image;
echo  $producto;
echo $categoria;
        $insert=$mysql->query("insert promociones_mercaya (descripcion, pago_credito, imagen, ref_producto, categoria) VALUES ($descripcion, $credito, $nombre_image, $producto, $categoria)") or die ("problems insert labelImage");
        if($insert){
            $href="https://tucasabonita.site/ListaPromos.php";
            header("Location:  $href"); 
        }
} 

if(isset($_REQUEST['id'])){
    $id= $_REQUEST['id'];
    $delete=$mysql->query("delete from promociones_mercaya where id=$id") or die ("problems delete");
    if($delete){
        $href="https://tucasabonita.site/ListaPromos.php";
        header("Location:  $href"); 
    }
}
$mysql->close();
?>