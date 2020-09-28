<?php
 include("../conexion.php");
 $id_cita=$_POST["idcita"];
 $html="";

$valores = $base->query("  
	SELECT   ct.estado FROM tbl_citas ct 
WHERE ct.id_cita='$id_cita'");
$valores2 = $valores->fetch();

$estado=$valores2['estado'];


if($estado=="Confirmado" or $estado=="Cancelado"){

	$html.="<div class='alert alert-warning' role='alert'>
  					Su respuesta ya fue enviado. 
				</div>";
 	echo $html;

}else{
	 $sql=$base->prepare("UPDATE tbl_citas set estado='Cancelado' where id_cita='$id_cita'");

 if($sql->execute()){
 	$html.="<div class='alert alert-success' role='alert'>
  					Gracias por avisarnos. El personal de la clínica ha sido informado, en breve se pondrá en contacto con usted para darle una nueva cita.  
				</div>";
 	echo $html;
 }else{
 	echo "fallo";
 }
}
?>