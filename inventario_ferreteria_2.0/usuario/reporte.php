<?php
require("../conexion.php");
require('../FPDF/fpdf.php');
class PDF extends FPDF{
	
	function AcceptPageBreak(){
		$this->AddPage();
		$this->SetFillColor(232,232,232);
$this->SetFont('Arial','B',12);
$this->SetX(15);
$this->Cell(50,6,utf8_decode('AGENCIA'),1,0,'C',1);
$this->SetX(65);
$this->Cell(50,6,utf8_decode('EMPLEADO'),1,0,'C',1);
$this->SetX(115);
$this->Cell(50,6,utf8_decode('TIPO DE USUARIO'),1,0,'C',1);
$this->SetX(165);
$this->Cell(25,6,utf8_decode('REGISTRO'),1,0,'C',1);


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
	$this->Cell(30,10,"REPORTE DE USUARIOS" ,0,1,'C');
	$this->Ln(10);
	
	
	}	
			
	}
	$estado=$_GET["estado"];
		$registros=$base->query("SELECT usu.id_usuario,age.nombre as agencia, concat_ws(' ',emp.nombre,emp.apellido_paterno,emp.apellido_materno) as empleado,usu.tipo_usuario, DATE_FORMAT( usu.registro,  '%d-%m-%Y' ) as registro FROM tbl_usuarios usu inner join tbl_agencias age on usu.id_agencia=age.id_agencia  inner join tbl_empleados  emp on usu.id_empleado=emp.id_empleado where usu.estado='$estado' ");

$busc_empl=$_GET["criterio"];	

if($busc_empl!=""){
$registros=$base->query("SELECT usu.id_usuario,age.nombre as agencia, concat_ws(' ',emp.nombre,emp.apellido_paterno,emp.apellido_materno) as empleado,usu.tipo_usuario, DATE_FORMAT( usu.registro,  '%d-%m-%Y' ) as registro FROM tbl_usuarios usu inner join tbl_agencias age on usu.id_agencia=age.id_agencia  inner join tbl_empleados  emp on usu.id_empleado=emp.id_empleado where usu.estado='$estado' and age.nombre like '%$busc_empl%' or usu.estado='$estado' and  concat_ws(' ',emp.nombre,emp.apellido_paterno,emp.apellido_materno) like '%$busc_empl%' or usu.estado='$estado' and usu.tipo_usuario like '%$busc_empl%' or usu.estado='$estado' and   DATE_FORMAT( usu.registro,  '%d-%m-%Y' ) like '%$busc_empl%'  order by usu.id_usuario");
}


$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(15);
$pdf->Cell(50,6,utf8_decode('AGENCIA'),1,0,'C',1);
$pdf->SetX(65);
$pdf->Cell(50,6,utf8_decode('EMPLEADO'),1,0,'C',1);
$pdf->SetX(115);
$pdf->Cell(50,6,utf8_decode('TIPO DE USUARIO'),1,0,'C',1);
$pdf->SetX(165);
$pdf->Cell(25,6,utf8_decode('REGISTRO'),1,0,'C',1);
$pdf->SetX(105);


$pdf->Ln();
while($row=$registros->fetch(PDO::FETCH_ASSOC)){
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(15);
$pdf->Cell(50,6,utf8_decode($row['agencia']),1,0,'L');
$pdf->SetX(65);
$pdf->Cell(50,6,utf8_decode($row['empleado']),1,0,'L');
$pdf->SetX(115);
$pdf->Cell(50,6,utf8_decode($row['tipo_usuario']),1,0,'L');
$pdf->SetX(165);
$pdf->Cell(25,6,utf8_decode($row['registro']),1,1,'L');
$pdf->SetX(105);



	
	}
$pdf->Output();
?>