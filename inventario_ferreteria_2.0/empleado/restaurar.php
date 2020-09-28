<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE tbl_empleados set estado=:est where id_empleado=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:empleado.php?res=$id");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:empleado.php?error");
		 }
	}
?>