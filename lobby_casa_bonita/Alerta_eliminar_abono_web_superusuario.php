 <link rel="StyleSheet" href="estilos.php" type="text/css">  <title>Formulario de entrada del dato</title>   </head>   <body>  <br>  <h1>Eliminar abono?</h1>  <?PHP$id=$_REQUEST['id'];$cedula=$_REQUEST['cedula'];$Cobro=$_REQUEST['Cobro'];  echo '<a href="Eliminar_abono_web_superusuario.php?id='.$id.'&Cobro='.$Cobro.'&cedula='.$cedula.'">Si. Eliminar el abono.</a>';  ?></body> </html>