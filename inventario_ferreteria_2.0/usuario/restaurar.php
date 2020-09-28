<?php
ob_start();
include ("../conexion.php");
try{
$id=$_GET["ide"];
$sql="UPDATE tbl_usuarios set estado=:est where id_usuario=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"activo"));
header("location:usuario.php?res=$id");
}
catch (Exception $e){
	 if ($e->getCode()==23000){
		 
		 header("location:usuario.php?error");
		 }
	}
?>