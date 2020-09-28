<?php
ob_start();

$nombre=$_POST["nom"];
$numero=$_POST["pie"];
$tipo=$_POST["tipo"];
$estado="activo";
$registro=date("Y-m-d");

try{ 
require("../conexion.php");
// verificacion de foto


	//verificacion de CI duplicada
	
		$sql3="select * from pieza where pieza=:num";
		$resultado3=$base->prepare($sql3);
		$resultado3->execute(array(":num"=>$numero));
		
		
		if($resultado3->rowCount()>0){
		
		header("Location:registroFMR.php?errornombre");
		
		}
		 else{
			
			$sql="insert into pieza(nombre, pieza,tipo, estado) values(:nom, :pie,:tip, :est)";
			$resultado=$base->prepare($sql);
			if($resultado->execute(array(":nom"=>$nombre, ":pie"=>$numero,":tip"=>$tipo ,":est"=>$estado))){
			header("Location:piezas.php?mensaje");
			echo $rude;
			}else {
				
				header("Location:piezas.php?mensaje2");
				
				}
			$resultado->closeCursor();
			}
		}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	
	
	}
?>