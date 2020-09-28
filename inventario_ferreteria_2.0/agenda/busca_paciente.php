<?php
include('../conexion.php');

$dato = $_POST['dato'];
$registro = $base->query("SELECT concat(nombre,' ',apellido_paterno,' ',apellido_materno) as paciente ,celular,id_paciente FROM tbl_pacientes where concat(nombre ,' ',apellido_paterno) LIKE '%$dato%' ORDER BY id_paciente ASC");
       echo "<table class='table table-striped table-condensed table-hover table-responsive'>
                      <tr>
                        <th width='50%'>Pacientes</th> 
                       
                       <th width='50%'>Celular</th> 
                                
                        <th width='50%'>Opcion</th>

                   </tr>";
      if($registro->rowCount()>0){
       while($registro2 = $registro->fetch()){
        $codigo='"'.$registro2['id_paciente'].'"';
        $paciente='"'.$registro2['paciente'].'"';
         $celular='"'.$registro2['celular'].'"';
          echo "<tr>
                      <td>".$registro2['paciente']."</td>
                        <td>".$registro2['celular']."</td>
                
                          
                       <td>   <a onclick='mostrarPaciente(".$codigo.",".$paciente.",".$celular.");'>
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