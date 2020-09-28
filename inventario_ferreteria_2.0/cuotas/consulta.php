<?php
ob_start();
include ("../conexion.php");
	$feci=$_POST["feci"];
	$fecf=$_POST["fecf"];
	$ci=$_POST["ci"];
	$est=$_POST["est"];


	$html="";
	if($est=="activo"){
		$registros=$base->query("SELECT cuenta.id_cuenta, nombre, apellido_paterno, apellido_materno, fecha, costo, ci, cuenta.estado From CUENTA INNER JOIN tbl_pacientes on tbl_pacientes.id_paciente=cuenta.id_paciente where tbl_pacientes.codigo_paciente='$ci' and cuenta.estado='$est' AND 0<(select Count(*) as numero from tbl_cuotas WHERE id_cuenta= cuenta.id_cuenta) or tbl_pacientes.ci='$ci' and cuenta.estado='$est' AND 0<(select Count(*) as numero from tbl_cuotas WHERE id_cuenta= cuenta.id_cuenta) or cuenta.fecha between '$feci' and '$fecf' and cuenta.estado='$est' and 0<(select Count(*) as numero from tbl_cuotas WHERE id_cuenta= cuenta.id_cuenta) order by cuenta.fecha, apellido_paterno, apellido_materno, nombre, id_cuenta")->fetchAll(PDO::FETCH_OBJ);
		
	}else if($est=="desactivo"){
	
	$registros=$base->query("SELECT cuenta.id_cuenta, nombre, apellido_paterno, apellido_materno, fecha, costo, ci, cuenta.estado From CUENTA INNER JOIN tbl_pacientes on tbl_pacientes.id_paciente=cuenta.id_paciente where cuenta.estado='$est' order by cuenta.fecha, apellido_paterno, apellido_materno, nombre, id_cuenta")->fetchAll(PDO::FETCH_OBJ);
}
	
$html.="<table align='center' id='tabla' class='table'>";
$html.="<thead>
    <tr>
    	
        <th scope='col'>Paciente</th>
        <th scope='col'>CI</th>
        <th scope='col'>Costo</th>
		<th scope='col'>Fecha</th>";
		if($est=="activo"){
			$html.="<th scope='col'>Borrar</th>";
		}else if($est=="desactivo"){
			$html.="<th scope='col'>Restaurar</th>";
		}
		
		$html.="<th scope='col'>Actualizar</th>

    </tr>
</thead>
<tbody>";
foreach($registros as $productos):


	if($productos->estado=="activo"){
		$html.="<tr>";
	}else if($productos->estado=="desactivo"){
		$html.="<tr style='background:#CD6048'>";
	}
	
		$html.="<input type='hidden' name='id' id='id' value='$productos->id_cuenta'>

	<td>$productos->apellido_paterno $productos->apellido_materno $productos->nombre </td>
	<td>$productos->ci </td>
	<td>$productos->fecha</td>
	<td>$productos->costo Bs</td>";
	if($productos->estado=="activo"){
		$html.="<td><input type='button' class='btn btn-danger' name='del' id='del-$productos->id_cuenta' value='borrar'></td>";
	}else if($productos->estado=="desactivo"){
		$html.="<td><input type='button' class='btn btn-info' onClick='rest($productos->id_cuenta)' name='rest' id='rest' value='restaurar'>";
	}
 	
    $html.="<td><a href='actualizar.php?id=$productos->id_cuenta'><input class='btn btn-success' type='button' name='ac' id='ac' value='actualizar'></a></td>
	
	
</tr>";

endforeach;

$html.="</tbody></table";
echo $html;
?>
