 <?PHP
include("datos.php");
	$json=array();
	
	if(isset($_REQUEST["usuario"]) 
	&& isset($_REQUEST["clave"])
    && isset($_REQUEST["cedula"])
	   ){
		$usuario=$_REQUEST['usuario'];
		$clave=$_REQUEST['clave'];
		$cedula=$_REQUEST['cedula'];
			
		$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		
		$insert="update crear_clave set usuario='$usuario', clave='$clave'
                          where cedula='$cedula'";
		$resultado_insert=mysqli_query($conexion,$insert);
		
		if($resultado_insert){
		mysqli_close($conexion);
	        echo "registra";
		}
		else{
			echo "conecta pero no registra";
		}
		
	}
	else{
			echo "ni siquiera conecta";
		}
	
?>

