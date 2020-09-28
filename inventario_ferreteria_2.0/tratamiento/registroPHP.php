<?php
ob_start();
$codigo=$_POST["cod"];
$nombre=$_POST["nom"];
$costo=$_POST["prec"];
$esp=$_POST["esp"];
$seg=$_POST["seg"];

$estado="activo";
$registro=date("Y-m-d");

try{ 
require("../conexion.php");
// verificacion de foto


	
		$sql3="select * from tratamiento where nombre=:nom or codigo=:cod";
		$resultado3=$base->prepare($sql3);
		$resultado3->execute(array(":nom"=>$nombre, ":cod"=>$codigo));
		echo $resultado3->rowCount();
		
		if($resultado3->rowCount()>0){
		
		header("Location:registroFMR.php?errornombre");
		
		}
		 else{
		 	
		 	foreach ($esp as $especialidad) {

		 		$sql="insert into tratamiento(nombre, codigo, id_especialidad, precio, seguro, estado) values(:nom, :cod, :esp, :prec,  :seg, :est)";
					$resultado=$base->prepare($sql);
					$resultado->execute(array( ":nom"=>$nombre, ":cod"=>$codigo, ":prec"=>$costo, ":seg"=>$seg, ":esp"=>$especialidad,  ":est"=>$estado));

					
		 	}
			
		
		
			header("Location:tratamiento.php?mensaje");
			
			$resultado->closeCursor();
			}
		}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	//header("Location:registroFMR.php?mensaje3");
	
	}
?>