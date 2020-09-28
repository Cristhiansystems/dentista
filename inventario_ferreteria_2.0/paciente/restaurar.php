<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE tbl_pacientes set estado=:est where id_paciente=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:paciente.php?res=$id");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:empleado.php?error");
		 }
	}
?>