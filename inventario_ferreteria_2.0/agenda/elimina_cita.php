<?php
include('../conexion.php');

$id = $_POST['id'];
$estado='Anulado';
$query=$base->prepare("UPDATE tbl_citas set estado=:est WHERE id_cita = '$id'");
$query->execute([	
					':est'=>$estado,
					]);
?>