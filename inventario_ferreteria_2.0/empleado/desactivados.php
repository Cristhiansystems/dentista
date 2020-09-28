<?php
ob_start();
include ("../conexion.php");


	$html=" ";
	$registros=$base->query("SELECT * FROM cliente where estado='desactivo' order by apellido_paterno, apellido_materno, nombre")->fetchAll(PDO::FETCH_OBJ);
$html.="<table align='center' id='tabla' class='table'>";
$html.="<thead>
    <tr>
    	
        <th scope='col'>Apellido Paterno</th>
        <th scope='col'>Apellido Materno</th>
        <th scope='col'>Nombre</th>
		<th scope='col'>CI</th>
        <th scope='col'>Celular</th>
		<th scope='col'>Borrar</th>
        <th scope='col'>Actualizar</th>
        <th scope='col'>Ver</th>
    </tr>
</thead>
<tbody>";
if(count($registros)>0):


foreach($registros as $productos):


	
	$html.="<tr style='background:#CD6048'><input type='hidden' name='id' id='id' value='$productos->id_cliente'>
	
    
    <td>$productos->apellido_paterno</td>
    <td>$productos->apellido_materno</td>
	<td>$productos->nombre</td>
	<td>$productos->ci</td>
    <td>$productos->celular</td>
 	<td><input type='button' class='btn btn-info' onClick='rest($productos->id_cliente)' name='rest' id='rest' value='restaurar'></td>
	
			
   <td><a href='actualizar.php?id=$productos->id_cliente'><input class='btn btn-success' type='button' name='ac' id='ac' value='actualizar'></a></td>
    <td><input type='button' class='btn btn-warning' onClick='ver($productos->id_cliente)'  name='ver' id='ver' value='ver'></td>
</tr>";

endforeach;

else:
   $html.= "<tr><td>No tiene empleados desactivados</td></tr>";
endif;

$html.="</tbody></table";
echo $html;
?>
