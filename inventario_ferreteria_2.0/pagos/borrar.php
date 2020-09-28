<?php
ob_start();
include ("../conexion.php");
$id=$_POST["ide"];
$html="";
try{
	
		$registros=$base->query("SELECT precio_unitario , detalle_tratamiento.id_detalle_tratamiento FROM pago inner join detalle_tratamiento on pago.id_pago=detalle_tratamiento.id_pago where pago.id_pago='$id'")->fetchAll(PDO::FETCH_OBJ);
		$devolucion=0;
		$sql="UPDATE detalle_tratamiento set estado_pago=:est, id_pago=:pag where id_pago=:id";
			$resultado=$base->prepare($sql);
			$resultado->execute(array(":id"=>$id, ":est"=>"Debe", ":pag"=>0));
		foreach($registros as $reg):
			$devolucion=$devolucion + $reg->precio_unitario;
		endforeach;
			$sql1=$base->query("Select cuenta.id_cuenta, cuenta.pagado, cuenta.saldo from pago INNER JOIN cuenta on cuenta.id_cuenta=pago.id_cuenta  where id_pago='$id'")->fetch(PDO::FETCH_ASSOC);
		$pagado=$sql1["pagado"];
		$saldo=$sql1["saldo"];
		$cuenta=$sql1["id_cuenta"];
		$pagado=$pagado-$devolucion;
		$saldo=$saldo+$devolucion;
	$sql="UPDATE cuenta set pagado=:pag, saldo=:sal where id_cuenta=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$cuenta, ":pag"=>$pagado, ":sal"=>$saldo));
	$sql="DELETE from pago where id_pago=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id));
	
//}


}
catch (Exception $e){
	 $html= $e->getMessage();
	}


echo $html;
?>

