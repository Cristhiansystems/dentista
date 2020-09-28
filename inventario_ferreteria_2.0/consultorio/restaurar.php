<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE tbl_consultorios set estado=:est where id_consultorio=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:consultorio.php?res");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:consultorio.php?error");
		 }
	}
?>