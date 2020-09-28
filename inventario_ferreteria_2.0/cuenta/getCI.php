<?php

	ob_start();
	require ('../conexion.php');
header('Content-Type: application/json');
	$ci = $_POST['ci'];
	$registros2=$base->query("SELECT * FROM tbl_pacientes where ci='$ci' or codigo_paciente='$ci'")->fetchAll(PDO::FETCH_OBJ);
	$paciente="El paciente no esta registrado";
	$id_paciente="";
	
	if(count($registros2)>0){
		
		$nonbre=$registros2[0]->nombre;
		$apellido=$registros2[0]->apellido_paterno;
		$ci=$registros2[0]->ci;
		$paciente="El paciente esta registrado: " .$apellido . " " .$nombre ." CI:($ci)";
		$id_paciente=$registros2[0]->id_paciente;
		}
		$data=array();
		$data["paciente"]=$paciente;
		$data["id_paciente"]=$id_paciente;
		echo json_encode($data, JSON_FORCE_OBJECT);	
?>


