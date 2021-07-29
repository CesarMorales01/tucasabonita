<?php
header('Content-type: text/html; charset=utf-8');
include("detalle_compra_web_hipertext.php");
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles.css">
	<title>Detalle compra</title>
  </head>
  <body >
 <?php
// incluyo index_hipertext en nav_bar.php
include("nav_bar.php");	
?>
<br><br>
<div class="container">
	<div class="row justify-content-center" >
      <div style="text-align: center;" class="col-4"  >
        <img  src="Imagenes_config/Logo_tucasabonita.png" width="140" height="200"> 
      </div>
      <div class="col-4"  >
        <h4>Ventas y servicios mi rey</h4>
		<p>NIT 1056300167-3<br>
		   Calle 56 #3w22. Barrio Mutis.<br>
		   Tel 316 3439744<br>
		   Bucaramanga Santander
		   contacto@tucasabonita.site
		</p>		
      </div>
	 <div class="col-2" >
        <h4 style="font-size:16px;">Factura N°</h4> 
		<p id="tv_factura_n"><?php echo $id_compra;?></p>
      </div>	  
    </div> 
	
	<br><br>
	
	
	<div class="row">
		<div class="row align-items-start col-lg-12 col-md-12">
			<div style="background-color:#f0e094;" class="col-lg-2 col-md-2" >
			<p style="text-align:center; font-weight: bold;">Cliente</p> 
			</div>
			<div class="col-lg-10 col-md-10"  >
			<p id="tv_cliente"><?php echo $nombre; ?></p>
			</div>
		</div>
    </div>
	<br>	
	<div class="row">
		<div class="row align-items-start col-lg-6 col-md-6">
			<div style="background-color:#f0e094;" class="col-lg-4 col-md-4"  >
			<p style="text-align:center; font-weight: bold;">Dirección</p> 
			</div>
			<div class="col-lg-8 col-md-8"  >
			<p id="tv_direccion"><?php echo $dir; ?></p>
			</div>
		</div>
	  
		<div class="row align-items-start col-lg-6 col-md-6">
			<div style="background-color:#f0e094;" class="col-lg-4 col-md-4"  >
			<p style="text-align:center; font-weight: bold;">Ciudad</p> 
			</div>
			<div class="col-lg-8 col-md-8"  >
			<p id="tv_ciudad" >Bucaramanga</p>
			</div>
		
		</div>	  
    </div> 
	
	<div style="margin-top:10px;" class="row">
		<div class="row align-items-start col-lg-4 col-md-4">
			<div style="background-color:#f0e094;" class="col-lg-6 col-md-6" >
			<p style="text-align:center; font-weight: bold;">NIT</p> 
			</div>
			<div class="col-lg-6 col-md-6"  >
			<p id="tv_nit"><?php echo $cedula_bd; ?></p>
			</div>
		</div>
        
		<div class="row align-items-start col-lg-4 col-md-4">
			<div style="background-color:#f0e094;" class="col-lg-6 col-md-6" >
			<p style="text-align:center; font-weight: bold;">Télefono</p> 
			</div>
			<div class="col-lg-6 col-md-6" >
			<p id="tv_telefono"><?php echo $tel; ?></p>
			</div>
		</div>
	  
		<div class="row align-items-start col-lg-4 col-md-4">
			<div style="background-color:#f0e094;" class="col-lg-6 col-md-6"  >
			<p style="text-align:center; font-weight: bold;">Fecha</p> 
			</div>
			<div class="col-lg-6 col-md-6" >
			<p id="tv_fecha" ><?php echo $fecha_compra; ?></p>
			</div>
		</div>			
    </div>
	<br><br>
	<table style="text-align:center;" class="table">
        <tr style="background-color:#f0e094;" > 
          <th>Descripcion</th> 
          <th>Cantidad</th>
          <th>Valor unitario</th>
		  <th>Subtotal</th>
        </tr>  
<?php
$get_list=$mysql->query("select * from lista_productos_comprados where cliente=$cedula_bd and compra_n=$compra_n") or die ("problemas al consultar list");
$sumar_total=0;
		while($list=$get_list->fetch_array()){
			echo '<tr>';
			echo '<td>';
			echo $list['producto'];
			echo '</td>';
			echo '<td>';
			echo $list['cantidad'];
			echo '</td>';
			echo '<td>';
			echo  "$ ".number_format($list['precio'],2,",",".");
			echo '</td>';
			echo '<td>';
			$subtotal=$list['precio']*$list['cantidad'];
			$sumar_total=$sumar_total+$subtotal;
			echo "$ ".number_format($subtotal,2,",",".");
			echo '</td>';
			echo '</tr>';
		}
?>
<br>
<tr style="background-color:#f0e094;"><th>Total a pagar</th>
<td><?php echo "$ ".number_format($sumar_total,2,",","."); ?></td></tr>
    </table>
</div>
<br><br> 	
<script src="functions.php"></script>
<script>


</script>

</body>
</html>