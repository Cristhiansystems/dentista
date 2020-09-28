<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE venta set estado=:est where id_venta=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:venta.php?res=$id");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:venta.php?error");
		 }
	}
?>