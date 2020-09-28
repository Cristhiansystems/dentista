<?php
ob_start();

$nombre=$_POST["nom"];
$apellido_paterno=$_POST["apep"];
$apellido_materno=$_POST["apem"];
$apellido_materno= ltrim($apellido_materno);
$ci=$_POST["ci"];
$extension=$_POST["ext"];
$fecha_nacimiento=$_POST["fnac"];
$celular=$_POST["cel"];
$codigo_paciente=$_POST["codpac"];
$antecedente_patologico=$_POST["antpat"];
$correo_electronico=$_POST['corele'];
$fecha_primera_visita=$_POST['fprimvis'];
$id_medico=$_POST['med'];
$id_aseguradora=$_POST['aseg'];
$estado="activo";
//$registro=date("Y-m-d");

try{ 
require("../conexion.php");
// verificacion de foto


	//verificacion de CI duplicada
	
		$sql3="select * from tbl_empleados where ci=:ci";
		$resultado3=$base->prepare($sql3);
		$resultado3->execute(array(":ci"=>$ci));
		echo $resultado3->rowCount();
		
		if($resultado3->rowCount()>0){
		
		header("Location:registroFMR.php?errorci");
		
		}
		 else{
		//	move_uploaded_file($fotdir,$ruta);
			$sql="insert into tbl_pacientes(codigo_paciente,nombre, apellido_paterno, apellido_materno, ci,extension,fecha_nacimiento, celular,  antecedente_patologico, email, fecha_primera_visita,estado, id_medico, id_aseguradora ) 
			values( :codp,:nom, :apep,trim(:apem),:ci,:ext,:fnac, :cel, :antp, :ema, :fechpv, :est, :idme,:idas)";
			$resultado=$base->prepare($sql);
		
			if($resultado->execute(array(
				 "codp"=>$codigo_paciente,
				":nom"=>$nombre, 
				":apep"=>$apellido_paterno,
			    ":apem"=>$apellido_materno, 
			    ":ci"=>$ci,
			    ":ext"=>$extension,
			    "fnac"=>$fecha_nacimiento,
			    ":cel"=>$celular,
			    ":antp"=>$antecedente_patologico,
			    ":ema"=>$correo_electronico,
			    ":fechpv"=>$fecha_primera_visita,
			    ":est"=>$estado,
			    ":idme"=>$id_medico,
			    ":idas"=>$id_aseguradora 
			    

			    )))
			{
					
			
			header("Location:paciente.php?mensaje");
			echo $rude;
			}else {
				
				header("Location:registroFMR.php?mensaje2");
				
				}
			$resultado->closeCursor();
			}
		}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	//header("Location:registroFMR.php?mensaje3");
	
	}
?>