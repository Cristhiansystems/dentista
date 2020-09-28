<?php
ob_start();
include ("../conexion.php");

$feci=$_POST['feci'];
$fecf=$_POST['fecf'];

	$html="";
	$registros=$base->query("SELECT cuenta.id_cuenta,cuenta.fecha, tbl_pacientes.nombre, tbl_pacientes.apellido_paterno, tbl_pacientes.apellido_materno, tbl_pacientes.ci,cuenta.costo,cuenta.pagado,cuenta.saldo From cuenta INNER JOIN tbl_pacientes on cuenta.id_paciente=tbl_pacientes.id_paciente where  cuenta.fecha between '$feci' and '$fecf' AND cuenta.estado='activo' and cuenta.saldo>0 order by cuenta.fecha, apellido_paterno, apellido_materno, nombre")->fetchAll(PDO::FETCH_OBJ);
$html.="<table align='center' id='tabla' class='table'>";
$html.="<thead>
    <tr>

        <th scope='col'>Fecha</th>
        <th scope='col'>Paciente</th>
        <th scope='col'>CI</th>
        <th scope='col'>Costo Total</th>
		 <th scope='col'>Pagado</th>
		  <th scope='col'>Saldo</th>";

        $html.="</tr></thead><tbody>";
foreach($registros as $productos):



		$html.="<tr>";

	
		$html.="<input type='hidden' name='id' id='id' value='$productos->id_cuenta'>

	<td>$productos->fecha</td>
	<td>$productos->apellido_paterno $productos->apellido_materno $productos->nombre</td>
	<td>$productos->ci</td>
	<td>$productos->costo Bs.</td>
	<td>$productos->pagado Bs.</td>
	<td>$productos->saldo Bs.</td>

</tr>";

endforeach;

$html.="</tbody></table";
echo $html;
?>
