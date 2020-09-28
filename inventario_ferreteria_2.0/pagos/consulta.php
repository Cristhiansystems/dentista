<?php
ob_start();
include ("../conexion.php");
$ci=$_POST['ci'];
$feci=$_POST['feci'];
$fecf=$_POST['fecf'];
$idagen=$_POST['idagencia'];

	$html="";
	$registros=$base->query("SELECT pago.id_pago, tbl_pacientes.nombre, tbl_pacientes.apellido_paterno, tbl_pacientes.apellido_materno, tbl_pacientes.ci, pago.fecha, costo_total, pago.fecha,concat_ws(' ', tbl_empleados.nombre,tbl_empleados.apellido_paterno) as medico From pago INNER JOIN cuenta on cuenta.id_cuenta=pago.id_cuenta inner join tbl_pacientes on tbl_pacientes.id_paciente=cuenta.id_paciente inner join tbl_empleados on tbl_empleados.id_empleado=pago.id_medico  where tbl_pacientes.ci='$ci' and cuenta.estado='activo' and pago.id_usuario='$idagen' or codigo_paciente='$ci' AND cuenta.estado='activo' and pago.id_usuario='$idagen' or pago.fecha between '$feci' and '$fecf' AND cuenta.estado='activo' and pago.id_usuario='$idagen'order by pago.fecha, id_pago,  apellido_paterno, apellido_materno, nombre")->fetchAll(PDO::FETCH_OBJ);
$html.="<table align='center' id='tabla' class='table'>";
$html.="<thead>
    <tr>

        <th scope='col'>N° boleta</th>
        <th scope='col'>Paciente</th>
        <th scope='col'>Medico</th>
        <th scope='col'>Monto</th>
		 <th scope='col'>Fecha</th>";

			$html.="<th scope='col'>Borrar</th>";
        $html.="<th scope='col'>Boleta</th>

    </tr>
</thead>
<tbody>";
foreach($registros as $productos):



		$html.="<tr>";

	
		$html.="<input type='hidden' name='id' id='id' value='$productos->id_pago'>

	<td>N° $productos->id_pago</td>
	<td>$productos->apellido_paterno $productos->apellido_materno $productos->nombre</td>
	<td>$productos->medico</td>
	<td>$productos->costo_total Bs.</td>
	<td>$productos->fecha</td>";

		$html.="<td><input type='button' class='btn btn-danger' name='del' id='del-$productos->id_pago' value='borrar'></td>";
	
    $html.="<td><a href='../cuenta/boleta.php?id=$productos->id_pago' target='_blank'><input class='btn btn-info' type='button' name='ac' id='ac' value='boleta'></a></td>
</tr>";

endforeach;

$html.="</tbody></table";
echo $html;
?>
