<?php
 //Agregamos la libreria FPDF
 require('pdf/fpdf.php');
 include("detalle_compra_web_hipertext.php");
 $pdf = new FPDF(); //Creamos un objeto de la librería
 $pdf->AddPage(); //Agregamos una Pagina
 $pdf->SetFont('Times','',12); //Establecemos tipo de fuente, negrita y tamaño 16
 
//Agregamos texto en una celda de 40px ancho y 10px de alto, Con Borde, Sin salto de linea y Alineada a la derecha
 $pdf->Image('http://tucasabonita.site/Imagenes_config/Logo_tucasabonita.png',45,10,20,0,'PNG');
 
 $pdf->setXY(75,10); 
 $pdf->Cell(40,10,"Ventas y servicios mi rey",2,0,'L'); 
 $pdf->setXY(75,16);
 $pdf->Cell(40,10,'NIT 1056300167-3',3,0,'L'); 
 $pdf->setXY(75,22);
 $pdf->Cell(40,10,'Calle 56 #3w22. Barrio Mutis.',3,0,'L');
 $pdf->setXY(75,30);
 $pdf->Cell(40,10,'Tel 316 3439744',3,0,'L');
 $pdf->setXY(75,36);
 $pdf->Cell(40,10,'Bucaramanga Santander',3,0,'L');
 $pdf->setXY(75,42);
 $pdf->Cell(40,10,'contacto@tucasabonita.site',3,0,'L');
 
 $pdf->setXY(140,10);
 $pdf->Cell(40,10,'Factura numero',3,0,'L');
 $pdf->setXY(140,16);
 $pdf->Cell(40,10,$id_compra,3,0,'L');
 
 // datos cliente
 $pdf->setXY(10,70);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(26,10,'Cliente',0,1,'C',1);
 $pdf->setXY(40,70);
 $pdf->Cell(40,10,$nombre,3,0,'L');
 
 $pdf->setXY(10,84);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(26,10,utf8_decode('Dirección'),0,1,'C',1);
 $pdf->setXY(40,84);
 $pdf->Cell(40,10,utf8_decode($dir),3,0,'L');
 
 $pdf->setXY(120,84);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(26,10,utf8_decode('Ciudad'),0,1,'C',1);
 $pdf->setXY(150,84);
 $pdf->Cell(40,10,utf8_decode("Bucaramanga"),3,0,'L');
 
 $pdf->setXY(10,96);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(26,10,'NIT',0,1,'C',1);
 $pdf->setXY(40,96);
 $pdf->Cell(40,10,$cedula,3,0,'L');
 
 $pdf->setXY(70,96);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(26,10,utf8_decode('Télefono'),0,1,'C',1);
 $pdf->setXY(96,96);
 $str = strtok($tel, ' ');
 $telefono1= strtok(' ');
 $pdf->Cell(40,10,$telefono1,3,0,'L');
 
 $pdf->setXY(120,96);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(26,10,'Fecha',0,1,'C',1);
 $pdf->setXY(150,96);
 $pdf->Cell(40,10,$fecha_compra,3,0,'L');
 
 // Titulo tabla articulos
 
 $pdf->setXY(10,120);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(80,10,utf8_decode("Descripción"),0,1,'C',1);
 $pdf->setXY(80,120);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(40,10,"Cantidad",3,0,'C',1);
 $pdf->setXY(120,120);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(40,10,"Valor unitario",3,0,'C',1);
 $pdf->setXY(160,120);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(40,10,"Subtotal",3,0,'C',1);
 
 
$get_list=$mysql->query("select * from lista_productos_comprados where cliente=$cedula and compra_n=$compra_n") or die ("problemas al consultar list");
$sumar_total=0;

$posy=130;
		while($list=$get_list->fetch_array()){
			$posx=10;
			$pdf->setXY($posx,$posy);
			$pdf->Cell(80,10,utf8_decode($list['producto']),3,0,'C');
			
			$posx_cantidad=$posx+70;
			$pdf->setXY($posx_cantidad,$posy);
			$pdf->Cell(40,10,$list['cantidad'],3,0,'C');
			
			$posx_unit=$posx+110;
			$pdf->setXY($posx_unit,$posy);
			$unit="$ ".number_format($list['precio'],2,",",".");
			$pdf->Cell(40,10,$unit,3,0,'C');

			$posx_sub=$posx+150;
			$subtotal=$list['precio']*$list['cantidad'];
			$sumar_total=$sumar_total+$subtotal;
			$pdf->setXY($posx_sub,$posy);
			$subtotal="$ ".number_format($subtotal,2,",",".");
			$pdf->Cell(40,10,$subtotal,3,0,'C');
			$posy=$posy+10;
		}
 // total pagar
 $posy_total=$posy+15;
 $pdf->setXY(10,$posy_total);
 $pdf->SetFillColor(240, 224, 148);
 $pdf->Cell(36,10,'Total a pagar ',0,1,'C',1);
 $pdf->setXY(44,$posy_total);
 $pdf->SetFillColor(240, 224, 148);
 $sumar_total="$ ".number_format($sumar_total,2,",",".");
 $pdf->Cell(44,10,$sumar_total,0,1,'C', 1);
 
 $pdf->Output(); //Mostramos el PDF creado
?>