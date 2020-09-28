<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE pieza set estado=:est where id_pieza=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:piezas.php?res");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:piezas.php?error");
		 }
	}
?>