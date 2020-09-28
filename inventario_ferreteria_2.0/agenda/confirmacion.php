


<?php
	include('../conexion.php');
$id_cita=$_GET["id"];
//$tipo=$_POST['tipo'];
$español=$base->prepare("SET lc_time_names = 'es_ES'");
$español->execute();


$valores = $base->query("  
	SELECT   concat_ws(' ',DATE_FORMAT(ct.fecha, '%W, %e de %M de %Y'),'a las',time_format(ct.hora_inicio, '%H:%i')) as datos FROM tbl_citas ct 
WHERE ct.id_cita='$id_cita'");
$valores2 = $valores->fetch();
$fecha_hora_cita=$valores2['datos'];
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<title>Confirmacion de Cita</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">

<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
    		
    		function ConfirmarCita(id){
    				var url = 'confirmar_cita.php';
					$.ajax({
					type:'POST',
					url:url,
					data:'idcita='+id,
					success: function(datos){
						$("#datos_cita").html(datos);
					},
					})


    			//alert("confirmado");
    		}
    		function CancelarCita(id){
    			var url = 'cancelar_cita.php';
					$.ajax({
					type:'POST',
					url:url,
					data:'idcita='+id,
					success: function(datos){
						$("#datos_cita").html(datos);
					},
					})
    		}


    </script>
</head>

<body >
	<div class="container" style="max-width: 450px">
  <h2 class="text-center">Clinica Dental All</h2>
  <h5 class="text-center">CONFIRMAR CITA</h3>
  <div class="panel-group">
   

    <div class="panel panel-primary">
      <div class="panel-heading text-center">Indique si puede asistir o no a la cita</div>
      <div class="panel-body">
      	<div id="datos_cita">
      	<p class="text-center">Datos de la Cita:</p>
      	<span style="font-weight:bold;"><p class="text-center"><?php echo $fecha_hora_cita; ?> </p></span>
      	
      	<div class="row justify-content-center">
      		 <div class="col-xs-6 col-sm-6 col-md-6 col-md-offset-1">
                <div class="form-group">
      	<img src="../imagenes/confirmado.png" class="img-responsive"  alt="Confirmar Cita" width="120" height="120">
      	<a href="#" onclick="ConfirmarCita(<?php echo $id_cita; ?>);">Si asistire  a la cita</a>
      	</div>
      </div>
      	 <div class="col-xs-5 col-sm-5 col-md-5">
                <div class="form-group">
      	<img src="../imagenes/cancelado.png" class="img-responsive"  alt="Confirmar Cita" width="125" height="120">
      	<a href="#" onclick="CancelarCita(<?php echo $id_cita; ?>);">No puedo asistir a la cita</a>
      	</div>
      
      </div>
      </div>
      </div>
	

    </div>

    
  </div>

	
</div>



     
</body>

</html>