<?php

	ob_start();
	require ('../conexion.php');
	$cod = $_POST['cod'];
	$id = $_POST['id'];
	$nom = $_POST['nom'];
	$tipo = $_POST['tipo'];
	if($tipo=="codigo"){
		$registros2=$base->query("SELECT * FROM tratamiento where codigo='$cod' and id_tratamiento<>$id")->fetchAll(PDO::FETCH_OBJ);
	}else if($tipo=="nombre"){
		$registros2=$base->query("SELECT * FROM tratamiento where nombre='$nom' and id_tratamiento<>$id")->fetchAll(PDO::FETCH_OBJ);
	}
	
	$html="";
	
	if(count($registros2)>0){
		
		$nombre=$registros2[0]->nombre;
		$codigo=$registros2[0]->codigo;
		$html="El codigo o el nombre introducido ya existe: $nombre ($codigo)";
		
		}
		

	echo $html;
?>