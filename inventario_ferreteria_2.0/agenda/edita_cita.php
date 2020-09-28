<?php
include('../conexion.php');
$id = $_POST['id'];

$valores = $base->query("SELECT ct.id_cita,ct.fecha,ct.hora_inicio,ct.hora_fin,ct.estado,pac.id_paciente,concat(pac.nombre,' ',pac.apellido_paterno,' ',pac.apellido_materno) as paciente,pac.celular,tbl_medicos.id_empleado as id_medico,tbl_medicos.medico,tbl_asistentes.id_empleado as id_asistente,tbl_asistentes.asistente,ct.id_consultorio, tbl_medicos.celular as med_celular
FROM tbl_citas ct 
inner join tbl_pacientes pac on  ct.id_paciente=pac.id_paciente
inner join (Select id_empleado,concat(tbl_empleados.nombre,' ',tbl_empleados.apellido_paterno,' ',tbl_empleados.apellido_materno) as medico, tbl_empleados.celular  from tbl_empleados where tbl_empleados.tipo_empleado='Medico') as tbl_medicos on tbl_medicos.id_empleado=ct.id_medico
inner join (Select id_empleado,concat(tbl_empleados.nombre,' ',tbl_empleados.apellido_paterno,' ',tbl_empleados.apellido_materno) as asistente from tbl_empleados where tbl_empleados.tipo_empleado='Asistente') as tbl_asistentes on tbl_asistentes.id_empleado=ct.id_empleado
WHERE id_cita='$id'");
$valores2 = $valores->fetch();
$datos = array(
				0 => $valores2['id_cita'],
				1 => $valores2['fecha'],
				2=>$valores2['hora_inicio'],
				3=>$valores2['hora_fin'],
				4=>$valores2['estado'],
				5=>$valores2['id_paciente'],
				6=>$valores2['paciente'],

				7=>$valores2['id_medico'],
				8=>$valores2['medico'],
				9=>$valores2['id_asistente'],
				10=>$valores2['asistente'],
				11=>$valores2['id_consultorio'],
				12=>$valores2['celular'],
				13=>$valores2['med_celular'],
				); 
echo json_encode($datos);
?>