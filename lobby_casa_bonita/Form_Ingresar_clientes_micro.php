<?php
include("datos.php");
echo '<a href="Cerrar_sesion.php" style="float:right"></a>';
?>
<html> 
<head> 
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Formulario Ingreso de clientes</title> 
</head> 
<body>
    
<script>
  window.addEventListener('load', inicio, false);

  function inicio() {
    document.getElementById("form_registro_clientes").addEventListener('submit', validar, false);
  }

  function validar(evt) {
     var nom=document.getElementById('cedula').value;
     var patron=/^[0-9]+$/;
    if (patron.test(nom)) {
    } else {    alert('El campo cedula solo puede guardar numeros!');
		evt.preventDefault();
		}
  }
</script>    
        
  <br> <br> <br> 
  <h2>Ingresar cliente:</h2>
  <div id="contenedor">  
  <form method="post" action="Registro_clientes_navegador_micro.php" id="form_registro_clientes">

  <input type="text" name="nombre" size="50" placeholder="Nombre" required> 
  <br> <br> 

  <input type="text" name="cedula" size="50" placeholder="Cedula" required id="cedula"> 
  <br> <br> 
  
  <textarea name="direccion" rows="1" cols="50" placeholder="Direccion"></textarea> 
  <br> <br> 
 
  <input type="text" name="telefono" size="50" placeholder="Telefono"> 
  <br> <br> 

   <textarea name="direccion_trabajo" rows="1" cols="50" placeholder="Direccion de trabajo"></textarea>
  <br> <br> 

  <input type="text" name="telefono_trabajo" size="50" placeholder="Telefono de trabajo"> 
  <br> <br> 
   
  <input type="text" name="nombre_fiador" size="50" placeholder="Nombre fiador"> 
  <br> <br> 

  <textarea name="dir_fiador" rows="1" cols="50" placeholder="Direccion fiador"></textarea>
  <br> <br> 

  <input type="text" name="tel_fiador" size="50" placeholder="Telefono fiador"> 
  <br> <br> 

  <input type="text" name="rifa" size="50"placeholder="Rifa"> 
  <br> <br> 

  <input type="text" name="valor_letra" size="50" placeholder="Letra"> 
  <br> <br> 

      
<?php 
if(isset($_COOKIE['cobrador'])){
	
$revisar_sesion = $_COOKIE['cobrador'];
  
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  
$revisar_sesion_comis="'".$revisar_sesion."'";

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

    if ($mysql->connect_error)

     die("Problemas con la conexiÃ³n a la base de datos");

$registros1=$mysql->query("select unable from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta1");

$reg_carte_prede=$mysql->query("select variable from cartera_prede where asesor=$revisar_sesion_comis") or die ("problemas en la consulta1");

$Carte_prede="";
if($get_carte_prede=$reg_carte_prede->fetch_array()){
$Carte_prede=$get_carte_prede['variable'];
}

while($reg=$registros1->fetch_array()){
$Cobro0=$reg['unable'];
}
$tok = strtok($Cobro0, ",");
$n=0;
$nombres=[];
while ($tok !== false) {
   $n++;
   $nombres[$n]= "$tok";
   $tok = strtok(",");
}
$size_array= count($nombres, COUNT_RECURSIVE);

echo  '<select name="Cobro">';
for($x=1;$x<=$size_array;$x++){
$valor=trim($nombres[$x]);
echo "<option value='$valor'";
    if ($Carte_prede === $valor) { 
    echo 'selected="true"';
    }
echo ">$valor</option>";      
}

?>     
      
 </select>
 <br> <br>
  <input class="botonsubmit" type="submit" value="confirmar"> 
  </form>
  <a href="Lobby_micro.php">Ir a Gestion de cartera</a>
  </div>
</body> 
</html>

