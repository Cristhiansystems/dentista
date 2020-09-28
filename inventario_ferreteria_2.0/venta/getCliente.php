<?php

	ob_start();
	require ('../conexion.php');
	$ci = $_POST['ci'];
	$registros2=$base->query("SELECT * FROM cliente where ci='$ci' and estado='activo'")->fetchAll(PDO::FETCH_OBJ);
	$html="";
	
	if(count($registros2)>0){
		
		$nombre=$registros2[0]->nombre;
		$apellido=$registros2[0]->apellido_paterno;
		$apellidom=$registros2[0]->apellido_materno;
		$id=$registros2[0]->id_cliente;
		$html="$id-Cliente: " .$apellido . " " .$apellidom  . " " .$nombre;
		
		}
		

	echo $html;
?>