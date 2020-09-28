<?php
ob_start();
include ("../conexion.php");
	$id=$_POST["id"];



	$html="";
	$cuotas=$base->query("SELECT cuo.id_cuota,cuo.numero as nro,case cuo.fecha when '0000-00-00' then '' else  cuo.fecha end as fechcuo, cuo.monto as montocuo, cuo.estado as estadocuo,cuo.id_pago FROM tbl_cuotas cuo INNER JOIN cuenta cue on cuo.id_cuenta=cue.id_cuenta where cuo.id_cuenta='$id'")->fetchAll(PDO::FETCH_OBJ);
	 $html.=" <table class='table table-bordered' >

               <thead>
               	<tr>
               		<th>Cuotas</th>
               		<th>Fecha</th>
               		<th>Monto</th>
               		<th>Estado</th>
               		<th>Acción</th>
               	
               	</tr>
               </thead> 
               <tbody>";
	
 foreach($cuotas as $cuo):
					 $cont=$cuo->id_cuota;
					 $numero=$cuo->nro;
					 $fecha=$cuo->fechcuo;
					 $monto=$cuo->montocuo;
					 $estado=$cuo->estadocuo;
					 $id_pago=$cuo->id_pago;
					 if($estado=="Pagado"){
					$bgcolor="#abebc6";	
					}else if($estado=="Pendiente"){
					$bgcolor="#f7dc6f";
					}
					 
				
               $html.="<tr>";
				
					 $html.="<td>$numero</td>";
					 $html.= "<td>$fecha</td>";
					 $html.= "<td class='montocuo' >$monto</td>";
					 $html.= "<td>$estado</td>";
					 if($estado=="Pendiente"){
					$html.="<td><button   name='cuo' id='cuo-$numero' data-cuota=$cont class='btn btn-success'>Pagar</button></td></tr>";
				}else{

					$html.="<td><button  name='ver' id='ver-$numero' data-vercuo=$id_pago class='btn btn-warning'>Ver</button></td></tr>";
				}
					
					
					 endforeach;
					 $html.= " </tbody>
              </table>";
echo $html;
?>
