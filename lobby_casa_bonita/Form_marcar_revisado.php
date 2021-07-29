<html> 
  <head> 
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="StyleSheet" href="estilos.php" type="text/css">
  <style>
              label.checkbox.special { cursor: pointer; }
              label.checkbox.special input[type="checkbox"] { position: absolute; margin-left: 5px; opacity: 0; }
              label.checkbox.special input[type="checkbox"] + span:before {
              border: 1px solid #999;
              border-radius: 2px;
              color: #333;
              padding: 2px 1px;
              line-height: 8px;
              font-size: 30px;
              cursor: pointer;
              position: relative;
              top: 1px;
              display: inline-block;
              margin-right: 10px;
              vertical-align: text-bottom;
              -webkit-font-smoothing: antialiased;
              -moz-osx-font-smoothing: grayscale;
              width: 20px;
              height: 20px;
          }
          label.checkbox.special input[type="checkbox"] + span:before { content: ""; }
          label.checkbox.special input[type="checkbox"]:checked + span:before { content: '\2713' }
        </style>
  <title>Revisado</title> 
  </head> 
  <body style="background-image: url('Imagenes/fondo_blanco.jpg'); background-position: center center;	  
	background-repeat: no-repeat;	background-attachment: fixed; background-size: cover;" >
  <br>
  <?PHP
  include("datos.php");
 $cobro=$_REQUEST['Cobro'];
 $cedula=$_REQUEST['cedula'];
 $asesor=$_REQUEST['asesor'];
 $cliente=$_REQUEST['nombre'];
  ?>
   <div class="container justify-content-justify">   
        <div class="jumbotron">
        <h4 class="text-center">Marcar como revisado?</h4>
        <br>        
        <form method="post" action="marcar_revisado.php" id="Form_marcar_revisado">
        <label >Asesor</label> 
        <br>
        <input type="text" style="WIDTH: 258px; HEIGHT: 28px" name="asesor"  size="26" id="asesor" value="<?PHP echo $asesor;?>">
        <input type="hidden" id="cedula" name="cedula" value="<?PHP echo $cedula;?>">
        <input type="hidden" id="cobro" name="cobro" value="<?PHP echo $cobro;?>">  
        <br> <br>
        <label >Fecha</label> 
        <br>
        <input type="date" style="WIDTH: 145px;" name="fecha"  id="fecha"> 
        <br> <br>  
        <label>Cliente</label>
        <br>
        <input type="text" disabled style="WIDTH: 258px; HEIGHT: 28px" name="cliente" size="26" id="cliente" value="<?PHP echo $cliente;?>">  
        <br>
        <br>  
        <label>Cliente con tarjeta?</label>
        <label for="test1" class="checkbox special"><input type="checkbox" id="test1" name="test1"><span></span></label>
        <br>
        <textarea name="comentarios" placeholder="Comentarios..." id="comentarios" rows="4" cols="36"></textarea>
        <br><br>
        <input class="botonsubmit" type="submit" value="Confirmar">
        </div>
        </form>
    </div> 
<script>
window.addEventListener('load', cargarFunciones, false);
function cargarFunciones() {
	   document.getElementById("Form_marcar_revisado").addEventListener('submit', validar, false);
     cargar_fecha();
  }

  function cargar_fecha() {
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
        dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
        mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('fecha').value=ano+"-"+mes+"-"+dia;
  }

  var conexion1;
  function validar(evt) {
    evt.preventDefault();
    conexion1=new XMLHttpRequest();
    conexion1.onreadystatechange = recepcionarDatos;
     conexion1.open('POST','marcar_revisado.php', true);
    conexion1.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    conexion1.send(enviarDatos());  
  
  }

  function enviarDatos(){
  var cadena='';
  var cedula=document.getElementById('cedula').value;
  var asesor=document.getElementById('asesor').value;
  var fecha=document.getElementById('fecha').value;
  var cobro=document.getElementById('cobro').value;
  var checkBox=document.getElementById('test1').checked;
  var comentarios=document.getElementById('comentarios').value;
  cadena='cedula='+encodeURIComponent(cedula)+'&asesor='+encodeURIComponent(asesor)+'&fecha='+encodeURIComponent(fecha)+'&cobro='+encodeURIComponent(cobro)+'&checkBox='+encodeURIComponent(checkBox)
  +'&comentarios='+encodeURIComponent(comentarios); 
  return cadena;
}

function recepcionarDatos(){
  if(conexion1.readyState == 4){ 
    var datos=conexion1.responseText;
    var url='<?php echo $url;?>';
    var pagina=url+"/Form_%20detalle_cuentas_todos.php?cedula="+datos;
    location.href=pagina;
  }
}
</script>        
</body> 
</html>