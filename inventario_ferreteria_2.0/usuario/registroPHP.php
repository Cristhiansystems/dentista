<?php
ob_start();

$id_agencia=$_POST["agen"];
$id_empleado=$_POST["idemp"];
$bool_mant;
$bool_grup_dent;
$bool_cit;
$bool_caja;
$bool_proc_dent;
$bool_consul;
$bool_segur;

if (isset($_POST["mantenimiento"])) {
   $bool_mant=true;
} else {
   $bool_mant=false;
}
if (isset($_POST["grupodental"])) {
   $bool_grup_dent=true;
} else {
   $bool_grup_dent=false;
}
if (isset($_POST["citas"])) {
   $bool_cit=true;
} else {
   $bool_cit=false;
}
if (isset($_POST["caja"])) {
   $bool_caja=true;
} else {
   $bool_caja=false;
}
if (isset($_POST["procesosd"])) {
   $bool_proc_dent=true;
} else {
   $bool_proc_dent=false;
}
if (isset($_POST["consultasp"])) {
   $bool_consul=true;
} else {
   $bool_consul=false;
}
if (isset($_POST["copiaseg"])) {
   $bool_segur=true;
} else {
   $bool_segur=false;
}

$tipo_usuario=$_POST["tipousu"];
	
$estado="activo";
$registro=date("Y-m-d");

try{ 
require("../conexion.php");
// verificacion de foto


	//verificacion de CI duplicada
	
		
			
			$sql="insert into tbl_usuarios(tipo_usuario, registro,menu_mantenimiento,menu_grupo_dental, menu_citas,menu_caja,menu_procesos_dentales,menu_consultas,menu_seguridad,id_agencia,id_empleado,estado) values(:tip, :reg, :menman, :mengr, :mencit, :mencaj, :menpro, :mencon,:menseg,:idage,:idemp,:est)";
			$resultado=$base->prepare($sql);
			if($resultado->execute(array(":tip"=>$tipo_usuario, ":reg"=>$registro, ":menman"=>$bool_mant, ":mengr"=>$bool_grup_dent, ":mencit"=>$bool_cit, ":mencaj"=>$bool_caja, ":menpro"=>$bool_proc_dent, ":mencon"=>$bool_consul, ":menseg"=>$bool_segur,":idage"=>$id_agencia,":idemp"=>$id_empleado,":est"=>$estado))){
			header("Location:usuario.php?mensaje");
			}else {
	
			header("Location:registroFMR.php?mensaje2");
	
			}
			$resultado->closeCursor();
		

}

catch(Exception $e){
	
	echo "linea del error " . $e->getLine();
	echo "error " . $e->getMessage();
	//header("Location:registroFMR.php?mensaje3");
	
	}
?>