<?php
require("../conexion.php");
require('../FPDF/fpdf.php');
class PDF extends FPDF{
	
	function AcceptPageBreak(){
		$this->AddPage();
		$this->SetFillColor(232,232,232);
$this->SetFont('Arial','B',10);
$this->Cell(30,6,'CODIGO PACIENTE',1,0,'C',1);
$this->SetX(40);
$this->Cell(50,6,utf8_decode('PACIENTE'),1,0,'C',1);
$this->SetX(90);
$this->Cell(30,6,utf8_decode('CI'),1,0,'C',1);
$this->SetX(120);

$this->Cell(30,6,utf8_decode('CELULAR'),1,0,'C',1);
$this->SetX(150);
$this->Cell(35,6,utf8_decode('FECHA DE NAC.'),1,0,'C',1);
$this->SetX(185);
$this->Cell(50,6,utf8_decode('EMAIL'),1,0,'C',1);
$this->SetX(235);
$this->Cell(50,6,utf8_decode('SEGURO MED.'),1,0,'C',1);


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
		$registros=$base->query("SELECT   pac.id_paciente,pac.codigo_paciente,concat_ws(' ',pac.nombre,pac.apellido_paterno,pac.apellido_materno) AS paciente,concat_ws(' ',pac.ci,pac.extension) as ci,DATE_FORMAT( pac.fecha_nacimiento,  '%d-%m-%Y' ) AS fecha_nacimiento ,pac.celular, aseg.nombre AS aseguradora ,pac.email,pac.antecedente_patologico FROM tbl_pacientes pac inner join tbl_aseguradoras aseg on pac.id_aseguradora=aseg.id_aseguradora where pac.estado='$estado'");

$busc_empl=$_GET["criterio"];	

if($busc_empl!=""){
$registros=$base->query("SELECT   pac.id_paciente
	,pac.codigo_paciente
	,concat_ws(' ',pac.nombre,pac.apellido_paterno,pac.apellido_materno) AS paciente
	,concat_ws(' ',pac.ci,pac.extension) as ci
	, DATE_FORMAT( pac.fecha_nacimiento,  '%d-%m-%Y' ) AS fecha_nacimiento 
	,pac.celular
	, aseg.nombre AS aseguradora 
	,pac.email
	,pac.antecedente_patologico FROM tbl_pacientes pac inner join tbl_aseguradoras aseg on pac.id_aseguradora=aseg.id_aseguradora where pac.estado='$estado' and concat_ws(' ',pac.nombre,pac.apellido_paterno,pac.apellido_materno) like   '%$busqueda%' or pac.estado='$estado' and pac.codigo_paciente like   '%$busqueda%' OR pac.estado='$estado' and DATE_FORMAT( pac.fecha_nacimiento,  '%d-%m-%Y' )  like   '%$busqueda%' OR pac.estado='$estado' and pac.celular  like   '%$busqueda%' OR pac.estado='$estado' and pac.email  like   '%$busqueda%'  OR pac.estado='$estado' and aseg.nombre  like   '%$busqueda%' OR pac.estado='$estado' and pac.antecedente_patologico  like   '%$busqueda%'    order by pac.apellido_paterno, pac.apellido_materno, pac.nombre");
}


$pdf= new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(30,6,'CODIGO PACIENTE',1,0,'C',1);
$pdf->SetX(40);
$pdf->Cell(50,6,utf8_decode('PACIENTE'),1,0,'C',1);
$pdf->SetX(90);
$pdf->Cell(30,6,utf8_decode('CI'),1,0,'C',1);
$pdf->SetX(120);

$pdf->Cell(30,6,utf8_decode('CELULAR'),1,0,'C',1);
$pdf->SetX(150);
$pdf->Cell(35,6,utf8_decode('FECHA DE NAC.'),1,0,'C',1);
$pdf->SetX(185);
$pdf->Cell(50,6,utf8_decode('EMAIL'),1,0,'C',1);
$pdf->SetX(235);
$pdf->Cell(50,6,utf8_decode('SEGURO MED.'),1,0,'C',1);





$pdf->Ln();
while($row=$registros->fetch(PDO::FETCH_ASSOC)){
	$pdf->SetFont('Arial','',10);
$pdf->SetX(10);
$pdf->Cell(30,6,utf8_decode($row['codigo_paciente']),1,0,'L');
$pdf->SetX(40);
$pdf->Cell(50,6,utf8_decode($row['paciente']),1,0,'L');
$pdf->SetX(90);
$pdf->Cell(30,6,utf8_decode($row['ci']),1,0,'L');
$pdf->SetX(120);
$pdf->Cell(30,6,utf8_decode($row['celular']),1,0,'L');
$pdf->SetX(150);
$pdf->Cell(35,6,utf8_decode($row['fecha_nacimiento']),1,0,'L');
$pdf->SetX(185);
$pdf->Cell(50,6,utf8_decode($row['email']),1,0,'L');
$pdf->SetX(235);
$pdf->Cell(50,6,utf8_decode($row['aseguradora']),1,1,'L');






	
	}
$pdf->Output();
?>