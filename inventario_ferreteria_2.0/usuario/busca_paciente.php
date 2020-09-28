<?php
include('../conexion.php');

$dato = $_POST['dato'];
$registro = $base->query("SELECT concat_ws(' ',nombre,apellido_paterno,apellido_materno) as empleado,ci,foto,id_empleado FROM tbl_empleados where concat_ws(' ', nombre ,apellido_paterno,apellido_materno) LIKE '%$dato%' ORDER BY id_empleado ASC");
       echo "<table class='table table-striped table-condensed table-hover table-responsive'>
                      <tr>
                        <th width='50%'>Empleado</th> 
                       
                       <th width='50%'>Ci</th> 
                       <th width='50%'>Foto</th> 
                                
                        <th width='50%'>Opcion</th>

                   </tr>";
      if($registro->rowCount()>0){
       while($registro2 = $registro->fetch()){
        $codigo='"'.$registro2['id_empleado'].'"';
        $empleado='"'.$registro2['empleado'].'"';
         // print($registro2['foto']);
          echo "<tr>
                      <td>".$registro2['empleado']."</td>
                      <td>".$registro2['ci']."</td>
                      <td><img src='../empleado/".$registro2['foto']."' alt='foto' width='80' height='80'/></td>
                      
                  

                          
                       <td>   <a onclick='mostrarEmpleado(".$codigo.",".$empleado.");'>
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