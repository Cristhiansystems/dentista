<?php

	//ob_start();
	require ('../conexion.php');
	
	$registros2=$base->query("SELECT id_agencia,nombre FROM tbl_agencias where estado='activo' ")->fetchAll(PDO::FETCH_OBJ);
	
	
	echo json_encode($registros2);
?>