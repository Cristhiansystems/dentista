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
$pieza=$_POST["id_pieza"];
$tratamiento=$_POST["id_tratamiento"];
$precio=$_POST["precio"];
$fecha=$_POST["fecha"];
$medico=$_POST["id_doctor"];
$estadopago=$_POST["pago"];
$estado="activo";
date_default_timezone_set('America/Caracas');
$registro=date("Y-m-d");



try{ 
require("../conexion.php");
			
		
				
		
				$sql="insert into detalle_tratamiento(precio_unitario, id_cuenta, id_tratamiento, id_pieza, id_medico, id_pago, estado_pago, realizado, fecha_detalle) values(:prec, :idc, :idt, :idp, :idm, :pag, :estp, :rea, :fecdet)";
			$resultado=$base->prepare($sql);
					$resultado->execute(array(":prec"=>$precio, ":idc"=>$id, ":idt"=>$tratamiento, ":idp"=>$pieza, ":idm"=>$medico, ":pag"=>0, ":estp"=>$estadopago, ":rea"=>'no', ":fecdet"=>$fecha));

			$resultado->closeCursor();
				
			


		}catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();

	
	}
?>