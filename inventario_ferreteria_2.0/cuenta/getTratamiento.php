<?php

	ob_start();
	require ('../conexion.php');
header('Content-Type: application/json');
	$tra = $_POST['tra'];
	$registros2=$base->query("SELECT * FROM tratamiento where nombre='$tra' or codigo='$tra'")->fetchAll(PDO::FETCH_OBJ);
	$tratamiento="El tratamiento no esta registrado";
	$id_tratamiento="";
	$precio="0";
	$nombre="";
	$seg="";
	if(count($registros2)>0){
		
		$nombre=$registros2[0]->nombre;
		$precio=$registros2[0]->precio;
		$tratamiento="Tratamiento : " .$nombre ." Precio: ($precio Bs.)";
		$id_tratamiento=$registros2[0]->id_tratamiento;
		$seg=$registros2[0]->seguro;
		
		}
		$data=array();
		$data["tratamiento"]=$tratamiento;
		$data["codtra"]=$id_tratamiento;
		$data["precio"]=$precio;
		$data["nombre"]=$nombre;
		$data["seg"]=$seg;
	echo json_encode($data, JSON_FORCE_OBJECT);	
?>
