<?php
ob_start();
include ("../conexion.php");
    $estado=$_POST['estado'];
     $pagina=isset($_POST['pagina'])? (int)$_POST['pagina']:1;
    $regpagina=10;
  
    $inicio=($pagina>1)?(($pagina*$regpagina)-$regpagina):0;


	$html="";
	if($estado=="activo"){
	$registros=$base->query("SELECT  SQL_CALC_FOUND_ROWS * FROM tbl_agencias where estado='$estado' order by nombre limit $inicio , $regpagina")->fetchAll(PDO::FETCH_OBJ);
}else if($estado=="desactivo"){
$registros=$base->query("SELECT  SQL_CALC_FOUND_ROWS * FROM tbl_agencias where estado='$estado' order by nombre limit $inicio , $regpagina")->fetchAll(PDO::FETCH_OBJ);
}
 $Totalregistros=$base->query("SELECT FOUND_ROWS() as Total");
    $Totalregistros=$Totalregistros->fetch()['Total'];
    $numeropaginas=ceil($Totalregistros/$regpagina);
$html.="<table class='table table-striped table-bordered' >";
$html.="<thead>
    <tr>

        <th scope='col'>Nombre</th>
        <th scope='col'>Direccion</th>";
		if($estado=="activo"){
			$html.="<th scope='col'>Borrar</th>";
		}else{
			$html.="<th scope='col'>Restaurar</th>";
		}
		
        $html.="<th scope='col'>Actualizar</th>

    </tr>
</thead>
<tbody>";
if($Totalregistros>=1):
foreach($registros as $productos):


	if($estado=="activo"){
		$html.="<tr>";
	}else{
		$html.="<tr style='background:#CD6048'>";
	}
	
		$html.="<input type='hidden' name='id' id='id' value='$productos->id_agencia'>

	<td>$productos->nombre</td>
	<td>$productos->direccion</td>";
	if($estado=="activo"){
		$html.="<td><input type='button' class='btn btn-danger' name='del' id='del-$productos->id_agencia' value='borrar'></td>";
	}else{
		$html.="<td><input type='button' class='btn btn-info' onClick='rest($productos->id_agencia)' name='rest' id='rest' value='restaurar'>";
	}
 	
	
			
    $html.="<td><a href='actualizar.php?id=$productos->id_agencia'><input class='btn btn-success' type='button' name='ac' id='ac' value='actualizar'></a></td></tr>";
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
                                    <a  rol='button'   aria-label='Previous'> 
                                         <span aria-hidden='true'>&laquo;</span>
                                    </a>        
                                </li>";
                        else:
                        $html.="<li>    
                                    <a rol='button' id='btnpag'  data=".($pagina-1)." aria-label='Previous'>
                                        <span aria-hidden='true'>&laquo;</span>
                                    </a>
                                </li>";
                        endif;
                        for($i=1;$i<=$numeropaginas ;$i++){
                            if($pagina==$i){
                                 $html.="<li class='active'>
                                            <a rol='button'  id='btnpag'  data=$i>$i</a>
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
                            <a rol='button'  aria-label='Next'>
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
