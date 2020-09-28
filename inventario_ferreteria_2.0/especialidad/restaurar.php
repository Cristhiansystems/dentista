<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE especialidad set estado=:est where id_especialidad=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:especialidad.php?res");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:especialidad.php?error");
		 }
	}
?>