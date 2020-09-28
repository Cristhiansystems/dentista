<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE tbl_aseguradoras set estado=:est where id_aseguradora=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:seguro.php?res");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:seguro.php?error");
		 }
	}
?>