<?php
ob_start();
include ("../conexion.php");
$estado=$_POST['estado'];

	$html="";
	$registros=$base->query("SELECT * FROM pieza where estado='$estado' order by pieza + 0")->fetchAll(PDO::FETCH_OBJ);
$html.="<table align='center' id='tabla' class='table'>";
$html.="<thead>
    <tr>
     <th scope='col'>Nombre</th>
		 <th scope='col'>N°</th>
       
        <th scope='col'>Tipo</th>";
		if($estado=="activo"){
			$html.="<th scope='col'>Borrar</th>";
		}else{
			$html.="<th scope='col'>Restaurar</th>";
		}
		
        $html.="<th scope='col'>Actualizar</th>

    </tr>
</thead>
<tbody>";
foreach($registros as $productos):


	if($estado=="activo"){
		$html.="<tr>";
	}else{
		$html.="<tr style='background:#CD6048'>";
	}
	
		$html.="<input type='hidden' name='id' id='id' value='$productos->id_pieza'>
	
	<td>$productos->nombre</td>
	<td>$productos->pieza</td>
	<td>$productos->tipo</td>";
	if($estado=="activo"){
		$html.="<td><input type='button' class='btn btn-danger' name='del' id='del-$productos->id_pieza' value='borrar'></td>";
	}else{
		$html.="<td><input type='button' class='btn btn-info' onClick='rest($productos->id_pieza)' name='rest' id='rest' value='restaurar'>";
	}
 	
	
			
    $html.="<td><a href='actualizar.php?id=$productos->id_pieza'><input class='btn btn-success' type='button' name='ac' id='ac' value='actualizar'></a></td>

</tr>";

endforeach;

$html.="</tbody></table";
echo $html;
?>
