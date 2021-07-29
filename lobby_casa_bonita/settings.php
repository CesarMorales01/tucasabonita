<!DOCTYPE html>
<html>
<head>
<title>Configuraciones</title>

<link rel="StyleSheet" type="text/css" href="estilos.php">
</head>
<body>
 <form method="post" action="guardar_settings.php">
 <input type="hidden" name="fuente" id="fuente">
<input type="hidden" name="btituloUno" id="btituloUno">
<input type="hidden" name="bcasillaUno" id="bcasillaUno">
<input type="hidden" name="btituloDos" id="btituloDos">
<input type="hidden" name="bcasillaDos" id="bcasillaDos">
<input type="hidden" name="btituloTres" id="btituloTres">
<input type="hidden" name="bcasillaTres" id="bcasillaTres">
<input type="hidden" name="bcontenedor" id="bcontenedor">
<input type="hidden" name="bboton" id="bboton">        
<?PHP

include("datos.php");
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	
$buscar_imei="SELECT variable FROM cartera_prede where asesor=4321";
$get_asesor=mysqli_query($conexion,$buscar_imei);

if($get_asesor0=$get_asesor->fetch_array()){
$get_estado="'".$get_asesor0['variable']."'";
}
$select_colors="SELECT * FROM settings";
$get_color=mysqli_query($conexion,$select_colors);

if($get_colors=$get_color->fetch_array()){
 $fuente=$get_colors['fuente'];
 $btituloUno=$get_colors['btituloUno'];
 $bcasillaUno=$get_colors['bcasillaUno'];
 $btituloDos=$get_colors['btituloDos'];
 $bcasillaDos=$get_colors['bcasillaDos'];
 $btituloTres=$get_colors['btituloTres'];
 $bcasillaTres=$get_colors['bcasillaTres'];
 $bcontenedor=$get_colors['bcontenedor'];
 $bboton=$get_colors['bboton'];
}
echo '<br>';
 
echo '<h1 id="tituloPrincipal">Titulo principal</h1>';

echo '<table class="tablalistado" style="margin: 0 auto;">';
 
echo '<tr>';

echo '<th id="tituloUno"><a href="">Ejemplo titulo uno</a></th>';
echo '</tr>';	

echo '<tr>';
echo '<td id="casillaUno">';
echo "Ejemplo casilla tabla 1";
echo '</td>'; 
echo '</tr>';
echo '</table>';
echo '<br>';
echo '<br>';	

echo '<table class="tablalistado1" style="margin: 0 auto;">';

echo '<tr><th id="tituloDos">Ejemplo titulo tabla 2</th>';
echo '</tr>';	

echo '<tr>';
echo '<td id="casillaDos">';
echo "Ejemplo casilla tabla 2";
echo '</table>';
echo '<br>';
echo '<br>';	
echo '<table class="tabencabezado" style="margin: 0 auto;">';

echo '<tr><th id="tituloTres">Ejemplo titulo tabla 3</th></tr>';	
echo '<tr>';
echo '<td id="casillaTres">';
echo "Ejemplo casilla tabla 3";
echo '</td>'; 
echo '</tr>';
echo '</table>';
echo '<br>';
echo '<br>';

echo '<div id="contenedor">'; 	
echo 'Elegir tema:';
echo '<br>';
echo '<br>';
echo '<select  id="Tema">';
echo '<option value="TemaUno">Elige una opcion</option>';
echo '<option value="TemaCero">Clasico</option>';
echo '<option value="TemaCinco">Casual</option>';
echo '<option value="TemaUno">Firmamento</option>';
echo '<option value="TemaDos">Pradera</option>';
echo '<option value="TemaTres">Cielo</option>';
echo '<option value="TemaCuatro">Fuego</option>';
echo '</select>';
echo '<br>';
echo '<br>';
echo '<input type="hidden" name="Cobro" value="';
echo $_REQUEST['Cobro'];
echo '">';
echo '<input class="botonsubmit" id="botonsubmit" type="submit" value="Aplicar Tema">';
echo '<br><br><br>';
echo '<a href="Lobby.php">Ir a Lobby</a>';
echo '<br>';
echo '</div>';
?>
<script>
var punn;
var tituloPrincipal;
var tituloUno;
var casillaUno;
var tituloDos;
var casillaDos;
var tituloTres;
var casillaTres;
var contenedor;
var botonsubmit;

