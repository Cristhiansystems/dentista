<?php
ob_start();
include ("../conexion.php");
$estado=$_POST['estado'];

 $pagina=isset($_POST['pagina'])? (int)$_POST['pagina']:1;
    $regpagina=10;
  
    $inicio=($pagina>1)?(($pagina*$regpagina)-$regpagina):0;


	$html=" ";

    if($estado=="activo"){
	$registros=$base->query("SELECT SQL_CALC_FOUND_ROWS  pac.id_paciente,pac.codigo_paciente,concat_ws(' ',pac.nombre,pac.apellido_paterno,pac.apellido_materno) AS paciente,concat_ws(' ',pac.ci,pac.extension) as ci,  DATE_FORMAT( pac.fecha_nacimiento,  '%d-%m-%Y' ) AS fecha_nacimiento ,pac.celular, aseg.nombre AS aseguradora ,pac.email,pac.antecedente_patologico FROM tbl_pacientes pac left join tbl_aseguradoras aseg on pac.id_aseguradora=aseg.id_aseguradora where pac.estado='$estado'   order by pac.apellido_paterno, pac.apellido_materno, pac.nombre limit $inicio , $regpagina ")->fetchAll(PDO::FETCH_OBJ);
}else if($estado=="desactivo"){
    $registros=$base->query("SELECT SQL_CALC_FOUND_ROWS  pac.id_paciente,pac.codigo_paciente,concat_ws(' ',pac.nombre,pac.apellido_paterno,pac.apellido_materno) AS paciente, concat_ws(' ',pac.ci,pac.extension) as ci,  DATE_FORMAT( pac.fecha_nacimiento,  '%d-%m-%Y' ) AS fecha_nacimiento ,pac.celular, aseg.nombre AS aseguradora ,pac.email,pac.antecedente_patologico FROM tbl_pacientes pac left join tbl_aseguradoras aseg on pac.id_aseguradora=aseg.id_aseguradora where pac.estado='$estado'   order by pac.apellido_paterno, pac.apellido_materno, pac.nombre limit $inicio , $regpagina ")->fetchAll(PDO::FETCH_OBJ);

}

 $Totalregistros=$base->query("SELECT FOUND_ROWS() as Total");
    $Totalregistros=$Totalregistros->fetch()['Total'];
    $numeropaginas=ceil($Totalregistros/$regpagina);
$html.="<table  class='table table-striped table-bordered' >";
$html.="<thead>
    <tr >
    	<th scope='col'>Codigo</th>
        <th scope='col'>Paciente</th>
        <th scope='col'>Ci</th>
        <th scope='col'>Fecha de Nacimiento</th>
        <th scope='col'>Celular</th>
        <th scope='col'>Email</th>
		<th scope='col'>Seguro Médico</th>
        <th scope='col'>Antecedente Patológico</th>";

        if($estado=="activo"){ 
            $html.="<th scope='col'>Borrar</th>";
        }
        else {
            $html.="<th scope='col'>Restaurar</th>";
        }
        

        $html.="<th scope='col'>Actualizar</th>   
        </tr>
        </thead>
        <tbody>";
        if($Totalregistros>=1):
foreach($registros as $pacientes):

    if($estado=="activo"){
        $html.="<tr>";
    }else{
        $html.="<tr style='background:#CD6048'>";
    }
	
	$html.="<input type='hidden' name='id' id='id' value='$pacientes->id_paciente'>
	
    <td>$pacientes->codigo_paciente</td>
	<td>$pacientes->paciente</td>
    <td>$pacientes->ci</td>
	<td>$pacientes->fecha_nacimiento</td>
    <td>$pacientes->celular</td>
    <td>$pacientes->email</td>
    <td>$pacientes->aseguradora</td>
    <td>$pacientes->antecedente_patologico</td>";
    if($estado=="activo"){

 	  $html.="<td><input type='button' class='btn btn-danger' name='del' id='del-$pacientes->id_paciente' value='borrar'></td>";
    }else{
         $html.="<td><input type='button' class='btn btn-info' onClick='rest($pacientes->id_paciente)' name='rest' id='rest' value='restaurar'>";
     }
	
			
    $html.="<td><a href='actualizar.php?id=$pacientes->id_paciente'><input class='btn btn-success' type='button' name='ac' id='ac' value='actualizar'></a></td></tr>";

endforeach;
else:
     $html.="<tr><td colspan='9'>No tiene registros guardados</td></tr>";
endif;


$html.="</tbody></table>";
 if($Totalregistros>=1):
        $html.="<nav aria-label='Page navigation' class='text-right'>
                    <ul class='pagination'>";
                        if($pagina==1):

                         $html.="<li class='disabled'>    
                                    <a  rol='button'  aria-label='Previous'> 
                                         <span aria-hidden='true'>&laquo;</span>
                                    </a>        
                                </li>";
                        else:
                        $html.="<li>    
                                    <a rol='button' id='btnpag' data=".($pagina-1)." aria-label='Previous'>
                                        <span aria-hidden='true'>&laquo;</span>
                                    </a>
                                </li>";
                        endif;
                        for($i=1;$i<=$numeropaginas ;$i++){
                            if($pagina==$i){
                                 $html.="<li class='active'>
                                            <a rol='button' id='btnpag'  data=$i>$i</a>
                                        </li>";
                            }else{
                                 $html.="<li >
                                            <a rol='button'  id='btnpag'  data=$i >$i</a>
                                        </li>";
                            }
                        }

                        if($pagina==$numeropaginas):
                   $html.="
                        <li class='disabled'>
                            <a rol='button' aria-label='Next'>
                                <span aria-hidden='true'>&raquo;</span>
                            </a>
                        </li>";
                        else :
                              $html.="
                        <li>
                            <a rol='button' id='btnpag'  data=".($pagina+1)." aria-label='Next'>
                                <span aria-hidden='true'>&raquo;</span>
                            </a>
                        </li>";
                    endif;

                  $html.="  </ul>
                </nav>";
        endif;
echo $html;
?>
