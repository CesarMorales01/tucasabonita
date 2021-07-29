<?PHP
include("datos.php");
$cedula=$_REQUEST['cedula'];
$fecha=$_REQUEST['fecha'];
$asesor=$_REQUEST['asesor'];
$cobro="'".$_REQUEST['cobro']."'";
$checkBox=$_REQUEST['checkBox'];
if($checkBox=="true"){
    $checkBox="Si";
}else{
    $checkBox="No";
}
$comentarios=$_REQUEST['comentarios'];
$slash="/";
$guion="-";
$comentarios=str_replace($slash, $guion, $comentarios);
$string=$fecha.$slash.$asesor.$slash.$checkBox.$slash.$comentarios;
$string="'".$string."'";
$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
$editReg=$mysql->query("update clientes set revisado=$string where cedula=$cedula and Cobro=$cobro") or die ("problemas al actualizar");
if($editReg){
    echo $cedula;
}
?>