addEventListener('load',inicio,false);
function inicio(){
	  cargar_controles();
	  document.getElementById('Tema').addEventListener('change',cambioTema,false);
	  cargar_colores();	  
}
function cargar_controles(){
	punn=document.getElementById('Tema');
	tituloPrincipal=document.getElementById('tituloPrincipal');
	tituloUno=document.getElementById('tituloUno');	
	casillaUno=document.getElementById('casillaUno');
	tituloDos=document.getElementById('tituloDos');
	casillaDos=document.getElementById('casillaDos'); 
	tituloTres=document.getElementById('tituloTres'); 
	casillaTres=document.getElementById('casillaTres');
	contenedor=document.getElementById('contenedor');
	botonsubmit=document.getElementById('botonsubmit');
}

function cambioTema(){	   
	if(punn.value=="TemaUno"){
		tituloPrincipal.style.fontFamily="Courier";
		document.getElementById("fuente").value = "Courier";
		tituloUno.style.backgroundColor="#34675c";
		document.getElementById("btituloUno").value ="#34675c";	 
		casillaUno.style.backgroundColor="#4CB5F5"; 
		document.getElementById("bcasillaUno").value ="#4CB5F5";
		tituloDos.style.backgroundColor="#375e97";
		document.getElementById("btituloDos").value ="#375e97";
		casillaDos.style.backgroundColor="#f1f1f2";
		document.getElementById("bcasillaDos").value ="#f1f1f2";
		tituloTres.style.backgroundColor="#BCBABE";
		document.getElementById("btituloTres").value ="#BCBABE";
		casillaTres.style.backgroundColor="#A1D6E2";
		document.getElementById("bcasillaTres").value ="#A1D6E2";
		tituloUno.style.fontFamily="Courier";
		casillaUno.style.fontFamily="Courier";
		tituloDos.style.fontFamily="Courier";
		casillaDos.style.fontFamily="Courier";
		tituloTres.style.fontFamily="Courier";
		casillaTres.style.fontFamily="Courier";
		contenedor.style.backgroundColor="#A1D6E2";
		document.getElementById("bcontenedor").value ="#A1D6E2";
		contenedor.style.fontFamily="Courier";
		botonsubmit.style.backgroundColor="#2196F3";
		document.getElementById("bboton").value ="#2196F3";
		botonsubmit.style.fontFamily="Courier";	 
	} else if (punn.value=="TemaDos"){
		tituloPrincipal.style.fontFamily="Arial";
		document.getElementById("fuente").value = "Arial";
		tituloUno.style.backgroundColor="#3f681c";
		document.getElementById("btituloUno").value ="#3f681c";  	
		casillaUno.style.backgroundColor="#89DA59";
		document.getElementById("bcasillaUno").value ="#89DA59";	
		tituloDos.style.backgroundColor="#B3C100";
		document.getElementById("btituloDos").value="#B3C100"; 
		casillaDos.style.backgroundColor="FFD64D";
		document.getElementById("bcasillaDos").value ="FFD64D";
		tituloTres.style.backgroundColor="#3edc23";
		document.getElementById("btituloTres").value ="#3edc23";
		casillaTres.style.backgroundColor="#80BD9E";
		document.getElementById("bcasillaTres").value ="#80BD9E";
		tituloUno.style.fontFamily="Arial";
		casillaUno.style.fontFamily="Arial";
		tituloDos.style.fontFamily="Arial";
		casillaDos.style.fontFamily="Arial";
		tituloTres.style.fontFamily="Arial";
		casillaTres.style.fontFamily="Arial";
		contenedor.style.backgroundColor="#80BD9E";
		document.getElementById("bcontenedor").value ="#80BD9E";
		contenedor.style.fontFamily="Arial";
		botonsubmit.style.backgroundColor="#3edc23";
		document.getElementById("bboton").value ="#3edc23";
		botonsubmit.style.fontFamily="Arial";
	}  else if (punn.value=="TemaTres"){
		tituloPrincipal.style.fontFamily="Verdana";
		document.getElementById("fuente").value = "Verdana";
		tituloUno.style.backgroundColor="#455ede"; 
	document.getElementById("btituloUno").value ="#455ede";	
		casillaUno.style.backgroundColor="#4897D8";
		document.getElementById("bcasillaUno").value ="#4897D8";	 
		tituloDos.style.backgroundColor="#40c4ff";
		document.getElementById("btituloDos").value ="#40c4ff";
		casillaDos.style.backgroundColor="#5677fc";
		document.getElementById("bcasillaDos").value ="#5677fc";
		tituloTres.style.backgroundColor="#4897D8";
		document.getElementById("btituloTres").value ="#4897D8";
		casillaTres.style.backgroundColor="#40c4ff";
		document.getElementById("bcasillaTres").value ="#40c4ff";
		tituloUno.style.fontFamily="Verdana";
		casillaUno.style.fontFamily="Verdana";
		tituloDos.style.fontFamily="Verdana";
		casillaDos.style.fontFamily="Verdana";
		tituloTres.style.fontFamily="Verdana";
		casillaTres.style.fontFamily="Verdana";
		contenedor.style.backgroundColor="#40c4ff";
		document.getElementById("bcontenedor").value ="#40c4ff";
		contenedor.style.fontFamily="Verdana";
		botonsubmit.style.backgroundColor="#455ede";
		document.getElementById("bboton").value ="#455ede";
		botonsubmit.style.fontFamily="Verdana";
	} else if (punn.value=="TemaCuatro"){
		tituloPrincipal.style.fontFamily="Arial black";
		document.getElementById("fuente").value = "Arial black";	
		tituloUno.style.backgroundColor="#ff5722";
		document.getElementById("btituloUno").value ="#ff5722";  
		casillaUno.style.backgroundColor="#f5dbdf";
		document.getElementById("bcasillaUno").value ="#f5dbdf";	 
		tituloDos.style.backgroundColor="#ff5722";
		document.getElementById("btituloDos").value ="#ff5722";
		casillaDos.style.backgroundColor="#f5dbdf";
		document.getElementById("bcasillaDos").value ="#f5dbdf";
		tituloTres.style.backgroundColor="#ff5722";
		document.getElementById("btituloTres").value ="#ff5722";
		casillaTres.style.backgroundColor="#f5dbdf";
		document.getElementById("bcasillaTres").value ="#f5dbdf";
		tituloUno.style.fontFamily="Arial black";
		casillaUno.style.fontFamily="Arial black";
		tituloDos.style.fontFamily="Arial black";
		casillaDos.style.fontFamily="Arial black";
		tituloTres.style.fontFamily="Arial black";
		casillaTres.style.fontFamily="Arial black";
		contenedor.style.backgroundColor="#f5dbdf";
		document.getElementById("bcontenedor").value ="#f5dbdf";
		contenedor.style.fontFamily="Arial black";
		botonsubmit.style.backgroundColor="#FE0000";
		document.getElementById("bboton").value ="#FE0000";
		botonsubmit.style.fontFamily="Arial black";
	} 
	else if (punn.value=="TemaCero"){
		tituloPrincipal.style.fontFamily="Courier";
		document.getElementById("fuente").value = "Courier";
		tituloUno.style.backgroundColor="#BCBABE";
		document.getElementById("btituloUno").value ="#BCBABE";	 
		casillaUno.style.backgroundColor="#f1f1f2"; 
		document.getElementById("bcasillaUno").value ="#f1f1f2";
		tituloDos.style.backgroundColor="#BCBABE";
		document.getElementById("btituloDos").value ="#BCBABE";
		casillaDos.style.backgroundColor="#f1f1f2";
		document.getElementById("bcasillaDos").value ="#f1f1f2";
		tituloTres.style.backgroundColor="#BCBABE";
		document.getElementById("btituloTres").value ="#BCBABE";
		casillaTres.style.backgroundColor="#f1f1f2";
		document.getElementById("bcasillaTres").value ="#f1f1f2";
		tituloUno.style.fontFamily="Courier";
		casillaUno.style.fontFamily="Courier";
		tituloDos.style.fontFamily="Courier";
		casillaDos.style.fontFamily="Courier";
		tituloTres.style.fontFamily="Courier";
		casillaTres.style.fontFamily="Courier";
		contenedor.style.backgroundColor="#f1f1f2";
		document.getElementById("bcontenedor").value ="#f1f1f2";
		contenedor.style.fontFamily="Courier";
		botonsubmit.style.backgroundColor="#BCBABE";
		document.getElementById("bboton").value ="#BCBABE";
		botonsubmit.style.fontFamily="Courier";
	} 
	else if (punn.value=="TemaCinco"){
		tituloPrincipal.style.fontFamily="Courier";
		document.getElementById("fuente").value = "Courier";
		tituloUno.style.backgroundColor="#ff3108";
		document.getElementById("btituloUno").value ="#ff3108";	 
		casillaUno.style.backgroundColor="#eeeeaf"; 
		document.getElementById("bcasillaUno").value ="#eeeeaf";
		tituloDos.style.backgroundColor="#ff3108";
		document.getElementById("btituloDos").value ="#ff3108";
		casillaDos.style.backgroundColor="#eeeeaf";
		document.getElementById("bcasillaDos").value ="#eeeeaf";
		tituloTres.style.backgroundColor="#ff3108";
		document.getElementById("btituloTres").value ="#ff3108";
		casillaTres.style.backgroundColor="#eeeeaf";
		document.getElementById("bcasillaTres").value ="#eeeeaf";
		tituloUno.style.fontFamily="Courier";
		casillaUno.style.fontFamily="Courier";
		tituloDos.style.fontFamily="Courier";
		casillaDos.style.fontFamily="Courier";
		tituloTres.style.fontFamily="Courier";
		casillaTres.style.fontFamily="Courier";
		contenedor.style.backgroundColor="#eeeeaf";
		document.getElementById("bcontenedor").value ="#eeeeaf";
		contenedor.style.fontFamily="Courier";
		botonsubmit.style.backgroundColor="#ff3108";
		document.getElementById("bboton").value ="#ff3108";
		botonsubmit.style.fontFamily="Courier";
	} 
}

