<?php

	ob_start();
	require ('../conexion.php');
header('Content-Type: application/json');
	$ci = $_POST['ci'];
	$paciente="El paciente no esta registrado";
	$id_paciente="";
	$seg="";
	$seguro="";
if($ci!=""){
	$registros2=$base->query("SELECT tbl_pacientes.apellido_paterno,tbl_pacientes.nombre,tbl_pacientes.id_paciente,tbl_aseguradoras.nombre,tbl_pacientes.ci FROM tbl_pacientes inner join tbl_aseguradoras on tbl_pacientes.id_aseguradora=tbl_aseguradoras.id_aseguradora where ci='$ci' or codigo_paciente='$ci'")->fetchAll(PDO::FETCH_OBJ);
	
	
	if(count($registros2)>0){
		
		$nombre=$registros2[0]->nombre;
		$apellido=$registros2[0]->apellido_paterno;
		$ci=$registros2[0]->ci;
		$paciente="El paciente esta registrado: " .$apellido . " " .$nombre ." CI:($ci)";
		$id_paciente=$registros2[0]->id_paciente;
		$seguro=$registros2[0]->nombre;
		
		}
	if($seguro=="Particular"){
		$seg="no";
	}else{
		$seg="si";
	}
}
		$data=array();
		$data["paciente"]=$paciente;
		$data["seg"]=$seg;
		$data["id_paciente"]=$id_paciente;
		$data["seguro"]=$nombre;
	echo json_encode($data, JSON_FORCE_OBJECT);	
?>
