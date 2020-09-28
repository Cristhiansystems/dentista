<?php

	ob_start();
	require ('../conexion.php');
	$cod = $_POST['cod'];
	$nom = $_POST['nom'];
	$registros2=$base->query("SELECT * FROM tratamiento where codigo='$cod' or nombre='$nom'")->fetchAll(PDO::FETCH_OBJ);
	$html="";
	
	if(count($registros2)>0){
		
		$nombre=$registros2[0]->nombre;
		$codigo=$registros2[0]->codigo;
		$html="El codigo o el nombre introducido ya existe: $nombre ($codigo)";
		
		}
		

	echo $html;
?>