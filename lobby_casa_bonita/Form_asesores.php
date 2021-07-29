<?php
include("datos.php");

if(isset($_COOKIE['cobrador'])){
	
$revisar_sesion = $_COOKIE['cobrador'];
$revisar_sesion_comis="'".$revisar_sesion."'"; 
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  

//REVISAR TIPO DE USUARIO
if(isset($_COOKIE['tipo_usuario'])){
$tipo_usuario1 = $_COOKIE['tipo_usuario'];
$tipo_usuario="'".$tipo_usuario1."'";
} else {
 $notificacion="Se requiere iniciar sesión!";
 header("Location:  $url/Form_login.php?notificacion=$notificacion");  
}  
	 
$check_tipousuario=$mysql->query("select * from asesores where imei=$revisar_sesion_comis") or die ("problemas en la consulta asesores");
if($revisar_usu=$check_tipousuario->fetch_array()){
	$type_usu=$revisar_usu['tipo_usuario'];
}
if($type_usu!="administrador"){
$notificacion="Se requiere iniciar sesión!";
header("Location:  $url/Form_login.php?notificacion=$notificacion");  		
}        

echo '<a href="Cerrar_sesion.php" style="float:right">Cerrar sesión</a>';

?>

<!doctype html>

<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

     <link rel="StyleSheet" href="estilos.php" type="text/css">

  <title>Listado de asesores</title>

</head>  

<body>

<script>
  window.addEventListener('load', inicio, false);

  function inicio() {
    document.getElementById("bloqueo_hora").addEventListener('submit', validar, false);
  }

  function validar(evt) {
	  nom=document.getElementById('text_hora').value;
     var contar_caract=nom.length;
	 var check_puntos=nom.indexOf(":");
    if (contar_caract<8 || check_puntos<0) {
		alert("Ingresa la hora como en este ejemplo: 21:00:00");
		evt.preventDefault();
    }
	

  }
</script>

      <br> <br> 

   <h1> Lista de asesores </h1>
     
    <h2><?php if(isset($_REQUEST['notificacion']))

     { echo $_REQUEST['notificacion']; } ?></h2>

<br> 

  <?php
 
 echo '<table class="tablalistado"style="margin: 0 auto;">';

    echo '<tr><th>Nombre</th><th>Imei/Contraseña</th><th>Tipo de usuario</th><th>Carteras Habilitadas</th><th>Habilitar</th>

         <th>Bloqueo por hora</th><th>Borrar</th><th>Modificar</th></tr>';
    
    while ($reg=$registros0->fetch_array()) {

          echo '<tr>';
    
          echo '<td>';
    
          echo $reg['nombre'];
    
          echo '</td>';      
    
          echo '<td>';
    
          echo $reg['imei'];      
    
          echo '</td>';   
		  
		   echo '<td>';
    
          echo $reg['tipo_usuario'];      
    
          echo '</td>';  
          
          echo '<td>';
          echo $reg['unable'];
         
          echo "<br";
          
          echo '</td>'; 
      
          echo '<td>';
    
          echo '<a href="Form_habilitaciones.php?imei='.$reg['imei'].'&nombre='.$reg['nombre'].'">Modificar carteras habilitadas</a>';
    
          echo '</td>';  
		  
		   echo '<td>';
    
          echo $reg['time_blocked'];
         
          echo "<br";
    
          echo '</td>'; 
    
          echo '<td>';
    
          echo '<a href="Alerta_eliminar_asesor.php?imei='.$reg['imei'].'">Borrar</a>';
    
          echo '</td>';  

    
          echo '</td>';
    
          echo '<td>';
    
          echo '<a href="Form_modificar_asesor.php?imei='.$reg['imei'].'">Modificar</a>';
    
          echo '</td>'; 
    
          echo '</tr>'; 
          
 

    } 


    echo '<tr><td colspan="2">';

    echo '<a href="Form_agregar_asesor.php">Agregar asesor</a>';

    echo '</td></tr>';

    echo '<table>';  
	

// configurar_bloqueo_hora
echo '<br><br>';
echo '<table class="tablalistado"style="margin: 0 auto;">';
echo '<tr>';
echo '<th>';
echo '<a href="configurar_bloqueo_hora.php">Configurar hora de bloqueo asesores</a>';
echo '</th></tr>';
echo '</table>';  
echo '<br>';


  ?> 

  <br>

  <a href="Lobby.php">Ir a Lobby</a>

</body>

</html>