<?php

	ob_start();
	require ('../conexion.php');
header('Content-Type: application/json');
	$pieza = $_POST['pieza'];
	$registros2=$base->query("SELECT * FROM pieza where pieza='$pieza'")->fetchAll(PDO::FETCH_OBJ);
	$pieza="la pieza no esta registrada";
	$id_pieza="";
	
	if(count($registros2)>0){
		
		$nombre=$registros2[0]->nombre;
		$numpieza=$registros2[0]->pieza;
		$pieza=$nombre ." N° $numpieza";
		$id_pieza=$registros2[0]->id_pieza;
		
		}
		$data=array();
		$data["pieza"]=$pieza;
		$data["id_pieza"]=$id_pieza;
	echo json_encode($data, JSON_FORCE_OBJECT);	
?>
