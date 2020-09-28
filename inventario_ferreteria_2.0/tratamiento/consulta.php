<?php
ob_start();
include ("../conexion.php");
$esp=$_POST['esp'];
$estado=$_POST['estado'];

	$html="";
if($estado=="activo"){
	$registros=$base->query("SELECT especialidad.nombre as especialidad, tratamiento.nombre, tratamiento.id_tratamiento, tratamiento.codigo, precio FROM tratamiento INNER JOIN especialidad on tratamiento.id_especialidad=especialidad.id_especialidad  where tratamiento.estado='$estado' and tratamiento.id_especialidad='$esp' order by  tratamiento.nombre")->fetchAll(PDO::FETCH_OBJ);
}else if($estado=="desactivo"){
	
	$registros=$base->query("SELECT especialidad.nombre as especialidad, tratamiento.nombre, tratamiento.id_tratamiento, tratamiento.codigo, precio FROM tratamiento INNER JOIN especialidad on tratamiento.id_especialidad=especialidad.id_especialidad  where tratamiento.estado='$estado' order by  tratamiento.nombre")->fetchAll(PDO::FETCH_OBJ);
}

$html.="<table align='center' id='tabla' class='table'>";
$html.="<thead>
    <tr>
    	<th scope='col'>Codigo</th>
        <th scope='col'>Tratamiento</th>
        <th scope='col'>Costo</th>
		<th scope='col'>Especialidad</th>";
		if($estado=="activo"){
			$html.="<th scope='col'>Borrar</th>";
		}else{
			$html.="<th scope='col'>Restaurar</th>";
		}
		
        $html.="<th scope='col'>Actualizar</th>
        <th scope='col'>Ver</th>
    </tr>
</thead>
<tbody>";
foreach($registros as $productos):


	
	if($estado=="activo"){
		$html.="<tr>";
	}else{
		$html.="<tr style='background:#CD6048'>";
	}
		
	$html.="<input type='hidden' name='id' id='id' value='$productos->id_tratamiento'>
	
    <td>$productos->codigo</td>
    <td>$productos->nombre</td>
	<td>$productos->precio Bs.</td>
	<td>$productos->especialidad</td>";

	if($estado=="activo"){
		$html.="<td><input type='button' class='btn btn-danger' name='del' id='del-$productos->id_tratamiento' value='borrar'></td>";
	}else{
		$html.="<td><input type='button' class='btn btn-info' onClick='rest($productos->id_tratamiento)' name='rest' id='rest' value='restaurar'>";
	}
 	
	
			
    $html.="<td><a href='actualizar.php?id=$productos->id_tratamiento'><input class='btn btn-success' type='button' name='ac' id='ac' value='actualizar'></a></td>
    <td><input type='button' class='btn btn-warning' onClick='ver($productos->id_tratamiento)'  name='ver' id='ver' value='ver'></td>
</tr>";

endforeach;

$html.="</tbody></table";
echo $html;
?>
