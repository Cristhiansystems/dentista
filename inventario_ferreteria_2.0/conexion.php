<?php
ob_start();
try{
	//$base=new PDO('mysql:host=localhost:3306; dbname=istdb_inventario', 'wilson', 'Donbosco2018@');
	
	$base=new PDO('mysql:host=localhost; dbname=inventario_ferreteria', 'root', '');
	$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$base->exec("SET CHARACTER SET UTF8");
	
	
	}

catch(Exception $e){
	die ('error' . $e->getMessage());
	echo"linea del error" . $e->getLine();
	
	}

?>