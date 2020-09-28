<?php

	ob_start();
	require ('../conexion.php');
	$ci = $_POST['ci'];
	$registros2=$base->query("SELECT * FROM estudiante where ci='$ci'")->fetchAll(PDO::FETCH_OBJ);
	$html="";
	
	if(count($registros2)>0){
		
		$nombre=$registros2[0]->nombre;
		$apellido=$registros2[0]->apellido_paterno;
		$html="El estudiante ya esta registrado: " .$apellido . " " .$nombre;
		
		}
		

	echo $html;
?>


