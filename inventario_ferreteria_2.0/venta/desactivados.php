<?php
ob_start();
include ("../conexion.php");


	$html=" ";
	$registros=$base->query("Select venta.id_venta, venta.precio, venta.registro, cliente.nombre, cliente.apellido_paterno From venta INNER JOIN cliente on cliente.id_cliente=venta.id_cliente where venta.estado='desactivo' and venta.tipo='Venta' order by id_venta")->fetchAll(PDO::FETCH_OBJ);
$html.="<table align='center' id='tabla' class='table'>";
$html.="<thead>
    <tr>
    	
        <th scope='col'>Venta</th>
        <th scope='col'>Cliente</th>
        <th scope='col'>Fecha</th>
		<th scope='col'>Precio</th>
		<th scope='col'>Borrar</th>
		<th scope='col'>Recibo</th>
    </tr>
</thead>
<tbody>";
foreach($registros as $productos):


	
	$html.="<tr style='background:#CD6048'><input type='hidden' name='id' id='id' value='$productos->id_venta'>

    <td>$productos->id_venta</td>
	<td>$productos->nombre $productos->apellido_paterno</td>
	<td>$productos->registro</td>
	<td>$productos->precio Bs</td>
 	<td><input type='button' class='btn btn-info' onClick='rest($productos->id_venta)' name='rest' id='rest' value='restaurar'></td>
	
    <td><a href='boleta.php?id=$productos->id_venta'><input class='btn btn-info' type='button' name='ac' id='ac' value='recibo'></a></td>
</tr>";

endforeach;

$html.="</tbody></table";
echo $html;


?>
