<html>  <link rel="StyleSheet" href="estilos.php" type="text/css">  <head>  <title>Formulario ingresar claves</title>   </head>   <body> <br> <br> <br>  <h1> Ingresar datos en crear clave: </h1>  <form method="post" action="Ingresar_datos_crear_clave_micro.php">      Lugar expedicion:  <input type="text" name="lugarexp">   <br> <br>   Fecha expedicion:  <input type="text" name="fechaexp">   <br> <br>    Nombre:  <input type="text" name="nombre" size="30"  value="<?php   if(isset($_REQUEST['nombre'])){	 echo $_REQUEST['nombre'];   } ?>"  >   <br> <br>     Cedula:  <input type="text" name="cedula" size="30"  value="<?php   if(isset($_REQUEST['cedula'])){	 echo $_REQUEST['cedula'];   } ?>"  >   <br> <br>   <input type="submit" value="Ingresar datos">   </form></body> </html>