<?php 
/*try{*/
	ob_start();
include("conexion.php");
	$SQL="select * from tbl_empleados where login= :login and clave= :contra and estado= :est";
	$resultado=$base->prepare($SQL);
	$login=$_POST["usuario"];
	$contra=$_POST["password"];
	$estado="activo";
	$contador=0;
	$co=0;
	$resultado->execute(array(":login"=>$login, ":contra"=>$contra, ":est"=>$estado));

	$co=$resultado->rowCount();
	if($co>0){
	
		
			$contador++;}
	
if ($contador>0)

	{	
	//ini_set('session.save_path',realpath($_SERVER['DOCUMENT_ROOT']).'/inventario_ferreteria/sessiones');
	session_start();
	//$_SESSION["id"]="17";
	
	//$_SESSION["paciente"]="Paciente";
	$sql=$base->query("select * FROM tbl_empleados where login='$login'")->fetch(PDO::FETCH_ASSOC);
	$_SESSION["id"]= $sql['id_empleado'];
	
			
				
			header("location:lista_agencias.php");

	}
	
		else { header("Location:index.php?error");
	}
		
		$resultado->closeCursor();
	
	
	
	
	//}
	/*catch(Exception $e){
		
		die("error:  "  . $e->getMessage());
		}*/
?>