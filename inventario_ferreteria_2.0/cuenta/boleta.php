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
	$this->Cell(10,6,'#',1,0,'C',1);
$this->Cell(30,6,'Pieza',1,0,'C',1);
$this->Cell(80,6,'Tratamiento',1,0,'C',1);
$this->Cell(50,6,'Precio',1,1,'C',1);
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
			$sql1=$base->query("Select tbl_pacientes.nombre, tbl_pacientes.apellido_paterno, tbl_pacientes.apellido_materno, pago.fecha, tbl_empleados.nombre as empnom, tbl_empleados.apellido_paterno as appemp From pago INNER JOIN cuenta on cuenta.id_cuenta=pago.id_cuenta inner join tbl_pacientes on tbl_pacientes.id_paciente=cuenta.id_paciente inner join tbl_usuarios on tbl_usuarios.id_usuario=pago.id_usuario inner join tbl_empleados on tbl_empleados.id_empleado=tbl_usuarios.id_empleado where id_pago='$id'")->fetch(PDO::FETCH_ASSOC);
			$nombre=$sql1['nombre'];
			$app=$sql1['apellido_paterno'];
			$apm=$sql1['apellido_materno'];
			$fecha=$sql1['fecha'];
			$dia = date("d",  strtotime($fecha));
			$mes = date("m",   strtotime($fecha));
			$anio = date("Y",   strtotime($fecha));
	$this->Image('../imagenes/logorep.jpeg', 10,10,50);
	$this->SetFont('Arial','B', 15);
			$this->Ln(5);
	$this->Cell(150);
	$this->Cell(30,10,utf8_decode('N°' . " " . $id),0,1,'C');
	$this->Cell(120);
			$this->SetFont('Arial','B', 10);
	$this->Cell(20,16,"FECHA",1,0,'C');
	$this->Cell(15,8,"DIA",1,0,'C');
	$this->Cell(15,8,"MES",1,0,'C');
	$this->Cell(15,8,utf8_decode("AÑO"),1,1,'C');
			$this->Cell(140);
			$this->Cell(15,8,$dia,1,0,'C');
			$this->Cell(15,8,$mes,1,0,'C');
			$this->Cell(15,8,$anio,1,1,'C');
			$this->Cell(135);
			$this->Cell(20,16,"USUARIO: " . $sql1['appemp'] . " " . $sql1['empnom'] ,0,0,'C');
	$this->SetFont('Arial','B', 8);
			
			$this->Ln(15);
			
				$this->SetFont('Arial','B', 25);
			$this->Cell(80);

			
	$this->Cell(10);
	$this->SetFont('Arial','B', 15);
	$this->Cell(60,10,utf8_decode("SEÑOR(ES): " . $nombre . " " . $app . " ". $apm),0,1,'L'); 
	$this->Ln(5);
	
	
	}	
			
	}


$id=$_GET['id'];


$registros=$base->query("SELECT precio_unitario, tratamiento.nombre as tratamiento, pieza.nombre as pieza, pieza.pieza FROM pago inner join detalle_tratamiento on pago.id_pago=detalle_tratamiento.id_pago inner join tratamiento on tratamiento.id_tratamiento=detalle_tratamiento.id_tratamiento left join pieza on pieza.id_pieza=detalle_tratamiento.id_pieza  where pago.id_pago='$id' order by pieza.pieza, tratamiento.nombre");

$sql1=$base->query("Select * From pago  where id_pago='$id'")->fetch(PDO::FETCH_ASSOC);
$costo=$sql1['costo'];
$descuento=$sql1['descuento'];
$costo_total=$sql1['costo_total'];


$pdf= new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',10);
$pdf->SetX(10);
$pdf->Cell(10,6,'#',1,0,'C',1);
$pdf->Cell(30,6,'Pieza',1,0,'C',1);
$pdf->Cell(80,6,'Tratamiento',1,0,'C',1);
$pdf->Cell(50,6,'Precio',1,1,'C',1);

$pdf->SetWidths(array(10,30,80,50));
$i=0;
while($dato=$registros->fetch(PDO::FETCH_ASSOC)){
	$pdf->SetFont('Arial','',10);
	$i++;
$pdf->Row(array($i,utf8_decode($dato['pieza']) ,utf8_decode($dato['tratamiento']),utf8_decode($dato['precio_unitario'])));
	
	}
$pdf->SetX(50);
$pdf->Cell(80,6,'COSTO BS.',1,0,'R',1);
$pdf->Cell(50,6,$costo,1,1,'R',1);
$pdf->SetX(50);
$pdf->Cell(80,6,'DESCUENTO',1,0,'R',1);
$pdf->Cell(50,6,$descuento . " %",1,1,'R',1);
$pdf->SetX(50);
$pdf->Cell(80,6,'TOTAL BS.',1,0,'R',1);
$pdf->Cell(50,6,$costo_total,1,1,'R',1);
$pdf->Ln(20);
$pdf->SetFont('Arial','B',12);

	$pdf->SetX(10);
	$pdf->Cell(50,6,'ENTREGADO POR:',0,0,'L');
	$pdf->SetX(100);
	$pdf->Cell(50,6,'RECIBIDO POR:',0,1,'L');
	$pdf->SetX(10);
	$pdf->Cell(50,6,'............................................................',0,0,'L');
	$pdf->SetX(100);
	$pdf->Cell(50,6,'............................................................',0,1,'L');

$pdf->Output();
?>