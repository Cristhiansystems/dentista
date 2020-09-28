<?php
require('../conexion.php');
$dato = $_POST['dato'];

$registro = $base->query("SELECT * FROM tbl_pacientes WHERE apellido_paterno LIKE '$dato%' ORDER BY id_paciente ASC");
     
      $num_registro=$registro->rowCount()+1;
      echo    $num_registro;
?>
