<?php
include('../conexion.php');

$dato = $_POST['dato'];
$registro = $base->query("SELECT concat(nombre,' ',apellido_paterno,' ',apellido_materno) as medico ,celular,id_empleado FROM tbl_empleados where tipo_empleado='Medico' and concat_ws(' ',nombre ,apellido_paterno,apellido_materno) like '%$dato%' or  tipo_empleado='Medico' and celular LIKE '%$dato%' ORDER BY id_empleado ASC");
       echo "<table class='table table-striped table-condensed table-hover table-responsive'>
                      <tr>
                        <th width='50%'>Medicos</th> 
                       
                       <th width='50%'>Celular</th> 
                                
                        <th width='50%'>Opcion</th>

                   </tr>";
      if($registro->rowCount()>0){
       while($registro2 = $registro->fetch()){
        $codigo='"'.$registro2['id_empleado'].'"';
        $medico='"'.$registro2['medico'].'"';
         $celular='"'.$registro2['celular'].'"';
          echo "<tr>
                      <td>".$registro2['medico']."</td>
                        <td>".$registro2['celular']."</td>
                
                          
                       <td>   <a onclick='mostrarMedico(".$codigo.",".$medico.",".$celular.");'>
                        <img src='../imagenes/seleccionar.jpeg' width='25' height='25' alt='Seleccionar Medico' title='Seleccionar Medico' />

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