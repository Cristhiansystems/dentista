<?php
include('../conexion.php');
	$piso = $_POST['piso'];
$fecha =strtotime($_POST['fecha']);
$nueva_fecha=date('Y-m-d',$fecha);
  	$registro =$conexion->query("SELECT * FROM tbl_notas where piso='". $piso ."' and fecha='".$nueva_fecha ."'" );
   


  echo "<table  class='table table-sm table-bordered table-responsive'>
			                
                      <tr >
                        <th width='50%'>Descripcion</th> 
                         
                                  
                        <th width='10%'>Opciones</th>

                   </tr>
                   ";	

          	while($registro2 = $registro->fetch()){
              $codigo='"'.$registro2['id_nota'].'"';
  echo "<tr>
                      <td>".$registro2['descripcion']."</td>
                       
                         
                       <td> <a onclick='editarNota(".$codigo.");'>
                        <img src='../imagenes/editar.png' width='25' height='25' alt='editar' title='Editar' />

                       </a>
                          <a href='javascript:eliminarNota(".$codigo.");'>
                          <img src='../imagenes/borrar.png' width='25' height='25' alt='delete' title='Eliminar' /></a>
                          </td>
                </tr>";	
	}
        
  echo "</table>";
   
?>