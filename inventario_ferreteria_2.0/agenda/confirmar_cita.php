<?php
 include("../conexion.php");
 $id_cita=$_POST["idcita"];

 $html="";
$valores = $base->query("  
	SELECT   DATE_FORMAT(ct.fecha, '%d/%m/%Y') as fecha, time_format(ct.hora_inicio, '%H:%i') as hora , ct.estado FROM tbl_citas ct 
WHERE ct.id_cita='$id_cita'");
$valores2 = $valores->fetch();
$fecha=$valores2['fecha'];
$hora=$valores2['hora'];
$estado=$valores2['estado'];

if($estado=="Confirmado" or $estado=="Cancelado"){

	$html.="<div class='alert alert-warning' role='alert'>
  					Su respuesta ya fue enviado. 
				</div>";
 	echo $html;

}else{

 $sql=$base->prepare("UPDATE tbl_citas set estado='Confirmado' where id_cita='$id_cita'");


 if($sql->execute()){
 			$html.="<div class='alert alert-success' role='alert'>
  					Gracias, le esperamos el día ". $fecha ." a las ".$hora." horas en nuestra clínica.  
				</div>";
 	echo $html;
 }else{
 	echo "fallo";
 }
}
?>