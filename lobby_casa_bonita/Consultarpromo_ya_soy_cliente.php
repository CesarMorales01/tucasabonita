<?PHP
include("datos.php");
$json=array();
				
		$mysql =  new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
		if($mysql->connect_error) die("Problemas con la conexion a base de datos");
			$consulta=$mysql->query("select * from promo_ya_soy_cliente")or die("problemas en la consulta");
		
			while($registro=mysqli_fetch_array($consulta)){
			$json['promos'][]=$registro;
		}
		$mysql->close();
	 echo json_encode($json,JSON_UNESCAPED_UNICODE);
		
?>