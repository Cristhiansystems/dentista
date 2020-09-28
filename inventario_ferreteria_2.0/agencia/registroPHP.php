<?php
ob_start();

$nombre=$_POST["nom"];
$direccion=$_POST["dir"];
$estado="activo";
$registro=date("Y-m-d");

try{ 
require("../conexion.php");
// verificacion de foto


	//verificacion de CI duplicada
	
		$sql3="select * from tbl_agencias where nombre=:nom";
		$resultado3=$base->prepare($sql3);
		$resultado3->execute(array(":nom"=>$nombre));
		
		
		if($resultado3->rowCount()>0){
		
		header("Location:registroFMR.php?errornombre");
		
		}
		 else{
			
			$sql="INSERT into tbl_agencias(nombre,direccion, estado) values(:nom,:dir, :est)";
			$resultado=$base->prepare($sql);
			if($resultado->execute(array(":nom"=>$nombre,":dir"=>$direccion, ":est"=>$estado))){
			header("Location:agencia.php?mensaje");
			echo $rude;
			}else {
				
				header("Location:agencia.php?mensaje2");
				
				}
			$resultado->closeCursor();
			}
		}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	
	
	}
?>