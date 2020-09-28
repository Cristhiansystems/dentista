<?php
ob_start();

$nombre=$_POST["nom"];
$id_agencia=$_POST["age"];


$estado="activo";
$registro=date("Y-m-d");

try{ 
require("../conexion.php");
// verificacion de foto


	
		$sql3="SELECT * from tbl_consultorios where nombre=:nom ";
		$resultado3=$base->prepare($sql3);
		$resultado3->execute(array(":nom"=>$nombre));
		echo $resultado3->rowCount();
		
		if($resultado3->rowCount()>0){
		
		header("Location:registroFMR.php?errornombre");
		
		}
		 else{
			
			$sql="INSERT into tbl_consultorios(nombre,  estado ,id_agencia) values(:nom, :est,:idag )";
			$resultado=$base->prepare($sql);
			if($resultado->execute(array( ":nom"=>$nombre, ":est"=>$estado, ":idag"=>$id_agencia)))
			{
			header("Location:consultorio.php?mensaje");
			echo $rude;
			}else {
				
				header("Location:registroFMR.php?mensaje2");
				
				}
			$resultado->closeCursor();
			}
		}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	//header("Location:registroFMR.php?mensaje3");
	
	}
?>