function cargar_colores(){
 var fuente="<?PHP echo $get_colors['fuente'];?>";
 var btituloUno="<?PHP echo $get_colors['btituloUno'];?>";
 var bcasillaUno="<?PHP echo $get_colors['bcasillaUno'];?>";
 var btituloDos= "<?PHP echo $get_colors['btituloDos'];?>";
 var bcasillaDos="<?PHP echo $get_colors['bcasillaDos'];?>";
 var btituloTres="<?PHP echo $get_colors['btituloTres'];?>";
 var bcasillaTres="<?PHP echo $get_colors['bcasillaTres'];?>";
 var bcontenedor="<?PHP echo $get_colors['bcontenedor'];?>";
 var bboton="<?PHP echo $get_colors['bboton'];?>";
		tituloPrincipal.style.fontFamily=fuente;
		tituloUno.style.backgroundColor=btituloUno;
		casillaUno.style.backgroundColor=bcasillaUno; 
		tituloDos.style.backgroundColor=btituloDos;
		casillaDos.style.backgroundColor=bcasillaDos;
		tituloTres.style.backgroundColor=btituloTres;
		casillaTres.style.backgroundColor=bcasillaTres;
		tituloUno.style.fontFamily=fuente;
		casillaUno.style.fontFamily=fuente;
		tituloDos.style.fontFamily=fuente;
		casillaDos.style.fontFamily=fuente;
		tituloTres.style.fontFamily=fuente;
		casillaTres.style.fontFamily=fuente;
		contenedor.style.backgroundColor=bcontenedor;
		contenedor.style.fontFamily=fuente;
		botonsubmit.style.backgroundColor=bboton;
		botonsubmit.style.fontFamily=fuente;	 
}
</script>
</body>
</html>