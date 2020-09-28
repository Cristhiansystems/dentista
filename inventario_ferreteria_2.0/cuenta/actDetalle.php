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
			
		
				
		
				$sql="update detalle_tratamiento set precio_unitario=:prec, id_tratamiento=:idt, id_pieza=:idp, id_medico=:idm,  estado_pago=:estp, fecha_detalle=:fecdet where id_detalle_tratamiento=:id";
			$resultado=$base->prepare($sql);
					$resultado->execute(array(":prec"=>$precio, ":idt"=>$tratamiento, ":idp"=>$pieza, ":idm"=>$medico, ":estp"=>$estadopago, ":fecdet"=>$fecha, ":id"=>$id));

			$resultado->closeCursor();
				
			


		}catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();

	
	}
?>