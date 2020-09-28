
        	<?php
        	include ('../conexion.php');
	
		
	 
		
		
		$query =$base->prepare("SELECT
ct.id_cita as id,
agc.id_agencia as resourceId ,
concat(ct.fecha,'T',ct.hora_inicio) as start,
concat(ct.fecha,'T',ct.hora_fin) as end, concat( UPPER(tbl_asistentes.alias),' ', UPPER(pct.nombre),' ', UPPER(pct.apellido_paterno),' ',UPPER( pct.apellido_materno), ' ',UPPER( pct.celular),' ', UPPER( tbl_medicos.medico),' ',UPPER(ct.estado)) as title, case ct.estado  when 'Registrado' then '#0000FF'  when 'Pendiente' then '#FFFF00'  when 'Confirmado' then '#39FF14' when 'Cancelado' then '#FF0000'  end as color, case ct.estado   when 'Pendiente' then '#000000'  when 'Confirmado'  then '#000000'  end as textColor
from tbl_citas ct 
inner join tbl_agencias agc on agc.id_agencia=ct.id_sucursal 
inner join tbl_pacientes pct on pct.id_paciente=ct.id_paciente
INNER JOIN (SELECT tbl_empleados.id_empleado,concat(tbl_empleados.alias,' ', tbl_empleados.apellido_paterno) as medico from tbl_empleados where tbl_empleados.tipo_empleado='Medico') as tbl_medicos  on tbl_medicos.id_empleado=ct.id_medico
inner join (SELECT tbl_empleados.id_empleado,tbl_empleados.alias from tbl_empleados where tbl_empleados.tipo_empleado='Asistente') as tbl_asistentes on tbl_asistentes.id_empleado=ct.id_empleado 

where ct.estado != 'Anulado' ");
		$query->execute();
	
 				//echo 'intentando obtener registros';
    			$results = $query->fetchAll(PDO::FETCH_ASSOC);
   				echo json_encode($results);
		
	?>
		
	 