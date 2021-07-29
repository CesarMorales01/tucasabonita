<?PHP
include("datos.php");

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error)die("Problemas con la conexiÃ³n a la base de datos");

$mysql->set_charset("utf8");

$json=array();
				 
			$consulta=$mysql->query("select * from promociones")or die("problemas en la consulta");
		
			while($registro=mysqli_fetch_array($consulta)){
			$result["Titulo"]=$registro['Titulo'];
			$result["Descripcion"]=$registro['Descripcion'];
			$result["Url"]=$registro['Url'];
			$result["ImagenUrl"]=$registro['ImagenUrl'];
			$result["Texto_boton"]=$registro['Texto_boton'];
			$result["Imagen"]=base64_encode($registro['Imagen']);
			$json['promos'][]=$result;
			
		}
		$mysql->close();
		echo json_encode($json);
		
?>