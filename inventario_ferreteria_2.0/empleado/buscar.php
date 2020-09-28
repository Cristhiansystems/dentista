<?php
ob_start();
include ("../conexion.php");
$estado=$_POST['estado'];
$busc_empl=$_POST['buscar'];
$pagina=isset($_POST['pagina'])? (int)$_POST['pagina']:1;
$regpagina=4;
$inicio=($pagina>1)?(($pagina*$regpagina)-$regpagina):0;

	$html=" ";
	$registros=$base->query("SELECT SQL_CALC_FOUND_ROWS  emp.id_empleado,concat_ws(' ',emp.nombre,emp.apellido_paterno,emp.apellido_materno) as empleado, concat_ws(' ',emp.ci,emp.extension) as ci , emp.celular, emp.fecha_nacimiento ,emp.login ,emp.foto  FROM tbl_empleados emp where emp.estado='$estado' and concat_ws(' ',emp.apellido_paterno,emp.apellido_materno) like '%$busc_empl%'or emp.estado='$estado' and emp.nombre like '%$busc_empl%' order by emp.apellido_paterno, emp.apellido_materno, emp.nombre limit $inicio , $regpagina")->fetchAll(PDO::FETCH_OBJ);

    $Totalregistros=$base->query("SELECT FOUND_ROWS() as Total");
    $Totalregistros=$Totalregistros->fetch()['Total'];
    $numeropaginas=ceil($Totalregistros/$regpagina);

$html.="<table class='table table-bordered' align='center' id='tabla' >";
$html.="<thead>
    <tr>
        
       
        <th scope='col'>Empleado</th>
        <th scope='col'>CI</th>
        <th scope='col'>Celular</th>
         <th scope='col'>Fecha de Nacimiento</th>
         <th scope='col'>Login</th>
         <th scope='col'>Foto</th>";
         if($estado=="activo"){ 
            $html.="<th scope='col'>Borrar</th>";
        }
        else {
            $html.="<th scope='col'>Restaurar</th>";
        }
       $html.=" <th scope='col'>Actualizar</th>
    </tr>
</thead>
<tbody>";
if($Totalregistros>=1):
foreach($registros as $empleados):


     if($estado=="activo"){
        $html.="<tr>";
    }else{
        $html.="<tr style='background:#CD6048'>";
    }
    
    $html.="<input type='hidden' name='id' id='id' value='$empleados->id_empleado'>

   
    <td>$empleados->empleado</td>
    <td>$empleados->ci</td>
    <td>$empleados->celular</td>
    <td>$empleados->fecha_nacimiento</td>
     <td>$empleados->login</td>
    <td><img src=$empleados->foto alt='foto' width='80' height='80'/></td>";

 if($estado=="activo"){

      $html.="<td><input type='button' class='btn btn-danger' name='del' id='del-$empleados->id_empleado' value='borrar'></td>";
    }else{
         $html.="<td><input type='button' class='btn btn-info' onClick='rest($empleados->id_empleado)' name='rest' id='rest' value='restaurar'>";
     }
            
  $html.= " <td><a href='actualizar.php?id=$empleados->id_empleado'><input class='btn btn-success' type='button' name='ac' id='ac' value='actualizar'></a></td>
</tr>";

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
                                    <a role='button'  aria-label='Previous'> 
                                         <span aria-hidden='true'>&laquo;</span>
                                    </a>        
                                </li>";
                        else:
                        $html.="<li>    
                                    <a id='btnbuscpag' role='button' data=".($pagina-1)." aria-label='Previous'>
                                        <span aria-hidden='true'>&laquo;</span>
                                    </a>
                                </li>";
                        endif;
                        for($i=1;$i<=$numeropaginas ;$i++){
                            if($pagina==$i){
                                 $html.="<li class='active'>
                                            <a role='button' id='btnbuscpag'  data=$i>$i</a>
                                        </li>";
                            }else{
                                 $html.="<li >
                                            <a role='button' id='btnbuscpag'  data=$i >$i</a>
                                        </li>";
                            }
                        }

                        if($pagina==$numeropaginas):
                   $html.="
                        <li class='disabled'>
                            <a role='button' aria-label='Next'>
                                <span aria-hidden='true'>&raquo;</span>
                            </a>
                        </li>";
                        else :
                              $html.="
                        <li>
                            <a id='btnbuscpag' role='button' data=".($pagina+1)." aria-label='Next'>
                                <span aria-hidden='true'>&raquo;</span>
                            </a>
                        </li>";
                    endif;

                  $html.="  </ul>
                </nav>";
        endif;
echo $html;
?>
