<?php
require("../conexion.php");
require('../FPDF/fpdf.php');
class PDF extends FPDF{
	
	function AcceptPageBreak(){
		$this->AddPage();
		$this->SetFillColor(232,232,232);
$this->SetFont('Arial','B',10);
$this->Cell(60,6,'EMPLEADO',1,0,'C',1);
$this->SetX(70);
$this->Cell(23,6,utf8_decode('CI'),1,0,'C',1);
$this->SetX(93);
$this->Cell(30,6,utf8_decode('CELULAR'),1,0,'C',1);
$this->SetX(123);
$this->Cell(50,6,utf8_decode('FECHA DE NACIMIENTO'),1,0,'C',1);
$this->SetX(170);
$this->Cell(35,6,utf8_decode('TIPO DE EMP.'),1,0,'C',1);
$this->SetX(205);
$this->Cell(60,6,utf8_decode('DIRECCIÓN'),1,0,'C',1);
$this->SetX(265);
$this->Cell(20,6,utf8_decode('FOTO'),1,0,'C',1);

$this->Ln();

		
		}
		
		function Header(){
	$this->Image('../imagenes/logorep.jpeg', 10,10,50);
	$this->SetFont('Arial','B', 15);
				$this->Ln(5);
	$this->Cell(190);
		
			$this->SetFont('Arial','B', 10);
	$this->Cell(30,16,"FECHA",1,0,'C');
	$this->Cell(15,8,"DIA",1,0,'C');
	$this->Cell(15,8,"MES",1,0,'C');
	$this->Cell(15,8,utf8_decode("AÑO"),1,1,'C');
			$this->Cell(220);
			$this->Cell(15,8,date("d"),1,0,'C');
	$this->Cell(15,8,date("m"),1,0,'C');
	$this->Cell(15,8,date("Y"),1,1,'C');
		$this->Ln(15);
			$this->SetFont('Arial','B', 15);
	$this->Cell(80);
	$this->Cell(100,10,"REPORTE DE EMPLEADOS" ,0,1,'C');
	$this->Ln(10);
	
	
	}	
			
	}
	$estado=$_GET["estado"];
		$registros=$base->query("SELECT   emp.id_empleado,concat_ws(' ',emp.nombre,emp.apellido_paterno,emp.apellido_materno) as empleado, concat_ws(' ',emp.ci,emp.extension) as ci , emp.celular, emp.fecha_nacimiento ,emp.login ,emp.foto,emp.tipo_empleado,emp.direccion  FROM tbl_empleados emp where emp.estado='$estado'");

$busc_empl=$_GET["criterio"];	

if($busc_empl!=""){
$registros=$base->query("SELECT  emp.id_empleado,concat_ws(' ',emp.nombre,emp.apellido_paterno,emp.apellido_materno) as empleado, concat_ws(' ',emp.ci,emp.extension) as ci , emp.celular, emp.fecha_nacimiento ,emp.login ,emp.foto,emp.tipo_empleado,emp.direccion  FROM tbl_empleados emp where emp.estado='$estado' and concat_ws(' ',emp.apellido_paterno,emp.apellido_materno) like '%$busc_empl%'or emp.estado='$estado' and emp.nombre like '%$busc_empl%' order by emp.id_empleado");
}


$pdf= new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,6,'EMPLEADO',1,0,'C',1);
$pdf->SetX(70);
$pdf->Cell(23,6,utf8_decode('CI'),1,0,'C',1);
$pdf->SetX(93);
$pdf->Cell(30,6,utf8_decode('CELULAR'),1,0,'C',1);
$pdf->SetX(123);
$pdf->Cell(50,6,utf8_decode('FECHA DE NACIMIENTO'),1,0,'C',1);
$pdf->SetX(170);
$pdf->Cell(35,6,utf8_decode('TIPO DE EMP.'),1,0,'C',1);
$pdf->SetX(205);
$pdf->Cell(60,6,utf8_decode('DIRECCIÓN'),1,0,'C',1);
$pdf->SetX(265);
$pdf->Cell(20,6,utf8_decode('FOTO'),1,0,'C',1);





$pdf->Ln();
while($row=$registros->fetch(PDO::FETCH_ASSOC)){
	$pdf->SetFont('Arial','',10);
$pdf->SetX(10);
$pdf->Cell(60,20,utf8_decode($row['empleado']),1,0,'L');
$pdf->SetX(70);
$pdf->Cell(23,20,utf8_decode($row['ci']),1,0,'L');
$pdf->SetX(93);
$pdf->Cell(30,20,utf8_decode($row['celular']),1,0,'L');
$pdf->SetX(123);
$pdf->Cell(47,20,utf8_decode($row['fecha_nacimiento']),1,0,'L');
$pdf->SetX(170);
$pdf->Cell(35,20,utf8_decode($row['tipo_empleado']),1,0,'L');
$pdf->SetX(205);
$pdf->Cell(60,20,utf8_decode($row['direccion']),1,0,'L');
$pdf->SetX(265);
$pdf->Cell(20,20,$pdf->Image($row['foto'], $pdf->GetX(), $pdf->GetY(),20,20),1,1);



	
	}
$pdf->Output();
?>