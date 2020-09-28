<?php
ob_start();
	require ('../conexion.php');
	$ide = $_POST['ide'];

	try {
		header('Content-Type: application/json');

				$detalle=$base->query("SELECT tratamiento.nombre as tratamiento, tratamiento.seguro, pieza.pieza as pieza, pieza.id_pieza, pieza.nombre as piezanom, tratamiento.id_tratamiento, precio_unitario, fecha_detalle, realizado, estado_pago, detalle_tratamiento.id_pago, tbl_empleados.nombre, apellido_paterno, detalle_tratamiento.id_medico, detalle_tratamiento.id_detalle_tratamiento FROM detalle_tratamiento INNER JOIN tratamiento on tratamiento.id_tratamiento=detalle_tratamiento.id_tratamiento left join pieza on pieza.id_pieza=detalle_tratamiento.id_pieza inner join tbl_empleados on tbl_empleados.id_empleado=detalle_tratamiento.id_medico where detalle_tratamiento.id_detalle_tratamiento='$ide'")->fetchAll(PDO::FETCH_OBJ);
			
		
		

	}
	catch (Exception $e){
		echo $html= $e->getMessage();
		}
	
	echo json_encode($detalle, JSON_FORCE_OBJECT);	
?>