<?php
// Copyright (c) 2018, Altiria TIC SL
// All rights reserved.
// El uso de este código de ejemplo es solamente para mostrar el uso de la pasarela de envío de SMS de Altiria
// Para un uso personalizado del código, es necesario consultar la API de especificaciones técnicas, donde también podrás encontrar
// más ejemplos de programación en otros lenguajes y otros protocolos (http, REST, web services)
// https://www.altiria.com/api-envio-sms/

// XX, YY y ZZ se corresponden con los valores de identificacion del
// usuario en el sistema.


include('httpPHPAltiria.php');
include('../conexion.php');
$id_cita=$_POST['idcita'];
$tipo=$_POST['tipo'];

$valores = $base->query("SELECT DATE_FORMAT( ct.fecha,  '%d-%m-%Y' )  as fecha,time_format(ct.hora_inicio, '%H:%i') as hora_inicio , pac.celular, tbl_medicos.celular as celular_med,tbl_medicos.alias,tbl_medicos.apellido_paterno FROM tbl_citas ct inner join tbl_pacientes pac on ct.id_paciente=pac.id_paciente inner join (select alias, apellido_paterno, id_empleado,celular from tbl_empleados where tipo_empleado='Medico') as tbl_medicos on ct.id_empleado=tbl_medicos.id_empleado
WHERE ct.id_cita='$id_cita'");

$valores2 = $valores->fetch();
$fecha_cita=$valores2['fecha'];
$hora_cita=$valores2['hora_inicio'];
$celular= $valores2['celular'];
/*echo ("DENT ALL le recuerda al ". $celular ." que tiene una cita manana ". $fecha_cita." a las ".$hora_cita .". En el siguiente enlace puede confirmar/anular cita. Gracias y le esperamos")*/






$altiriaSMS = new AltiriaSMS();
$altiriaSMS->setUrl("http://www.altiria.net/api/http");
// domainId solo es necesario si el login no es un email
//$altiriaSMS->setDomainId('cris102_le@hotmail.com');
$altiriaSMS->setLogin('cris102_le@hotmail.com');
$altiriaSMS->setPassword('qyp7rany');

$altiriaSMS->setDebug(true);

//$sDestination = '346xxxxxxxx';
if($tipo=="Paciente"){
 echo("Paciente");
	/*$sDestination ="591".$celular;
//$sDestination = array('346xxxxxxxx','346yyyyyyyy');

//No es posible utilizar el remitente en América pero sí en España y Europa
$response = $altiriaSMS->sendSMS($sDestination, "Le recuerda que tiene una cita manana ". $fecha_cita." a las ".$hora_cita .". En el siguiente enlace puede confirmar/anular cita. Gracias y le esperamos. http://www.agenda.com");
//Utilizar esta llamada solo si se cuenta con un remitente autorizado por Altiria
//$response = $altiriaSMS->sendSMS($sDestination, "Mensaje de prueba", "remitente");

if (!$response)

  echo "El envío ha terminado en error";
else
  echo "con exito se envio el mensaje";*/
$sql=$base->prepare("UPDATE tbl_citas set estado='Pendiente' where id_cita='$id_cita'");
$sql->execute();

echo $id_cita;

}
else if($tipo="Medico"){

//echo ('Medico');
}

?>

