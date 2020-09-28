<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE tbl_agencias set estado=:est where id_agencia=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:agencia.php?res");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:agencia.php?error");
		 }
	}
?>