<?php
ob_start();
include ("../conexion.php");
$id=$_POST['ide'];

try{

	$sql="UPDATE tbl_usuarios set estado=:est where id_usuario=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"desactivo"));

}
catch (Exception $e){
	
	
}
		

echo $html;
?>
