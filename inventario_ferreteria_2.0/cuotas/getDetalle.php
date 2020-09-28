<?php
ob_start();
include ("../conexion.php");
	$id=$_POST["id"];
;


	$html="";
	$detalle=$base->query("SELECT tratamiento.nombre as tratamiento, pieza.pieza as pieza, pieza.id_pieza, tratamiento.id_tratamiento, precio_unitario, fecha_detalle, realizado, estado_pago, detalle_tratamiento.id_pago, tbl_empleados.nombre, apellido_paterno, detalle_tratamiento.id_medico, detalle_tratamiento.id_detalle_tratamiento FROM detalle_tratamiento INNER JOIN tratamiento on tratamiento.id_tratamiento=detalle_tratamiento.id_tratamiento left join pieza on pieza.id_pieza=detalle_tratamiento.id_pieza inner join tbl_empleados on tbl_empleados.id_empleado=detalle_tratamiento.id_medico where detalle_tratamiento.id_cuenta='$id'")->fetchAll(PDO::FETCH_OBJ);
	
 foreach($detalle as $det):
					 $cont=$det->id_detalle_tratamiento;
					 $pieza=$det->pieza;
					 $tratamiento=$det->tratamiento;
					 $precio=$det->precio_unitario;
					 $fecha=$det->fecha_detalle;
					 $realizado=$det->realizado;
					 $estadopago=$det->estado_pago;
					 $idmedico=$det->id_medico;
					 $medico=$det->apellido_paterno . " " . $det->nombre;
					 $idpago=$det->id_pago;

					 if($estadopago=="Pagado"){
					$bgcolor="#abebc6";	
					$valor="<input type='checkbox' name='estcheck[]' id='estcheck-".$cont."'  checked value='$cont'>";
					}else if($estadopago=="Debe"){
					$bgcolor="#f7dc6f";
					$valor="<input type='checkbox' name='estcheck[]' id='estcheck-".$cont."' value='$cont'>";
					}else if($estadopago=="Control"){
					$bgcolor="#d5dbdb";
					$precio=0;
					$valor="<input type='checkbox' name='estcheck[]' id='estcheck-".$cont."' checked value='$cont'>";
					}else if($estadopago=="Seguro"){
					$bgcolor="#85c1e9";
					$valor="<input type='checkbox' name='estcheck[]' id='estcheck-".$cont."'  checked disabled value='$cont'> ";
					}
					 
					 
					 $html.= "<tr id='" . $cont . "'>";
					
						 $html.="<td>N° $idpago</td>";
					 
					 $html.="<td>$pieza</td>";
					 $html.= "<td>$tratamiento</td>";
					 $html.= "<td><input type='hidden' name='prec[]' id='prec-$cont' value='$precio'>$precio Bs.</td>";
					 $html.= "<td>$fecha</td>";
					 if($realizado=="si"){
						 $colorrealizado="#abebc6";
						  $html.= "<td bgcolor='$colorrealizado'><input type='hidden' name='realizado[]' id='realizado-$cont'> <input type='checkbox' name='reacheck[]' id='reacheck-$cont' checked value='$cont'></td>";
					 }else {
						 $colorrealizado="#f5b7b1";
						   $html.= "<td bgcolor='$colorrealizado'><input type='hidden' name='realizado[]' id='realizado-$cont'> <input type='checkbox' name='reacheck[]' id='reacheck-$cont' value='$cont'></td>";
					 }
					
					 $html.= "<td bgcolor='$bgcolor'><input type='hidden' name='estpag[]' id='estpag-$cont' value='$estadopago'>";
					$html.= $valor;
					$html.=" $estadopago</td>";
					 $html.= "<td><input type='hidden' name='medico[]'  value='$idmedico'>$medico</td>";
					 if($estadopago!="Pagado" || $idpago==0 ){
						 $html.= "<td><button name='del' id='del-$cont' class='btn btn-danger fa fa-trash'></button></td>";
					 }
					  $html.= "<td><button name='act' id='act-$cont' class='btn btn-success fa fa-pencil'></button></td>";
					$html.= "</tr>";
					 endforeach;
echo $html;
?>
