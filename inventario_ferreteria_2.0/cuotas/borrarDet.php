<?php
ob_start();
include ("../conexion.php");
$id=$_POST["ide"];

$html="";
try{

	$sql="Delete from detalle_tratamiento where id_detalle_tratamiento=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id));

}
catch (Exception $e){
	 $html= $e->getMessage();
	}
	
		
echo $html;
?>
