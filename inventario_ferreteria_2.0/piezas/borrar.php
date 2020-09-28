<?php
ob_start();
include ("../conexion.php");
$id=$_POST["ide"];
$html=" ";
try{

	$sql="UPDATE PIEZA set estado=:est where id_pieza=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"desactivo"));
	



}
catch (Exception $e){
	 $html= $e->getMessage();
	}


echo $html;
?>

