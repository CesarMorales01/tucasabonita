<?PHPinclude("datos.php");$id=$_REQUEST['id'];$nombre=$_REQUEST['nombre'];$nombre="'".$nombre."'";$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");$registros1=$mysql->query("select cedula from clientes where Cobro=$nombre") or die ("problemas en la consulta1");	  $nombres=[];$n=0;while($reg1=$registros1->fetch_array()){ $n++; $nombres[$n]=$reg1['cedula'];}	$size_array= count($nombres, COUNT_RECURSIVE); for($x=1;$x<=$size_array;$x++){ $nombres1[$x]=trim($nombres[$x]);} for($x=1;$x<=$size_array;$x++){ $nombrex="'".$nombres1[$x]."'";	   $delete="DELETE from crear_clave where cedula=$nombrex";  $resultado_eliminar=mysqli_query($conexion,$delete) or die ("problemas al eliminar $nombrex"); } for($x=1;$x<=$size_array;$x++){ $nombrex="'".$nombres1[$x]."'";	   $delete_clientes_histo="DELETE from clientes_historial where cedula=$nombrex";  $resultado_eliminar_clientes_histo=mysqli_query($conexion,$delete_clientes_histo) or die ("problemas al eliminar delete_clientes_histo $nombrex"); }$eliminar1="DELETE from Carteras where id=$id";$eliminar2="DELETE from clientes where Cobro=$nombre";$eliminar3="DELETE from prestamos where Cobro=$nombre";$eliminar4="DELETE from abonos where Cobro=$nombre";$eliminar6="DELETE from prestamos_historial where Cobro=$nombre";$eliminar7="DELETE from abonos_historial where Cobro=$nombre";$resultado_eliminar1=mysqli_query($conexion,$eliminar1) or die ("problemas al eliminar1");$resultado_eliminar2=mysqli_query($conexion,$eliminar2) or die ("problemas al eliminar2");$resultado_eliminar3=mysqli_query($conexion,$eliminar3) or die ("problemas al eliminar3");$resultado_eliminar4=mysqli_query($conexion,$eliminar4) or die ("problemas al eliminar4");$resultado_eliminar6=mysqli_query($conexion,$eliminar6) or die ("problemas al eliminar6");$resultado_eliminar7=mysqli_query($conexion,$eliminar7) or die ("problemas al eliminar7");if($resultado_eliminar7){$notificacion="La cartera se ha eliminado";header("Location: $url/Form_carteras.php?notificacion=$notificacion");    }			?>