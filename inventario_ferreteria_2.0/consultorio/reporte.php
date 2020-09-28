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
	$this->Image('../imagenes/logorep.jpeg', 10,10,50);
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
	$this->Cell(30,10,"REPORTE DE CONSULTORIOS" ,0,1,'C');
	$this->Ln(10);
	
	
	}	
			
	}
	$estado=$_GET["estado"];
		$registros=$base->query("SELECT  cons.id_consultorio, cons.nombre as consultorio, age.nombre as agencia FROM tbl_consultorios cons INNER JOIN tbl_agencias age on cons.id_agencia=age.id_agencia  where cons.estado='$estado' order by  cons.id_consultorio ");

$busc_empl=$_GET["criterio"];	

if($busc_empl!=""){
$registros=$base->query("SELECT cons.id_consultorio, cons.nombre as consultorio, age.nombre as agencia FROM tbl_consultorios cons INNER JOIN tbl_agencias age on cons.id_agencia=age.id_agencia  where cons.estado='$estado' and cons.nombre like '%$busc_empl%' or cons.estado='$estado' and  age.nombre like '%$busc_empl%'  order by  cons.id_consultorio ");
}


$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(35);
$pdf->Cell(70,6,'AGENCIA',1,0,'C',1);
$pdf->SetX(105);
$pdf->Cell(70,6,utf8_decode('CONSULTORIO'),1,0,'C',1);
$pdf->SetX(75);

$pdf->Ln();
while($row=$registros->fetch(PDO::FETCH_ASSOC)){
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(35);
$pdf->Cell(70,6,utf8_decode($row['agencia']),1,0,'L');
$pdf->SetX(105);
$pdf->Cell(70,6,utf8_decode($row['consultorio']),1,1,'L');
$pdf->SetX(75);


	
	}
$pdf->Output();
?>