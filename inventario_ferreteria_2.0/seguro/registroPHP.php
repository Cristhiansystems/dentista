<?php
ob_start();

$nombre=$_POST["nom"];

$estado="activo";
$registro=date("Y-m-d");

try{ 
require("../conexion.php");
// verificacion de foto


	//verificacion de CI duplicada
	
		$sql3="select * from tbl_aseguradoras where nombre=:nom";
		$resultado3=$base->prepare($sql3);
		$resultado3->execute(array(":nom"=>$nombre));
		
		
		if($resultado3->rowCount()>0){
		
		header("Location:registroFMR.php?errornombre");
		
		}
		 else{
			
			$sql="INSERT into tbl_aseguradoras(nombre,estado) values(:nom, :est)";
			$resultado=$base->prepare($sql);
			if($resultado->execute(array(":nom"=>$nombre,":est"=>$estado))){
			header("Location:seguro.php?mensaje");
			echo $rude;
			}else {
				
				header("Location:seguro.php?mensaje2");
				header("Location:" . $_SERVER['HTTP_REFERER']); //la pagina anterior o poner la pagina que tu quieras
						die();
				}
			$resultado->closeCursor();
			}
		}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	
	
	}
?>