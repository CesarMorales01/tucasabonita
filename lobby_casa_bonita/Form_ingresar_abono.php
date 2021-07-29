<html> 
<head>
<link rel="StyleSheet" href="estilos.php" type="text/css">
<title>Formulario Ingreso de abonos</title> 
</head> 
<body>
<script>
  window.addEventListener('load', inicio, false);

  function inicio() {
	   document.getElementById("Form_ingresar_abono").addEventListener('submit', validar, false);
  }

  function validar(evt) {
     var nom=document.getElementById('abono').value;
     var patron=/^[0-9]+$/;
    if (patron.test(nom)) {
    } else {    alert('El campo valor abono solo puede guardar numeros!');
		evt.preventDefault();
		}
	var btn = document.getElementById('btnEnviar');
     btn.disabled=true;	
  }
  
window.onload =  function inicio() {
fecha_prest();
  }
  
 function fecha_prest() {
 var fecha = new Date(); //Fecha actual
  var mes = fecha.getMonth()+1; //obteniendo mes
  var dia = fecha.getDate(); //obteniendo dia
  var ano = fecha.getFullYear(); //obteniendo año
  if(dia<10)
    dia='0'+dia; //agrega cero si el menor de 10
  if(mes<10)
    mes='0'+mes //agrega cero si el menor de 10
  document.getElementById('date').value=ano+"-"+mes+"-"+dia;

  }
</script>
 <br> <br> <br> 

 <h2> Ingresar de Abono: </h2>
<div id="contenedor"> 
  <form method="post" action="Ingresar_abono_web.php" id="Form_ingresar_abono"> 
Valor abono:
<br> 
  <input type="text" name="valor_abono" placeholder="Valor del abono" id="abono"> 

  <br> <br> 
Fecha:
<br> 
  <input type="date" name="fecha" placeholder="Fecha" id="date">
  <?php 

include("datos.php");
if(isset($_REQUEST['cedula'])){ 
$cedula=$_REQUEST['cedula'];
$fecha_prest="'".$_REQUEST['fecha_prest']."'";
$cedula_comis="'".$cedula."'";
}

$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);	  
$consultar=$mysql->query("SELECT SUM(valor_abono), MAX(altura_cuota) from abonos_creditos_casa_bonita where fecha_prest=$fecha_prest and cedula=$cedula_comis") or die ("problemas en consulta");
if($get=$consultar->fetch_array()){
$cal_altura_cuota=$get['MAX(altura_cuota)'];
$altura_cuota=$cal_altura_cuota + 1;
}
mysqli_close($conexion);
?>
  <br> <br> 
  <input type="hidden" name="cedula" value="<?php echo $cedula; ?>">
   <input type="hidden" name="fecha_prest" value="<?php echo $_REQUEST['fecha_prest']; ?>">
Cuota numero:
 <br>
  <input type="number" max="999" min="1" name="altura_cuota" placeholder="Cuota Numero" value="<?php echo $altura_cuota;?>">
  <input type="hidden" name="Cobro" value="<?php  echo $_REQUEST['Cobro']; ?>">

  <br> <br>  

  <input class="botonsubmit" type="submit" id="btnEnviar" value="Ingresar"> 

  </form>

  <br>

  <a href="Lobby.php">Ir a Lobby</a>
 </div>
</body> 

</html>