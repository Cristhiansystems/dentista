<?php
ob_start();
/*if(!isset($_SESSION["usuario"])){
	
	header("location:../index.php");
	}else{
	$usuario=$_SESSION["usuario"];
$sql=$base->query("select * FROM usuario where usuario='$usuario'")->fetch(PDO::FETCH_ASSOC);
$tipousuario=$sql['tipo'];
$id_login=$sql['id_usuario'];
}*/


//parametros cuenta
$id=$_POST["id"];
$id_cuota=$_POST["idcuo"];
$id_medico=$_POST["idmed"];

$id_usuario=$_POST["idusu"];
$saldo_pendiente=$_POST["saldop"];
$monto_pagado=$_POST["montop"];
$monto_cuota=$_POST["montoc"];

date_default_timezone_set('America/Caracas');
$registro=date("Y-m-d");



try{ 
require("../conexion.php");
			
		$sql="insert into pago(fecha, costo,descuento, costo_total,id_usuario,id_cuenta,id_medico) values(:fech, :cost, :desc, :costt, :idus, :idcu, :idmed)";
			$resultado=$base->prepare($sql);
					$resultado->execute(array(":fech"=>$registro, ":cost"=>$monto_cuota, ":desc"=>0, ":costt"=>$monto_cuota, ":idus"=>$id_usuario, ":idcu"=>$id,":idmed"=>$id_medico));
					$idpago=$base->lastInsertId();
				
		$sql="Update tbl_cuotas set fecha=:fech, monto=:mont,estado='Cancelado',id_pago=:idpag where id_cuota=:idcuo and id_cuenta=:idcu";
			$resultado=$base->prepare($sql);
					$resultado->execute(array(":fech"=>$registro, ":mont"=>$monto_cuota,":idpag"=>$idpago,":idcuo"=>$id_cuota,  ":idcu"=>$id));
				
			$sql="Update cuenta set pagado=:pag, saldo=:sald where  id_cuenta=:idcu";
			$resultado=$base->prepare($sql);
					$resultado->execute(array(":pag"=>($monto_pagado+$monto_cuota), ":sald"=>$saldo_pendiente, ":idcu"=>$id));



			$resultado->closeCursor();
			echo $idpago;
			


		}catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();

	
	}
?>