<?php
ob_start();
include ("../conexion.php");
$id=$_POST["ide"];
$ci=$_POST['ci'];
$fi=$_POST['fi'];
$ff=$_POST['ff'];

try{

	$sql="UPDATE venta set estado=:est where id_venta=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":id"=>$id, ":est"=>"desactivo"));

}
catch (Exception $e){
	 $html= $e->getMessage();
	}
	$html=" ";
		$registros=$base->query("Select venta.id_venta, venta.precio, venta.registro, cliente.nombre, cliente.apellido_paterno From venta INNER JOIN cliente on cliente.id_cliente=venta.id_cliente where ci='$ci' and venta.estado='activo' and venta.tipo='Venta' or venta.registro between '$fi' and '$ff' and venta.estado='activo' and venta.tipo='Venta' order by id_venta")->fetchAll(PDO::FETCH_OBJ);
		
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


	
	$html.="<tr><input type='hidden' name='id' id='id' value='$productos->id_venta'>

    <td>$productos->id_venta</td>
	<td>$productos->nombre $productos->apellido_paterno</td>
	<td>$productos->registro</td>
	<td>$productos->precio Bs</td>
 	<td><input type='button' class='btn btn-danger' name='del' id='del-$productos->id_venta' value='borrar'></td>
	
	
    <td><a href='boleta.php?id=$productos->id_venta'><input class='btn btn-info' type='button' name='ac' id='ac' value='recibo'></a></td>
</tr>";

endforeach;

$html.="</tbody></table";
echo $html;
?>
