<?php

	//ob_start();
	require ('../conexion.php');
	
	$registros2=$base->query("SELECT id_empleado, concat(nombre,' ',apellido_paterno,' ',apellido_materno) as empleado FROM tbl_empleados where tipo_empleado='Medico'")->fetchAll(PDO::FETCH_OBJ);
	
	
	echo json_encode($registros2);
?>