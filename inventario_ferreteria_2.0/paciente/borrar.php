<?php
ob_start();
include ("../conexion.php");
$id=$_POST["ide"];

try{

	$sql="UPDATE tbl_pacientes set estado=:est where id_paciente=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"desactivo"));

}
catch (Exception $e){
	 $html= $e->getMessage();
	}

echo $html;
?>
