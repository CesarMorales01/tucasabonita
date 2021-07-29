<?PHP
include("datos.php");
include("index_hipertext.php");

echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
echo '<script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>';
echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>';
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>';
echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>';
echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>';
echo '<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">';
echo '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';

echo '<nav style="background-color:#FF0000;" class="navbar navbar-expand-md">';
echo '<div class="container">	';
echo '    <button style="background-color:white;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#opciones">';
echo '      <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>';
echo '    </button>';

echo '<a class="navbar-brand" href="https://tucasabonita.site/"> <img src="Imagenes_config/ico_app_foreground.png" width="60" height="60">';
echo '<span style="color:white;">Tu casa bonita</span></a>';
    

echo '    <div class="collapse navbar-collapse" id="opciones">  '; 
echo '      <ul class="navbar-nav">';
echo '        <li class="nav-item">';
echo '		  <form id="form_autocomplete" action="Searched.php" method="post">';
echo '          <input type="text" size="10" id="input_autocomplete">';
echo '		  <input type="hidden" name="lookingfor" id="lookingfor">';
echo '		  <a onclick="limpiar_autocomplete()" id="btn_limpiar_autocomplete" style="display:none;"><i class="fas fa-window-close"></i></a>';
echo '		  <button type="submit" style="background-color:#f9f9c5;"><i class="fas fa-search"></i></button>';
echo '		  </form>';
 echo '       </li> ';   
echo '	  <div  class="dropdown">';
echo '      <a style="margin-left:30px; font-size:18px; background-color:#FF0000; color:white; cursor:pointer;" id="dropdown1" data-toggle="dropdown">';
echo '        <span > Categorias  <i size="5x;" class="far fa-caret-square-down"></i></span>';
echo '      </a>';
echo '      <div class="dropdown-menu">';

	  for($i=0;$i<count($categorias);$i++){
      echo  '<a style="cursor:pointer;" class="dropdown-item" onclick="mostrar_todo_categoria(';
	  echo $i;
	  echo ')">';
	  echo $categorias[$i];
	  echo '</a>';
	  }
	
echo '      </div>';
echo '      </div>'; 
	  
echo '	 <div class="dropdown-divider"></div> ';
echo '	 <div  class="dropdown">';
echo '      <a onclick="ir_login()" style="margin-left:30px; font-size:18px; background-color:#FF0000; color:white; cursor:pointer;" id="dropdown2" data-toggle="dropdown"> ';
echo '        <span id="dropdown_login"> Ingresar</span><i size="5x;" class="far fa-caret-square-down"></i>';
echo '      </a>';
echo '      <div style="cursor:pointer;" id="div_dropdown" class="dropdown-menu">';
echo '        <a class="dropdown-item" onclick="my_profile()" >Mis datos</a>';
echo '        <a class="dropdown-item" onclick="ir_mis_compras()" >Mis compras</a>';
echo '       <a class="dropdown-item" onclick="close_session()" >Salir</a>';
echo '      </div>';
echo '    </div> '; 
	  
echo '	<div class="dropdown-divider"></div>  ';
echo '	<li class="nav-item">';
echo '         <button onclick="ir_carrito()" style="margin-left:30px; background-color:#FF0000; color:white; cursor:pointer;" type="button" class="btn btn-primary">';
echo '      <i class="fas fa-shopping-cart"></i><span id="icono_carrito" class="badge badge-pill badge-light ml-1">0</span>';
echo '    </button>';
echo '    </li>  '; 
	  
	  
	  
echo '	<div class="dropdown-divider"></div>	';
echo '		<li class="nav-item">';
echo '          <a style="margin-left:30px; font-size:18px; background-color:#FF0000; color:white; cursor:pointer;" class="nav-link" onclick="ir_contacto()" >Contáctenos</a>';
 echo '       </li>  ';          
echo '      </ul>';
echo '    </div>';
echo '	</div>';
echo '  </nav>';
?>