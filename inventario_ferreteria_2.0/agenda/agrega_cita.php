
<?php
include("../conexion.php");
//echo"<script> alert('hola'); </script>";

$proceso= $_POST['ProCita'];





$fecha=$_POST["Fecha"];
$hora_inicio= $_POST["TiempoInicio"];
$hora_fin= $_POST["TiempoFin"];
$estado=$_POST["Estado"];
$id_paciente=$_POST["idpac"];
$id_empleado=$_POST["asist"];
$id_medico=$_POST["idmed"];
$id_sucursal= $_POST['idcons'];

			



			switch ($proceso) {
				case 'Registro':
							$sql = $base->prepare("INSERT INTO tbl_citas(Fecha,hora_inicio,hora_fin,estado,id_paciente,id_empleado,id_medico,id_sucursal) values (:fech, :hori, :horf, :est, :idpac, :idemp, :idmed, :idsuc)");

				$sql->execute([
					
					':fech'=>$fecha,
					':hori'=>$hora_inicio,
					':horf'=>$hora_fin,
					':est'=>$estado,
					':idpac'=>$id_paciente,
					':idemp'=>$id_empleado,
					':idmed'=>$id_medico,
					':idsuc'=>$id_sucursal,
					
				]);
		
					break;

			case 'Edicion':
					$id_cita= $_POST['idcita'];
					$sql = $base->prepare("UPDATE tbl_citas SET fecha=:fech, hora_inicio=:hori, hora_fin=:horf, estado=:est,id_paciente=:idpac, id_empleado=:idemp, id_medico=:idmed where id_cita='$id_cita'");

				$sql->execute([
					
						':fech'=>$fecha,
					':hori'=>$hora_inicio,
					':horf'=>$hora_fin,
					':est'=>$estado,
					':idpac'=>$id_paciente,
					':idemp'=>$id_empleado,
					':idmed'=>$id_medico,
				
				]);
		
								break;
							
						}

			



?>