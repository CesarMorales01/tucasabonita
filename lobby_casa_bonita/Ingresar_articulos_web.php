<?php 
include("datos.php");
if(isset($_POST['productos'])){
    $cedula=$_REQUEST['cedula'];
	$compra_n=$_REQUEST['compra_n'];
	$fecha="'".$_REQUEST['fecha_prest']."'";
	$n_cuotas=$_REQUEST['n_cuotas'];
	$periodicidad=$_REQUEST['periodicidad'];
	$cantidad=$_POST['cantidad'];
	$ids=$_POST['productos'];
	 $size_array= count($ids, COUNT_RECURSIVE);
	 $total_compra="0";
	for($x=0;$x<=$size_array-1;$x++){  
	   $codigo= $ids[$x];
	   $cant=$cantidad[$x];
	   $conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
	   // ingresar lista productos comprados
	   $consultar=$mysql->query("SELECT * from productos where id=$codigo") or die ("problemas en consulta");
	   
	   if($get=$consultar->fetch_array()){
		   $producto="'".$get['nombre']."'";
		   $descripcion="'".$get['descripcion']."'";
		   $precio=$get['valor'];
		   $mult=$precio*$cant;
		   $total_compra=$total_compra+$mult;
		   $insert=$mysql->query("insert into lista_productos_comprados (cliente, compra_n, codigo, producto, descripcion, cantidad, precio) VALUES ($cedula, $compra_n, $codigo, $producto, $descripcion, $cant, $precio)") or die ("problemas al insertar");
			if($insert){
			echo $response = "registrada"; 	
			}
	   }
	}
	
	if($periodicidad=="quincenal"){
			$resp= $n_cuotas/2;
		}
		if($periodicidad=="semanal"){
			$resp= $n_cuotas/4;
		}
		if($periodicidad=="mensual"){
			$resp= $n_cuotas/1;
		}
		
	   $interes="0.1";
	   $interes_mes=$total_compra*$interes;
		$tt_interes=$resp*$interes_mes;	
		$totalapagar=$total_compra+$tt_interes;	
		$valor_cuotas=$totalapagar/$n_cuotas;
		$espacio=" ";
		$valor_cuotas=number_format($valor_cuotas,2,",",".");
	   $descripcion_credito=$n_cuotas.$espacio.$periodicidad.$espacio.$valor_cuotas;
	   $descripcion_credito="'".$descripcion_credito."'";
       $periodicidad="'".$periodicidad."'";
	   $estado="Recibida";
	   $estado="'".$estado."'";
	   $medio_pago="Pago a credito";
	   $medio_pago="'".$medio_pago."'";
			   // ingresar lista compras
			   $insert1=$mysql->query("insert into lista_compras (cliente, compra_n, fecha, total_compra, descripcion_credito, n_cuotas, periodicidad, medio_de_pago, estado) VALUES ($cedula, $compra_n, $fecha, $total_compra, $descripcion_credito, $n_cuotas, $periodicidad, $medio_pago, $estado)") or die ("problemas al insertar lista compras");
			if($insert1){
				$notificacion="Se ha ingresado el credito";
				header("Location: $url/Form_%20detalle_cuentas_todos.php?cedula=$cedula");
			}
}
 ?>