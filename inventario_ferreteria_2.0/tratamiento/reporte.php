<?php
require("../conexion.php");
require('../FPDF/fpdf.php');
class PDF extends FPDF{
	
	
	var $widths;
var $aligns;

function SetWidths($w)
{
//Set the array of column widths
$this->widths=$w;

}

function SetAligns($a)
{
//Set the array of column alignments
$this->aligns=$a;
}

function Row($data)
{
//Calculate the height of the row
$this->SetX(10);
$nb=0;
for($i=0;$i<count($data);$i++)
$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
$h=5*$nb;
//Issue a page break first if needed
$this->CheckPageBreak($h);
//Draw the cells of the row
for($i=0;$i<count($data);$i++)
{
$w=$this->widths[$i];
$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
//Save the current position
$x=$this->GetX(10);
$y=$this->GetY();
//Draw the border
$this->Rect($x,$y,$w,$h);
//Print the text
$this->MultiCell($w,5,$data[$i],0,$a);
//Put the position to the right of the cell
$this->SetXY($x+$w,$y);
}
//Go to the next line
$this->Ln($h);
$this->SetX(10);

}

function CheckPageBreak($h)
{
//If the height h would cause an overflow, add a new page immediately
if($this->GetY()+$h>$this->PageBreakTrigger){
	$this->SetX(10);
$this->AddPage($this->CurOrientation);
	$this->SetFillColor(232,232,232);
$this->SetFont('Arial','B',8);
$this->SetX(15);
$this->Cell(10,6,'#',1,0,'C',1);
$this->Cell(30,6,'CODIGO',1,0,'C',1);
$this->Cell(60,6,'NOMBRE',1,0,'C',1);

$this->Cell(20,6,'COSTO',1,0,'C',1);
$this->Cell(60,6,'ESPECIALIDAD',1,0,'C',1);

$this->Ln();
$this->SetX(15);
}
}

function NbLines($w,$txt)
{
//Computes the number of lines a MultiCell of width w will take
$cw=&$this->CurrentFont['cw'];
if($w==0)
$w=$this->w-$this->rMargin-$this->x;
$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
$s=str_replace("\r",'',$txt);
$nb=strlen($s);
if($nb>0 and $s[$nb-1]=="\n")
$nb--;
$sep=-1;
$i=0;
$j=0;
$l=0;
$nl=1;
while($i<$nb)
{
$c=$s[$i];
if($c=="\n")
{
$i++;
$sep=-1;
$j=$i;
$l=0;
$nl++;
continue;
}
if($c==' ')
$sep=$i;
$l+=$cw[$c];
if($l>$wmax)
{
if($sep==-1)
{
if($i==$j)
$i++;
}
else
$i=$sep+1;
$sep=-1;
$j=$i;
$l=0;
$nl++;
}
else
$i++;
}
return $nl;
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
	$this->Cell(30,10,"LISTA DE TRATAMIENTOS" ,0,1,'C');
	$this->Ln(10);
	
	
	}	
	
	function Footer() {
 // Compruebe si pie de página de esta página ya existe ( lo mismo para Header ( ) )
 if(!isset($this->footerset[$this->page])) {
  $this->SetY(-15);
  // Numero de Pagina
  $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
  // Conjunto Footerset
  $this->footerset[$this->page] = true;
 }
}
	
	
			
	}

$esp=$_GET['esp'];
	


	$registros=$base->query("SELECT especialidad.nombre as especialidad, tratamiento.nombre, tratamiento.id_tratamiento, tratamiento.codigo, precio FROM tratamiento INNER JOIN especialidad on tratamiento.id_especialidad=especialidad.id_especialidad  where tratamiento.estado='activo' and tratamiento.id_especialidad='$esp' order by  tratamiento.nombre");


$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(15);
$pdf->Cell(10,6,'#',1,0,'C',1);
$pdf->Cell(30,6,'CODIGO',1,0,'C',1);
$pdf->Cell(60,6,'NOMBRE',1,0,'C',1);

$pdf->Cell(20,6,'COSTO',1,0,'C',1);
$pdf->Cell(60,6,'ESPECIALIDAD',1,0,'C',1);
$pdf->Ln();
$i=0;
while($row=$registros->fetch(PDO::FETCH_ASSOC)){
	$pdf->SetFont('Arial','',8);
	$i++;
	$pdf->SetX(15);	
	$pdf->Cell(10,6,$i,1,0,'L');
	$pdf->Cell(30,6,utf8_decode($row['codigo']),1,0,'L');
$pdf->Cell(60,6,utf8_decode($row['nombre']),1,0,'L');
$pdf->Cell(20,6,utf8_decode($row['precio']),1,0,'L');
$pdf->Cell(60,6,utf8_decode($row['especialidad']),1,1,'L');

	
	}
$pdf->Output();
?>