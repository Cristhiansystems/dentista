<?php
require("../conexion.php");
require('../FPDF/fpdf.php');
class PDF extends FPDF{
	
	function AcceptPageBreak(){
		$this->AddPage();
		$this->SetFillColor(232,232,232);
$this->SetFont('Arial','B',12);
$this->SetX(15);
$this->Cell(30,6,'CI',1,0,'C',1);
$this->SetX(45);
$this->Cell(30,6,'NOMBRE',1,0,'C',1);
$this->SetX(75);
$this->Cell(30,6,'A. PATERNO',1,0,'C',1);
$this->SetX(105);
$this->Cell(30,6,'A. MATERNO',1,0,'C',1);
$this->SetX(135);
$this->Cell(30,6,'CELULAR',1,0,'C',1);

$this->Ln();
$this->SetX(15);
		
		}
		
		function Header(){
	$this->Image('../imagenes/logorep.jpeg', 10,10,80);
			$fi=$_GET['fi'];
$ff=$_GET['ff'];
	$this->SetFont('Arial','B', 15);
				$this->Ln(5);
	$this->Cell(120);
		
			$this->SetFont('Arial','B', 10);
	$this->Cell(20,16,"FECHA",1,0,'C');
	$this->Cell(15,8,"DIA",1,0,'C');
	$this->Cell(15,8,"MES",1,0,'C');
	$this->Cell(15,8,utf8_decode("AÑO"),1,1,'C');
			$this->Cell(140);
			$this->Cell(15,8,date("d"),1,0,'C');
	$this->Cell(15,8,date("m"),1,0,'C');
	$this->Cell(15,8,date("Y"),1,1,'C');
		$this->Ln(15);
			$this->SetFont('Arial','B', 15);
	$this->Cell(80);
	$this->Cell(30,10,"REPORTE DE VENTAS" ,0,1,'C');
			
				$this->Cell(80);
	$this->Cell(30,10,"$fi - $ff" ,0,1,'C');
	$this->Ln(5);
	
	
	}	
			
	}

$fi=$_GET['fi'];
$ff=$_GET['ff'];
$ci=$_GET['ci'];	

$registros=$base->query("Select venta.id_venta, venta.precio, venta.registro, cliente.nombre, cliente.apellido_paterno From venta INNER JOIN cliente on cliente.id_cliente=venta.id_cliente where ci='$ci' and venta.estado='activo' and venta.tipo='Venta' or venta.registro between '$fi' and '$ff' and venta.estado='activo' and venta.tipo='Venta' order by id_venta");


$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(15);
$pdf->Cell(30,6,'Venta',1,0,'C',1);
$pdf->SetX(45);
$pdf->Cell(70,6,'Cliente',1,0,'C',1);
$pdf->SetX(115);
$pdf->Cell(30,6,'Fecha',1,0,'C',1);
$pdf->SetX(145);
$pdf->Cell(30,6,'Precio',1,0,'C',1);
$pdf->Ln();
$total=0;
while($row=$registros->fetch(PDO::FETCH_ASSOC)){
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(15);
$pdf->Cell(30,6,utf8_decode($row['id_venta']),1,0,'L');
$pdf->SetX(45);
$pdf->Cell(70,6,utf8_decode($row['nombre'] . " " . $row['apellido_paterno']),1,0,'L');
$pdf->SetX(115);
$pdf->Cell(30,6,utf8_decode($row['registro']),1,0,'L');
$pdf->SetX(145);
$total=$total + $row['precio'];
$total=number_format($total,2);
$pdf->Cell(30,6,utf8_decode($row['precio']),1,1,'R');

	
	}
$pdf->SetX(15);
$pdf->Cell(130,6,"Total Bs",1,0,'C',1);
$pdf->Cell(30,6,$total,1,0,'R');

$pdf->Output();
?>