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
	if($i>2){
	$this->MultiCell($w,5,$data[$i],0,'R');
}else{
		$this->MultiCell($w,5,$data[$i],0,$a);
	}

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
$this->SetX(10);
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
			require("../conexion.php");
			$id=$_GET['id'];
			$sql1=$base->query("Select * From venta INNER JOIN cliente on cliente.id_cliente=venta.id_cliente where id_venta='$id'")->fetch(PDO::FETCH_ASSOC);
			$numero=$sql1['numero'];
			$tipo=$sql1['tipo'];
			$nombre=$sql1['nombre'];
			$app=$sql1['apellido_paterno'];
	$this->Image('../imagenes/logorep.jpeg', 10,10,80);
	$this->SetFont('Arial','B', 15);
			$this->Ln(5);
	$this->Cell(150);
	$this->Cell(30,10,utf8_decode('N°' . " " . $numero),0,1,'C');
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
				$this->SetFont('Arial','B', 25);
			$this->Cell(80);

			if($tipo=='Venta'){
				$this->Cell(30,10,'RECIBO',0,1,'C');
			}else if($tipo=='Proforma'){
				
				$this->Cell(30,10,'PROFORMA',0,1,'C');
			}
	$this->Cell(10);
	$this->SetFont('Arial','B', 15);
	$this->Cell(60,10,utf8_decode("SEÑOR(ES): " . $nombre . " " . $app),0,1,'L'); 
	$this->Ln(5);
	
	
	}	
			
	}


$id=$_GET['id'];


$registros=$base->query("SELECT venta.precio as precio_total, detalle_venta.id_detalle_venta, producto.id_producto, producto.nombre as producto, producto.precio as precio,  detalle_venta.precio as preciosub, detalle_venta.cantidad, medida.nombre as medida  FROM venta inner join detalle_venta on venta.id_venta=detalle_venta.id_venta inner join producto on producto.id_producto=detalle_venta.id_producto inner join medida on medida.id_medida=producto.id_medida where venta.id_venta='$id'");

$sql1=$base->query("Select * From venta INNER JOIN cliente on cliente.id_cliente=venta.id_cliente where id_venta='$id'")->fetch(PDO::FETCH_ASSOC);
$tipo=$sql1['tipo'];
$preciot=$sql1['precio'];

$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(10);
$pdf->Cell(30,6,'CODIGO',1,0,'C',1);
$pdf->SetX(40);
$pdf->Cell(50,6,'NOMBRE',1,0,'C',1);
$pdf->SetX(90);
$pdf->Cell(20,6,'UNIDAD',1,0,'C',1);
$pdf->SetX(110);
$pdf->Cell(20,6,'CANTIDAD',1,0,'C',1);
$pdf->SetX(130);
$pdf->Cell(30,6,'C .UNITARIO',1,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(30,6,'IMPORTE',1,0,'C',1);
$pdf->SetWidths(array(30,50,20,20,30,30));
$pdf->Ln();
while($dato=$registros->fetch(PDO::FETCH_ASSOC)){
	$pdf->SetFont('Arial','',10);
$pdf->Row(array(utf8_decode($dato['id_producto']),utf8_decode($dato['producto']) ,utf8_decode($dato['medida']),utf8_decode($dato['cantidad']) ,utf8_decode($dato['precio']) ,utf8_decode($dato['preciosub'])));
	
	}
$pdf->SetX(10);
$pdf->Cell(150,6,'TOTAL BS.',1,0,'C',1);
$pdf->Cell(30,6,$preciot,1,0,'R',1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',12);
if($tipo=="Proforma"){
	$pdf->SetX(10);
	$pdf->Cell(30,6,'NOTA: TIENE VALIDEZ DE 15 DIAS',0,0,'C');
}else if($tipo=="Venta"){
	$pdf->SetX(10);
	$pdf->Cell(50,6,'ENTREGADO POR:',0,0,'L');
	$pdf->SetX(100);
	$pdf->Cell(50,6,'RECIBIDO POR:',0,1,'L');
	$pdf->SetX(10);
	$pdf->Cell(50,6,'............................................................',0,0,'L');
	$pdf->SetX(100);
	$pdf->Cell(50,6,'............................................................',0,1,'L');
}
$pdf->Output();
?>