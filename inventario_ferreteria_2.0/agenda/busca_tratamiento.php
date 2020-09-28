<?php
include('../conexion.php');

$dato = $_POST['dato'];
$registro = $conexion->query("SELECT concat(nombre,'',primer_apellido) as paciente FROM tbl_tratamientos where concat(nombre +' '+apellido_paterno) LIKE '%$dato%' ORDER BY id_paciente ASC");
       echo "  <br> 
                   <br><table class='table table-striped table-condensed table-hover table-responsive'>
                      <tr>
                        <th width='50%'>Pacientes</th> 
                       
                        
                                
                        <th width='50%'>Opcion</th>

                   </tr>";
      if($registro->rowCount()>0){
	     while($registro2 = $registro->fetch()){
        $codigo='"'.$registro2['id_paciente'].'"';
        $paciente='"'.$registro2['paciente'].'"';
       
		      echo "<tr>
                      <td>".$registro2['paciente']."</td>
                      
                
                          
                       <td>   <a onclick='mostrar_paciente(".$codigo.",".$paciente.");'>
                        <img src='../imagenes/seleccionar.jpeg' width='25' height='25' alt='Seleccionar Paciente' title='Seleccionar Paciente' />

                       </a>
                          </td>
                </tr>";
      	}
      }else{
      	echo '<tr>
      				<td colspan="10">No se encontraron resultados</td>
      			</tr>';
      }
      echo '</table>';
?>