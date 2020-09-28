<?php
ob_start();

$nombre=$_POST["nom"];

$estado="activo";
$registro=date("Y-m-d");

try{ 
require("../conexion.php");
// verificacion de foto


	//verificacion de CI duplicada
	
		$sql3="select * from especialidad where nombre=:nom";
		$resultado3=$base->prepare($sql3);
		$resultado3->execute(array(":nom"=>$nombre));
		
		
		if($resultado3->rowCount()>0){
		
		header("Location:registroFMR.php?errornombre");
		
		}
		 else{
			
			$sql="insert into especialidad(nombre, estado) values(:nom, :est)";
			$resultado=$base->prepare($sql);
			if($resultado->execute(array(":nom"=>$nombre, ":est"=>$estado))){
			header("Location:especialidad.php?mensaje");
			echo $rude;
			}else {
				
				header("Location:especialidad.php?mensaje2");
				
				}
			$resultado->closeCursor();
			}
		}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	
	
	}
?>