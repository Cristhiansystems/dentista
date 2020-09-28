<?php
ob_start();
include ("../conexion.php");
$id=$_POST["ide"];
$html=" ";
try{
	/*$sql1=$base->query("Select count(*) as productos From producto where id_tipo_producto='$id' and estado='activo'")->fetch(PDO::FETCH_ASSOC);
if($sql1['productos']>0){$html.="<script>alert('NO SE PUEDE BORRAR YA QUE HAY PRODUCTOS EN ESTE TIPO DE PRODUCTOS DEBE ELIMINAR ESOS PRODUCTOS O LLEVARLOS A OTRO TIPO DE PRODUCTOS')</script>";
	}else{*/
	$sql="UPDATE tbl_agencias set estado=:est where id_agencia=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"desactivo"));
	
//}


}
catch (Exception $e){
	 $html= $e->getMessage();
	}


echo $html;
?>

