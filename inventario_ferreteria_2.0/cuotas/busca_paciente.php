<?php
include('../conexion.php');

$dato = $_POST['dato'];
$registro = $base->query("SELECT codigo_paciente, concat(tbl_pacientes.nombre,' ',apellido_paterno,' ',apellido_materno) as paciente ,ci,id_paciente, case when tbl_aseguradoras.nombre is null then 'Particular' when tbl_aseguradoras.nombre!='' then tbl_aseguradoras.nombre end as seguro_medico  FROM tbl_pacientes left join tbl_aseguradoras on tbl_pacientes.id_aseguradora=tbl_aseguradoras.id_aseguradora  where concat_ws(' ', tbl_pacientes.nombre ,apellido_paterno,apellido_materno) LIKE '%$dato%' or codigo_paciente LIKE '%$dato%' or ci LIKE '%$dato%' ORDER BY id_paciente ASC");
       echo "<table class='table table-striped table-condensed table-hover table-responsive'>
                      <tr>
                      <th >Codigo Paciente</th> 
                        <th>Paciente</th> 
                       
                       <th >Ci</th> 
                        <th >Seguro Médico</th>      
                        <th >Opcion</th>

                   </tr>";
      if($registro->rowCount()>0){
       while($registro2 = $registro->fetch()){
        $codigo='"'.$registro2['id_paciente'].'"';
        $paciente='"'.$registro2['paciente'].'"';
        $seguro='"'.$registro2['seguro_medico'].'"';
          echo "<tr>
           <td>".$registro2['codigo_paciente']."</td>
                      <td>".$registro2['paciente']."</td>
                        <td>".$registro2['ci']."</td>
                <td>".$registro2['seguro_medico']."</td>
                          
                       <td>   <a onclick='mostrarPaciente(".$codigo.",".$paciente.",".$seguro.");'>
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