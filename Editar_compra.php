<?PHP
include("datos.php");
$id=$_REQUEST['id']; 
$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");
$periodicidad="'".$_REQUEST['periodicidad']."'";
$mysql->query("update lista_compras set cliente='$_REQUEST[cliente]', compra_n='$_REQUEST[compra_n]', fecha='$_REQUEST[fecha]',
total_compra='$_REQUEST[total_compra]', descripcion_credito='$_REQUEST[descripcion_credito]', periodicidad=$periodicidad, n_cuotas='$_REQUEST[n_cuotas]', domicilio='$_REQUEST[domicilio]',
medio_de_pago='$_REQUEST[medio_de_pago]', comentarios='$_REQUEST[comentarios]', cambio='$_REQUEST[cambio]'  where id=$_REQUEST[id]") or die ("problemas al actualizar ");
if($mysql){ 
  header("Location: https://tucasabonita.site/ListaCompras.php?cedula=$_REQUEST[cliente]");	
}

?>