<?php
ob_start();
$id_cliente=$_POST["id_cliente"];
$pretotal=$_POST["pretotal"];
$tipo=$_POST["tipo"];
$cant=$_POST["cant"];
$prot=$_POST["prot"];
$pret=$_POST["pret"];

$estado="activo";
$registro=date("Y-m-d");



try{ 
require("../conexion.php");
			
			$sql1=$base->query("Select * From venta where estado='activo' order by id_venta desc")->fetch(PDO::FETCH_ASSOC);
			$numero=$sql1['numero'];
			if($numero!=""){
				$numero=$sql1['numero'];
			$numero=(int)$numero + 1;
			}else{
				$numero=1;
			}
			$alerta=0;
			if($tipo=='Venta'){
				for ($i=0; $i<count($cant) ; $i++){
				$sql1=$base->query("Select * From producto where id_producto='$prot[$i]'")->fetchAll(PDO::FETCH_OBJ);
					$cantidad=$sql1[0]->cantidad;
					if($cantidad<$cant[$i]){
						$alerta=1;
					}
				  }
			}
	
			if($alerta==1){
				header("Location:registroFMR.php?alerta");
			}else{
				
				
			$sql="insert into venta(precio, id_cliente, estado, registro, tipo, numero) values(:prec, :idc, :est, :reg, :tip, :num)";
			$resultado=$base->prepare($sql);
			if($resultado->execute(array(":prec"=>$pretotal, ":idc"=>$id_cliente, ":est"=>$estado, ":reg"=>$registro, ":tip"=>$tipo, ":num"=>$numero))){
				$id=$base->lastInsertId();
				for ($i=0; $i<count($cant) ; $i++){
					
				$sql="insert into detalle_venta(id_producto, precio, cantidad, id_venta, estado, registro) values(:idp, :prec, :can, :idv, :est, :reg)";
			$resultado=$base->prepare($sql);
					$resultado->execute(array(":idp"=>$prot[$i], ":prec"=>$pret[$i], ":can"=>$cant[$i], ":idv"=>$id, ":est"=>$estado, ":reg"=>$registro));
					if($tipo=='Venta'){
						
						$sql1=$base->query("Select * From producto where id_producto='$prot[$i]'")->fetchAll(PDO::FETCH_OBJ);
					$cantidad=$sql1[0]->cantidad;
						$cantidad=$cantidad-$cant[$i];
						$sql="UPDATE producto set cantidad=:cant where id_producto=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":cant"=>$cantidad, ":id"=>$prot[$i]));
					}
					}
				
			header("Location:boleta.php?id=$id");
			}else {
				
				header("Location:registroFMR.php?mensaje2");
				
				}
			$resultado->closeCursor();
				
			}
			

			
		}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();

	
	}
?>