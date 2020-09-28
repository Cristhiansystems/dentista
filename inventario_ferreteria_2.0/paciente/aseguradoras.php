<?php

	//ob_start();
	require ('../conexion.php');
	
	$registros2=$base->query("SELECT id_aseguradora,nombre FROM tbl_aseguradoras ")->fetchAll(PDO::FETCH_OBJ);
	
	
	echo json_encode($registros2);
?>