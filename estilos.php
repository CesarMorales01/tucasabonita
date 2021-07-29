<?php 
header('Content-type: text/css');

include("datos.php");
$conexion=mysqli_connect($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die("Problemas al conectar");	
$get_settings="SELECT * FROM settings";
$get=mysqli_query($conexion,$get_settings);

if($get_settings0=$get->fetch_array()){}

 ?>

head, body {
  text-align:center;
}

h1,h2 {
  color:#555555;
  font-family:<?php echo $get_settings0['fuente']; ?>;
  font-size:25px;
  text-align:center;
  font-weight: bold;   
}

p {
  color:#555555;
  font-family:<?php echo $get_settings0['fuente']; ?>;
  text-align:center;
}



// TABLA Amarrilla usada en totales/cuadrando cuentas
.tablalistado {
    border-collapse: collapse;
    box-shadow: 0px 0px 8px #000;
    margin:20px;
  }

  .tablalistado th{
    font-family:<?php echo $get_settings0['fuente']; ?>; 	  
    border: 3px solid #000;
    text-align: center;
    padding: 10px;
    background-color:<?php echo $get_settings0['btituloUno']; ?>;      
  }  

  .tablalistado td{  
    font-family:<?php echo $get_settings0['fuente']; ?>;
    border: 5px solid #000;
    text-align: center;
    font-size:18px;
    padding: 10px;
    background-color:<?php echo $get_settings0['bcasillaUno']; ?>;      
  }

 

// TABLA Abonos/listas
   .tablalistado1 {
    border-collapse: collapse;
    box-shadow: 0px 0px 8px #000;
  }

  .tablalistado1 th{ 
	font-family:<?php echo $get_settings0['fuente']; ?>;
    border: 3px solid #212121;
    padding: 5px;
    background-color: <?php echo $get_settings0['btituloDos']; ?>; 
    text-align: center;
  }  

  .tablalistado1 td{  
    font-family:<?php echo $get_settings0['fuente']; ?>;
    border: 3px solid #212121;
    padding: 5px;
    background-color:<?php echo $get_settings0['bcasillaDos']; ?>;  
    text-align: center;
  }
  
  // TABLA ENCABEZADO
  
.tabencabezado {
      border-collapse: collapse;
      box-shadow: 0px 0px 8px #000;
      margin: 20px;
      position: fixed;
  }
  
  .tabencabezado th {
	    font-family:<?php echo $get_settings0['fuente']; ?>; 
      border: 4px solid #212121;
      padding: 5px;
      background-color: <?php echo $get_settings0['btituloTres']; ?>;
  }
  
  .tabencabezado td {
	    font-family:<?php echo $get_settings0['fuente']; ?>;
      border: 3px solid #212121;
      padding: 5px;
      background-color: <?php echo $get_settings0['bcasillaTres']; ?>;
      text-align: center;
  }
  
  .tabalerta{ 
      border-collapse: collapse;
      box-shadow: 0px 0px 8px #000;
      margin: 20px;  
  }

  .tabalerta th{
	  font-family:<?php echo $get_settings0['fuente']; ?>;
      border: 4px solid #212121;
      padding: 5px;
      background-color: #E64A19;
      text-align: center;
  }
  
  .tabalerta td{
	  font-family:<?php echo $get_settings0['fuente']; ?>;
      border:3px solid #212121;
      padding: 4px;
      background-color: #F44336;
      text-align: center;
  }

  #contenedor {
  width:500px; 
  margin-left:20px; 
  margin-top:10px;
  background-color:<?php echo $get_settings0['bcontenedor']; ?>;
  border:1px solid #CCC;
  padding:10px 0 10px 0;
  margin: 0 auto;
  font-family:<?php echo $get_settings0['fuente']; ?>;
}

#contenedor form label {
  width:120px; 
  float:left;
  font-family:<?php echo $get_settings0['fuente']; ?>;
  font-size:14px;
  margin: 0 auto;
}

.botonsubmit {
  background-color:<?php echo $get_settings0['bboton']; ?>; 
  border: 3px solid #212121;
  font-family:<?php echo $get_settings0['fuente']; ?>;
  
}

.botonactivado {
  background-color:#FFF9C4;
  color:#0101DF;
}

.botonactivado:hover {
  background: #336699;
}

.botonactivado:focus {
  background: #40FF00;
}

.botondesactivado {
  background-color:#FFF9C4;
  color:#DF0101;
}

.botondesactivado:hover {
  background: #336699;
}

.botondesactivado:focus {
  background: #40FF00;
}

.scroll {
overflow:scroll;
width: 650px;
height: 400px;
margin: 0 auto;
}

.scroll_1casilla {
overflow:scroll;
width: 300px;
height: 40px;
margin: 0 auto;
}

a:focus {
  display: block;
  color: #40FF00;
}


a:hover {
  background-color: #336699;
  color: #ffffff;
}

#recuadro {
  background-color:<?php echo $get_settings0['tablalistado_th_bk']; ?>;
  border:1px solid #000000;
  font-size:10px;
  font-family:<?php echo $get_settings0['fuente']; ?>;
}

.centrado{
	margin:10px auto;
	display:block;
	width: 350px; height: 300px;
    }
	
.centrado_texto{
	margin:10px auto;
	display:block;
	width: 750px; 
    }	
	
.enmarcar_imagen{
	margin:10px auto;
	display:block;
	width: 350px; height: 300px;
	border:3px solid #000; /* ancho - tipo - color */
    padding:10px; /* distancia entre la img y el borde */  
    }
		

#header {
  width:800px;
  font-family:Arial, Helvetica, sans-serif;
  margin-left:-280px;
  position: absolute;
  display:block;
  left:50%;
  font-size:16px;
}

#alineado-izquierda {
 margin-left:-580px;
}

.nav ul{
list-style:none;
display:inline;
}

.nav li a {
	background-color:#000;
	color:#fff;
	text-decoration:none;
	padding:10px 15px;
	display:block;
	margin:5px;	
}	

.nav li {
  float:left; 
}

.nav li a:hover {
	background-color:#434343;	
}


.centrar {
text-align: center;
}

.centrar img {
text-align: left;
}

#lateral{
float:left;
margin-left:250px;
}

#principal{
float:right;
margin-right:250px;
}

#flexbox {
  display: flex;
  display: inline-block;
}

.vert_redon{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 1.2em;
    color: #FFFFFF; 
    border-radius: 20px; /* controla el grado de redondeado del vertice */   
    width: 300px;   
    padding: 20px;   
    border: 1px solid #CCCCCC;   
    background-color:#CD5C5C;
    } 	