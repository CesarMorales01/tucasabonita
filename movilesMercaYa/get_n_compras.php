<?PHP
include("datos.php");
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if($mysql->connect_error)die("Problemas con la conexión a la base de datos");
$cedula=$_REQUEST['cedula'];
$compras_n;
$get=$mysql->query("select compra_n from lista_compras where cliente=$cedula order by compra_n desc") or die ("problemas select");
if($getN=$get->fetch_array()){
    $compras_n= $getN['compra_n'];
} 	
if($compras_n==""){
    $compras_n="0";
}
echo $compras_n;
$mysql->close();
?>