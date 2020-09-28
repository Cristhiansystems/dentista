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
$id_cliente=$_POST["id_cliente"];
$pretotal=$_POST["pretotal"];
$pagar=0;
$descuento=0;
$pagardescuento=0;
$saldo=$_POST["pretotal"];
$seguro=0;
$nro_pagos=$_POST["nropagos"];

//parametros detalle tratamiento
$pieza=$_POST["pieza"];
$tratamiento=$_POST["trat"];
$precio=$_POST["prec"];
$fechadet=$_POST["fecha"];
$realizado=$_POST["realizado"];
$estadopago=$_POST["estpag"];
$medico=$_POST["medico"];


$estado="activo";
date_default_timezone_set('America/Caracas');
$registro=date("Y-m-d");




require("../conexion.php");
			
			
				
				
			$sql="insert into cuenta(fecha, id_paciente, costo, pagado, saldo, seguro,  estado) values(:fec, :idp, :cos, :pag, :sal, :seg, :est)";
			$resultado=$base->prepare($sql);
			if($resultado->execute(array(":fec"=>$registro, ":idp"=>$id_cliente, ":cos"=>$pretotal, ":pag"=>$pagar, ":sal"=>$saldo, ":seg"=>$seguro, ":est"=>$estado))){
				$id=$base->lastInsertId();
				$idpago=0;
			if($pagar!=0){
					$sql="insert into pago(fecha, costo, descuento, costo_total, id_usuario, id_cuenta) values(:fec, :cos, :des, :cost, :idusu, :idcu)";
			$resultado=$base->prepare($sql);
				
			$resultado->execute(array(":fec"=>$registro, ":cos"=>$pagar, ":des"=>$descuento, ":cost"=>$pagardescuento, ":idusu"=>1, ":idcu"=>$id));
				$idpago=$base->lastInsertId();
			}
				for ($i=0; $i<count($tratamiento) ; $i++){
					if($estadopago[$i]=="Pagado"){
						$pago=$idpago;
					}else{
						$pago=0;
					}
				$sql="insert into detalle_tratamiento(precio_unitario, id_cuenta, id_tratamiento, id_pieza, id_medico, id_pago, estado_pago, realizado, fecha_detalle) values(:prec, :idc, :idt, :idp, :idm, :pag, :estp, :rea, :fecdet)";
			$resultado=$base->prepare($sql);
					$resultado->execute(array(":prec"=>$precio[$i], ":idc"=>$id, ":idt"=>$tratamiento[$i], ":idp"=>$pieza[$i], ":idm"=>$medico[$i], ":pag"=>$pago, ":estp"=>$estadopago[$i], ":rea"=>$realizado[$i], ":fecdet"=>$fechadet[$i]));
					
					}


					for ($j=0;$j<$nro_pagos;$j++){
						$sql="insert into tbl_cuotas (numero,estado,id_cuenta) values(:nu, :est, :idc)";
						//$numero=$j+1;
					$resultado1=$base->prepare($sql);
					$resultado1->execute(array(


						":nu"=>$j+1, 
						":est"=>'Pendiente', 
						":idc"=>$id));


					}
				
			if($pagar==0){
				header("Location:cuenta.php?mensaje");
			}else{
			
			header("Location:boleta.php?id=$idpago");
			}
			}else {
				 
				header("Location:registroFMR.php?mensaje2");
				
				}
			$resultado->closeCursor();
				

?>