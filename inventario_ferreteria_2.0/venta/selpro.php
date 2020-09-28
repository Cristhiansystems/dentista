<?php
ob_start();
$pro=$_POST["pro"];
$html="";
try{ 
require("../conexion.php");

$registros=$base->query("SELECT * from producto where id_producto='$pro' and estado='activo' order by nombre")->fetchAll(PDO::FETCH_OBJ);
if(count($registros)>0){
		
		$nombre=$registros[0]->nombre;
		$precio=$registros[0]->precio;
		$cantidad=$registros[0]->cantidad;
	
		$html="$nombre \n stock :$cantidad \n Precio: $precio Bs. -$precio";
		
		}
		
}
catch(Exception $e){
	
	$html.= "linea del error " . $e->getLine();
	$html.= "linea del error " . $e->getMessage();
	//header("Location:registroFMR.php?mensaje3");
	
	}
 
					echo $html;
?>
