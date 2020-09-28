<?php
ob_start();
$ci=$_POST["ci"];
$ext=$_POST["ext"];
$nombre=$_POST["nom"];
$apellido_paterno=$_POST["apep"];
$apellido_materno=$_POST["apem"];
$celular=$_POST["cel"];
$grupo_sanguineo=$_POST["sang"];
$fecha_nacimiento=$_POST["fnac"];
$direccion=$_POST["dir"];
$login=$_POST["log"];
$clave=$_POST["clav"];
//$nombre_img = $_FILES['fot']['name'];
//$tipo = $_FILES['fot']['type'];
//$tamano = $_FILES['fot']['size'];
//$fotdir=$_FILES['fot']['tmp_name'];
//$ruta="imagenes";
//$ruta=$ruta."/".$nombre_img;
//$foto=$_POST["fot"];
$tipo_empleado=$_POST["temp"];
$alias=$_POST["ali"];
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

		 	 $imgFile = $_FILES['fot']['name'];
    $tmp_dir = $_FILES['fot']['tmp_name'];
    $imgSize = $_FILES['fot']['size'];
           
    if($imgFile)
    {
      $upload_dir = 'imagenes/'; // upload directory 
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
      $userpic = rand(1000,1000000).".".$imgExt;
      if(in_array($imgExt, $valid_extensions))
      {     
        if($imgSize < 1000000)
        {
          unlink($foto_ruta);
          move_uploaded_file($tmp_dir, $upload_dir. $userpic);
        }
        else
        {
          $errMSG = "El archivo no puede superar 1MB";
        }
      }
      else
      {
        $errMSG = "Solo archivos JPG, JPEG, PNG & GIF .";    
      } 
    }
    else
    {
      // if no image selected the old image remain as it is.
      $userpic = $foto_ruta; // old image from database
    } 
         
	
 if(!isset($errMSG))
    {

move_uploaded_file($fotdir,$ruta);
			$sql="insert into tbl_empleados(nombre, apellido_paterno, apellido_materno, alias, fecha_nacimiento, ci,extension,  direccion, foto, celular,grupo_sanguineo, tipo_empleado, login,clave,estado ) values( :nom, :apep, :apem, :ali, :fnac, :ci,:ext, :dir, :fot, :cel,:sang, :temp, :log, :clav, :est)";
			$resultado=$base->prepare($sql);
		
			if($resultado->execute(array(
				 
				":nom"=>$nombre, 
				":apep"=>$apellido_paterno,
			    ":apem"=>$apellido_materno, 
			    "ali"=>$alias,
			    "fnac"=>$fecha_nacimiento,
			    ":ci"=>$ci,
			    ":ext"=>$ext,
			    ":dir"=>$direccion,
			    ":fot"=>$upload_dir.$userpic,
			    ":cel"=>$celular,
			    ":sang"=>$grupo_sanguineo,
			    ":temp"=>$tipo_empleado, 
			    ":log"=>$login,
			    ":clav"=>$clave,
			    ":est"=>$estado,

			    )))
			{
					
			
			header("Location:empleado.php?mensaje");
			echo $rude;
			}else {
				
				header("Location:registroFMR.php?mensaje2");
				
				}
			$resultado->closeCursor();
		}else{

				header("Location:registroFMR.php?errorci");
		}




		}
	}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	//header("Location:registroFMR.php?mensaje3");
	
	}
?>