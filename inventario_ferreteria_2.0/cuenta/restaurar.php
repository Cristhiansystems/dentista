<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE cuenta set estado=:est where id_cuenta=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:cuenta.php?res");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:cuenta.php?error");
		 }
	}
?>