<?php
ob_start();
$pro=$_POST["pro"];
$html="";
try{ 
require("../conexion.php");

$registros=$base->query("SELECT * from producto where id_producto='$pro'")->fetchAll(PDO::FETCH_OBJ);
	if(count($registros)>0){
		
		$precio=$registros[0]->precio;
		$html="$precio";
		
		}
	}
catch(Exception $e){
	
	$html.= "linea del error " . $e->getLine();
	$html.= "linea del error " . $e->getMessage();
	//header("Location:registroFMR.php?mensaje3");
	
	}
 
					echo $html;
?>
