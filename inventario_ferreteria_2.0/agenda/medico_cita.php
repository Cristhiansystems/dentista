<?php
include('../conexion.php');

$id_medico = $_POST['id_medico'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$html='';
$registro = $base->prepare("SELECT * FROM tbl_citas WHERE  fecha=:fec and hora_inicio=:hor  and id_medico=:idmed and estado!='anulado' ");

$registro->execute(['idmed' => $id_medico,'fec'=>$fecha,'hor'=>$hora]); 

  if ($registro->fetch()){
    echo $html.="<div class='alert alert-danger' role='alert'>
            Ya tiene registrado al médico en una cita. 
        </div>";
  }else{

    echo "";
  }

 

      
?>