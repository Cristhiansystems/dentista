<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE tratamiento set estado=:est where id_tratamiento=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:tratamiento.php?res");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:tratamiento.php?error");
		 }
	}
?>