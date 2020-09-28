<?php

require ('../conexion.php');
  
  $registros2=$base->query("SELECT id_agencia,nombre FROM tbl_agencias ")->fetchAll(PDO::FETCH_OBJ);
  
  
  echo json_encode($registros2);

?>
