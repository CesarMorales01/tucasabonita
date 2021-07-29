<!doctype html>

<html>

<head>

<link rel="StyleSheet" href="estilos.php" type="text/css">

 <title>Advertencias</title>

</head>  

<body>

      <br> <br> 

   <h1>Advertencias </h1>

     <br> <br> 
     
  <?php
 
 include("datos.php");
if(isset($_REQUEST['Cobro'])){
$Cobro=$_REQUEST['Cobro'];
}

 $mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);

    if ($mysql->connect_error) die("Problemas con la conexiÃ³n a la base de datos");

$registros=$mysql->query("SELECT Titulo, Descripcion FROM copia_promos where url='ad'") or die ("problemas en la consulta");

 echo '<table class="tabencabezado"style="margin: 0 auto;">';

    echo '<tr><th>Titulo</th><th>Descripcion</th></tr>';

    while ($reg=$registros->fetch_array())

    {

      echo '<tr>';

      echo '<td>';

      echo $reg['Titulo'];

      echo '</td>';      

      echo '<td>';

      echo $reg['Descripcion'];      

      echo '</td>';   

      echo '</tr>';      

    } 
   echo '</table>';
 echo '<br>'; 
 echo '<br>'; 
 echo '<a href="Form_lista_cobrado.php?cobro='.$Cobro.'">Ver listas cobrados cobrandoapp</a>';

  ?> 

  <br>

</body>

</html>