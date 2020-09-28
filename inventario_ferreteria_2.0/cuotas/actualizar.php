<?php 
ob_start();
/*ini_set('session.save_path',realpath($_SERVER['DOCUMENT_ROOT']).'/donboscoCea/sessiones');
session_start();
if(!isset($_SESSION["usuario"])){
	
	header("location:../index.php");
	}*/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Actualizar cuenta</title>
<script src="../js/jQuery-2.1.4.min.js"></script>
    <script>


$(document).ready(function(){





		seg=$("#seg").val();
		seguro=$("#seguro").val();
		
			if(seg=="si"){
				$("#divseg").show();
				$("#alertseg").html("Paciente asegurado" +" - "+ seguro);
			}else{
						$("#divseg").hide();
						$("#alertseg").html("Paciente particular");
				}
	getDetalle();
	getCuotas();

	function getDetalle(){
		id=$("#id").val();
		$.post("getDetalle.php", {id: id }, function(data){
			
								$("#tabla tbody").html(data);
								obtenerPago();					
							});
	}


	function getCuotas(){
		id=$("#id").val();
	
		$.post("getCuotas.php", {id: id }, function(data){
			
								$("#tablacuotas").html(data);

								//obtenerPago();
								sumarMontoCuotas();	


							});
	}
	//sumarMontoCuotas();


	
	
	
	$("#pieza").on("keyup", function() {
			
    			pieza=$("#pieza").val();
				
				$.post("getPieza.php", {pieza: pieza }, function(data){
											console.log(data);
									if(data['id_pieza']!==""){

									$("#id_pieza").val(data['id_pieza']);
									$("#piezanom").html(data['pieza']);
										
									
									}else{
									$("#id_pieza").val("");
									$("#piezanom").html("");
								
									}
									
								
							});
					
				});

	$("#monto").on("keyup", function() {
		
    			saldo_pendiente=$("#costototal").val();
    			monto_pagar=$("#monto").val();
    			

    			if(monto_pagar==0){
    				$("#saldototal").val("");
    			}else{
				saldo_total=parseFloat(saldo_pendiente)-parseFloat(monto_pagar);
			
				$("#saldototal").val(saldo_total);
			}
			
					
				});



	
	
		$("#tra").on("keyup", function() {
    			tra=$("#tra").val();

				$.post("getTratamiento.php", {tra: tra }, function(data){
						
									if(data['codtra']!==""){

									$("#codtra").val(data['codtra']);
									$("#tranom").html(data['tratamiento']);
									$("#precio").val(data['precio']);
									$("#nomtra").val(data['nombre']);
									$("#segtra").val(data['seg']);
										segtra=$("#segtra").val();
										seg=$("#seg").val();
										opcion="";
										if(segtra=="Si" && seg=="si"){
											opcion="<option val='Seguro'>Seguro</option>";
											$("#pag").html(opcion);
										}else{
											opcion+="<option value='Debe'>Debe</option>";
                							opcion+="<option value='Pagado'>Pagado</option>";
                							opcion+="<option value='Seguro'>Seguro</option>";
                							opcion+="<option value='Control'>Control</option>";
											$("#pag").html(opcion);
										}
									
									}else{
									$("#codtra").val("");
									$("#tranom").html("");
									$("#precio").val("");
									$("#nomtra").val("");
									$("#segtra").val("");
										$("#pag").html("");
								
									}
									
								
							});
					
				});

		function pagar_cuota(id_cuota){
			$("#idcuota").val(id_cuota);
			pagado=$("#pagado").val();
			saldo=$("#saldo").val();
			$("#montopagado").val(pagado);
			$("#costototal").val(saldo);
			
			$("#modalcuotas").modal("show");
			return false;
		}

		function ver_cuota(id_pago){
			window.open('boleta_cuota.php?id='+id_pago);
		}
	
	
	function controlarClick() {

	$("button[name='ver']").off('click');
    $("button[name='ver']").on('click', function(event){
    	ver_cuota($(this).attr("data-vercuo"));
     	//alert ();
	   return false;
	});


	$("button[name='cuo']").off('click');
    $("button[name='cuo']").on('click', function(event){
    	pagar_cuota($(this).attr("data-cuota"));
     
	   return false;
	});
		
	  $("button[name='del']").off('click');
    $("button[name='del']").on('click', function(event){
       borrarcurso(event);
	   return false;
	});


		
	  $("button[name='act']").off('click');
    $("button[name='act']").on('click', function(event){
       actualizardetalle(event);
	   return false;
	});
	
	 $("input[name='reacheck[]']").off('click');
	$("input[name='reacheck[]']").on('click', function(event){
       cambiarEstado(event);
	   //return false;
	});
		
		 $("input[name='pg[]']").off('click');
	$("input[name='pg[]']").on('click', function(event){
       cambiarCobro(event);
	   //return false;
	});
		
	}
	
	$("#pag").change(function(){
		estadoPago=$("#pag").val();
		if(estadoPago=="Control"){
			$("#infControl").html("Al ser un control tendra un costo de 0 Bs.");
		}else{
				$("#infControl").html("");
		}
	});
	

		function cambiarEstado(event){
				subventa=event.target.id;
				sv=subventa.split("-");
				a_pretotal=sv[1];
				td=$("#"+ subventa).parent('td');
				if( $("#reacheck-"+a_pretotal).is(':checked') ) {
						$("#realizado-" + a_pretotal).val("si");
						td.attr("bgcolor", "#82e0aa"); 
			
						}else{
							$("#realizado-" + a_pretotal).val("no");
							td.attr("bgcolor", "#f5b7b1");
						}

		}
	
			function sumarMontoCuotas(){
				 var sum = 0;

   						 $(".montocuo").each(function(){
        				sum += parseFloat( $( this ).text() );
    							});
   						  saldop=parseFloat( $("#pagar").val())-parseFloat(sum);
   						 $("#pagado").val(sum);

   						 $("#saldo").val(saldop);
   						 controlarClick();
   						// alert(sum);
			}

		function cambiarCobro(event){
				subventa=event.target.id;
				sv=subventa.split("-");
				a_pretotal=sv[1];
				td=$("#estpag-"+ a_pretotal).parent('td');
				if( $("#"+subventa).is(':checked') ) {
						
						td.attr("bgcolor", "#abebc6"); 
						$("#estpag-"+ a_pretotal).val("Pagado");
					//	alert("Pafo 2");
						}else{
								
							td.attr("bgcolor", "#f7dc6f");
							$("#estpag-"+ a_pretotal).val("Debe");
							//	alert("Pafo 2");
						}

				obtenerPago();
		}

	cont=0;
	$("#anadir").click(function(){
			$("#pieza").val("");	
			$("#tra").val("");	
			$("#codtra").val("");
			$("#nomtra").val("");
			$("#tranom").html("");
			$("#precio").val("");
			$("#piezanom").html("");
			$("#id_pieza").val("");
			$("#fec").val("");
			$("#med").val("");
			$("#fmrenviar").modal("show");
			$("#modificar").hide();
			$("#enviar").show();
		$("#tra").removeAttr('disabled');
			return false;
					
			});



	$("#registrarcuota").click(function(){
			id=$("#id").val();
			/*saldo_pendiente=$("#costototal").val();
    			monto_pagar=$("#monto").val();
				saldo_total=parseFloat(saldo_pendiente)-parseFloat(monto_pagar);*/
			
			//$("#saldototal").val();
			id_cuo=$("#idcuota").val();
			
			id_usu=$("#idagencia").val();
			id_medicopago=$("#medpago").val();
			sal_pend= $("#saldototal").val();
			monto_cuota=$("#monto").val();
			monto_pagado=$("#montopagado").val();
			
			//alert(id_medicopago);


			
			if (monto_pagado=="" ){
				alert("Debe llenar el campo Monto");
			}else{
				
				
				$.post("actCuota.php", {id: id, idcuo:id_cuo, idusu:id_usu, saldop:sal_pend, montop:monto_pagado, montoc:monto_cuota, idmed:id_medicopago,}, function(data){
								$("#modalcuotas").modal("hide");
								window.open('boleta_cuota.php?id='+data);
								getCuotas();
								//console.log(data);
								//$("#fmrenviar").modal("hide");
																//getDetalle();
			

							});
				
			}
		
		
	});
	
	$("#enviar").click(function(){
			id=$("#id").val();
			pretototal= $("#pretotal").val();
			cont=cont + 1;
			id_tratamiento = $("#codtra").val();
			tratamiento = $("#nomtra").val();
			precio = $("#precio").val();
			pieza = $("#piezanom").val();
			id_pieza = $("#id_pieza").val();
			fecha=$("#fec").val();
			doctor=$("#med option:selected").text();
			id_doctor=$("#med option:selected").val();
			pago=$("#pag option:selected").val();
			if (id_tratamiento=="" || fecha =="" || id_doctor ==""){
				alert("Debe llenar los campos tratamiento, fecha y doctor");
			}else{
				
				
				$.post("regDetalle.php", {id: id, id_pieza:id_pieza, id_tratamiento:id_tratamiento, precio:precio, fecha:fecha, id_doctor:id_doctor, pago:pago, }, function(data){
								console.log(data);
								$("#fmrenviar").modal("hide");
								getDetalle();
										
							});
				
			}
		
		
	});
	
	$("#descuento").change(function(){
		obtenerPago();
	})
			
	function obtenerPago(){
			pagar=0;
			seguro=0;
			total=0;
		
				
			
		$("input[name='prec[]']").each(function(){
									
										
											 subventa=$(this).attr('id');
											
											sv=subventa.split("-");
											a_pretotal=sv[1];
											 precio=$("#prec-"+a_pretotal).val()
											 total=parseFloat((total)) + parseFloat((precio));
										
				
				
			 });
		//alert("Bienvenido");
			 $("#pretotal").val(total);
				controlarClick();	
					
					 
					// 
				/*	pretototal= $("#pretotal").val();
					pretototal= parseFloat((total));
					pretototal=pretototal.toFixed(2);
					$("#pretotal").val(pretototal);
					pagado=$("#pagado").val();
					pagartotal=parseFloat(pagar) + parseFloat(pagado);
					saldo=parseFloat(pretototal) - parseFloat(pagartotal);
					saldo=parseFloat(saldo) - parseFloat(seguro);
					descuento=$("#descuento").val();
					descuento=((pagar*descuento)/100);
					pagardescuento=parseFloat(pagar) - parseFloat(descuento);
					pagardescuento= parseFloat((pagardescuento));
					pagardescuento=pagardescuento.toFixed(2);
					pagar= parseFloat((pagar));
					pagar=pagar.toFixed(2);
					seguro= parseFloat((seguro));
					seguro=seguro.toFixed(2);
					saldo= parseFloat((saldo));
					saldo=saldo.toFixed(2);*/
					
					
					//$("#pagar").val(total);
					//$("#pagado").val(seguro);
					//$("#pagardescuento").val(pagardescuento);
		//			$("#saldo").val(saldo);
					

	}
		function borrarcurso(event){
				     swal({
			  title: "¿ESTA SEGUR@ QUE DESEA ELIMINAR EL TRATAMIENTO?",
			  text:"no se podra revertir el cambio",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "SI! deseo eliminarlo",
			  cancelButtonText: "No, cancelar",
			  closeOnConfirm: false
					},
				function(){
					
 								ide_array=event.target.id
								ide_array=ide_array.split("-");
								ide=ide_array[1];
								
					




								$.post("borrarDet.php", { ide: ide}, function(data){
										console.log(data);									
									swal("SE HA ELIMINADO EL TRATAMIENTO CORRECTAMENTE", "","success");
										
										getDetalle();
								
	          
					});
 
    });
				
		
				}
	
	function actualizardetalle(event){
		
		ide_array=event.target.id
		ide_array=ide_array.split("-");
		ide=ide_array[1];
		$.post("getDet.php", { ide: ide}, function(data){
										console.log(data);
										$("#idmod").val(ide);
										$("#fmrenviar").modal("show");
										$("#modificar").show();
										$("#enviar").hide();
										$("#pieza").val(data[0].pieza);
										$("#piezanom").html(data[0].piezanom+ " N° " + data[0].pieza);
										$("#id_pieza").val(data[0].id_pieza);
										$("#precio").val(data[0].precio_unitario);
										$("#nomtra").val(data[0].tratamiento);
										$("#codtra").val(data[0].id_tratamiento);
										$("#segtra").val(data[0].seguro);
										$("#idpago").val(data[0].id_pago);
										$("#tranom").html("Tratamiento: " +  data[0].tratamiento + " Precio: (" + data[0].precio_unitario + ") Bs.");
										$("#tra").val(data[0].tratamiento);
										segtra=$("#segtra").val();
										seg=$("#seg").val();
										idpago=$("#idpago").val();
										if(segtra=="Si" && seg=="si"){
											opcion="<option val='Seguro'>Seguro</option>";
											$("#pag").html(opcion);
										}else{
											opcion="<option value='Debe'>Debe</option>";
                							opcion+="<option value='Pagado'>Pagado</option>";
                							
                							opcion+="<option value='Control'>Control</option>";
											$("#pag").html(opcion);
										}
										

										if(idpago!=0){
											opcion="<option value='Pagado'>Pagado</option>";
											$("#pag").html(opcion);
											$("#tra").attr('disabled','disabled');
										}else{
											$("#tra").removeAttr('disabled');
										}
										$("#pag").val(data[0].estado_pago);
										$("#fec").val(data[0].fecha_detalle);
										$("#med").val(data[0].id_medico);
										
	          
					});
	}

	
	$("#modificar").click(function(){
			id=$("#idmod").val();
			
			id_tratamiento = $("#codtra").val();
			tratamiento = $("#nomtra").val();
			precio = $("#precio").val();
			pieza = $("#piezanom").val();
			id_pieza = $("#id_pieza").val();
			fecha=$("#fec").val();
			doctor=$("#med option:selected").text();
			id_doctor=$("#med option:selected").val();
			pago=$("#pag option:selected").val();
			if (id_tratamiento=="" || fecha =="" || id_doctor ==""){
				alert("Debe llenar los campos tratamiento, fecha y doctor");
			}else{
				
				
				$.post("actDetalle.php", {id: id, id_pieza:id_pieza, id_tratamiento:id_tratamiento, precio:precio, fecha:fecha, id_doctor:id_doctor, pago:pago, }, function(data){
								console.log(data);
								$("#fmrenviar").modal("hide");
								getDetalle();
										
							});
				
			}
	})
	
});
	
function mensaje(){
	swal("producto2 REGISTRADO CON EXITO","", "success");
	}
	function mensaje2(){
	swal("ERROR EN EL REGISTRO","","error");
	}
	function mensaje3(){
	swal("ERROR EN EL REGISTRO","el rude del estudiante ya existe","error");
	}
	
	function errorci(){
	swal("ERROR EN EL REGISTRO","el nombre del producto ya existe","error");
	}
	
	function alerta(){
	swal("NO HAY SUFUCIENTE STOCK DE ALGUN PRODUCTO SELECCIONADO","","error");
	}
	
	
	
</script>


    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>

    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../img/favicon.ico">
<script src="../js/sweetalert.min.js"></script>
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php
include("../header.php");
include("../conexion.php");
	$id=$_GET["id"];
	$cuenta=$base->query("SELECT tbl_pacientes.nombre, apellido_paterno, apellido_materno, codigo_paciente, tbl_pacientes.id_paciente, costo, pagado, saldo, seguro, tbl_aseguradoras.nombre FROM cuenta INNER JOIN tbl_pacientes on cuenta.id_paciente=tbl_pacientes.id_paciente inner join tbl_aseguradoras on tbl_aseguradoras.id_aseguradora=tbl_pacientes.id_aseguradora where cuenta.id_cuenta='$id'")->fetchAll(PDO::FETCH_OBJ);
	$paciente=$cuenta[0]->apellido_paterno . " " . $cuenta[0]->apellido_materno . " " . $cuenta[0]->nombre;
	$codigo=$cuenta[0]->codigo_paciente;
	$id_paciente=$cuenta[0]->id_paciente;
	$costo=$cuenta[0]->costo;
	$pagado=$cuenta[0]->pagado;
	$saldo=$cuenta[0]->saldo;
	$seguro=$cuenta[0]->seguro;
	$id_aseguradora=$cuenta[0]->nombre;
	if($id_aseguradora=="Particular"){
		$seg="no";
	}else{
		$seg="si";
	}
if(!isset($_POST['enviando'])){

	}
else {
	$id=$_POST["id"];
	//parametros cuenta

$pagar=$_POST["pagar"];
$pagado=$_POST["pagado"];
$pagado=$pagado + $pagar;

$saldo=$_POST["saldo"];


//parametros detalle tratamiento
if(isset($_POST["reacheck"])){
$realizado=$_POST["reacheck"];


}







	$pg=array();

if(isset($_POST["pg"])){
	$pg=$_POST["pg"];
}

	
	if(isset($_POST["reacheck"]))
	{
	$sql="UPDATE detalle_tratamiento set realizado=:rea where id_cuenta=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":rea"=>"no", ":id"=>$id));
		for ($i=0; $i<count($realizado) ; $i++)
		{
				echo $realizado[$i];
				$sql="update detalle_tratamiento set realizado=:rea where id_detalle_tratamiento=:id";
				$resultado=$base->prepare($sql);
					$resultado->execute(array(":rea"=>"si", ":id"=>$realizado[$i]));
		}
	}
	



	
	
}
?>
  <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Cuenta por cuotas</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
   
          <h1>Actualizar cuenta por cuotas</h1>
          
          <form  name="form1" method="post" action="actualizar.php?id=<?php echo $id ?>" enctype="multipart/form-data" class="form-horizontal" role="form" >
          
          
            <div class="field-wrap">
              <input type="hidden" name="id" id="id" required value="<?php echo $id?>"/>
              <input type="hidden" name="idagencia" id="idagencia"  value="<?php echo $id_agencia?>"/>
            </div>
              <div class="row">
            
               
              
                 <div class="col-md-4">
					  <div class="form-group">
						<div class="col-md-offset-2 col-md-5">
						  <label for="ci" class="control-label">
							COD PACIENTE<span style="color:#F00">*</span>
						  </label>
					  </div>
						<div class=" col-md-offset-2 col-md-10">
					  <input type="text" name="ci" id="ci" class="form-control" value="<?php echo $codigo ?>" readonly/>
					  </div>
					</div>
                </div>
         		 <div class="col-md-4">
                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-5">
                    <label for="prec" class="control-label">
                      	PACIENTE<span style="color:#F00">*</span>
                    </label>
                    </div>
                    	<div class="col-md-offset-2 col-md-10">
                    <input type="hidden" name="id_cliente" id="id_cliente" value="<?php echo $id_paciente?>"/>
                    <input type="hidden" name="seg" id="seg" value="<?php echo $seg?>" />
                    <input type="hidden" name="seguro" id="seguro" value="<?php echo $id_aseguradora?>" />
                    <textarea name="cliente" id="cliente" class="form-control" cols="100" rows="3" readonly style="resize: both;"><?php echo $paciente?></textarea>
                    	</div>
                  </div>
                  </div>
                   
                   
                   
                   
                 <div class="col-md-offset-1 col-md-5">
					 
					<div class="alert alert-info" role="alert">
  						<p id="alertseg" style="color:#FFFFFF;"></p>
					</div>
					
				
               
         		
                   </div>
                   <hr>

                 
                  
				  <div class="col-md-offset-8 col-md-1">
				<div class="form-group">

                    <div class="col-md-10">
                <button class="btn btn-facebook" id="anadir">Agregar tratamiento +</button>
</div> 
                </div>
                <hr>
					</div>
				
                   </div>
                 
                 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Detalle de tratamiento</h3>
            </div> 
            <!-- /.box-header -->
            <div class="box-body"> 
			<div class="table-responsive">
              <table class="table table-bordered" id="tabla">

               <thead>
               	<tr>
               		<th>Pagar</th>
               		<th>N°pieza dental</th>
               		<th>Tratamiento</th>
               		<th>Costo</th>
               		<th>Fecha</th>
               		<th>Realizado</th>
               		<th>Estado</th>
               		<th>Medico</th>
               	</tr>
               </thead>
               <tbody>

				 
				  
               </tbody>
              </table>
              </div>
					 </div>
           
           
           
            <div class="box-footer clearfix">
            
              <div class="form-group">
              	<div  class="col-md-offset-6 col-md-2">
            	Total a pagar (Bs.)
            	</div>
            		<div  class="col-md-2">
            	<input type="text" readonly id="pagar" name="pagar" class="form-control" value="<?php echo $costo?>"/>  
            	</div>
            	</div>
            	
            	
            	
            	
            	<div class="form-group" >
              	<div  class="col-md-offset-6 col-md-2">
            	Pagado (Bs.)
            	</div>
            		<div  class="col-md-2">
            	  		<input type="text" readonly id="pagado" name="pagado" class="form-control" value="<?php echo $pagado?>"/> 
            	</div>
            	</div>
            	
            
            	
            	
            	  <div class="form-group">
              	<div  class="col-md-offset-6 col-md-2">
            	Saldo (Bs.)
            	</div>
            		<div  class="col-md-2">
            	  		<input type="text" readonly id="saldo" name="saldo" class="form-control" value="<?php echo $saldo?>"/> 
            	</div>
            	</div>
             
            
             
           
            </div>
            
  			<div class="box-header with-border">
              <h3 class="box-title">Lista de Cuotas</h3>
            </div>
            <div id="tablacuotas" class="col-md-5" ></div>
                  
                  

           

          	<div class="col-md-offset-3 col-md-2">
          			<a href="cuenta.php"><button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
                    </div>
        	   		<div class="col-md-2">
          			<button type="submit" name="enviando" class="btn btn-primary"/>ACTUALIZAR</button>
                    </div>
          
          </form>
              </div>
                           
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->


        </section><!-- /.content -->
        </div>
        

<?php include("../pie_de_pagina.html"); ?>
 <div class="modal fade" id="modalcuotas" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Registrar Pago Cuota</h4>
        </div>

        <div class="modal-body">

        <form  class="form" id="formulario" >
         

        <div class="row">
          
           <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                <label for="celular">Saldo Pendiente:</label>
                <input type="text" class="form-control" readonly name="costototal" id="costototal" autocomplete="off"  required >   
            </div>
           
        </div>
    	</div>
         <div class="row" id="montomedico" >
          
           <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                <label for="celular">Monto a Pagar:</label>
                <input type="text" class="form-control" name="monto" id="monto" autocomplete="off"  required >   
            </div>
        	</div>
          
						<?php $empleado=$base->query("SELECT * FROM tbl_empleados where estado='activo' and tipo_empleado='Medico'")->fetchAll(PDO::FETCH_OBJ); ?>
                           <div class="col-xs-8 col-sm-8 col-md-8">
					                   <div class="form-group">
                  	<div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="fec" class="control-label">
                          Medico que atendera este tratamiento<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                <select id="medpago" name="medpago" class="form-control">
                	<option value="">Elija un medico</option>
                	<?php foreach($empleado as $emp):?>
<option value="<?php echo $emp->id_empleado ?>"><?php echo $emp->apellido_paterno . " " . $emp->apellido_materno . " " . $emp->nombre  ?></option>
<?php endforeach;
?>
                </select>
			  </div>
					</div> 
                </div>

    	</div>


       	<div class="row">
          
         <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                <label for="celular">Saldo Total:</label>
                <input type="text" class="form-control" readonly name="saldototal" id="saldototal" autocomplete="off"  required >   
            </div>
       	 </div>
   		 </div>



    


        <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
              <input type="button"   value="Registrar" id="registrarcuota" class="btn  btn-primary">
              <input type="button"  id="Cancelar" class="btn btn-danger" value="Cancelar"> 
               
            </div>
          </div>
              

        </div>
         

            
           <input type="hidden" name="idcuota" id="idcuota" >
          <input type="hidden" name="montopagado" id="montopagado" >
           
            
          </form>

        </div>
      </div><!-- /.modal-content -->
    </div>
  </div>



<div class="modal fade bd-example-modal-lg" id="fmrenviar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="mdialTamanio" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" align="center">Registrar Tratamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <input type="hidden" name="idmod" id="idmod" class="form-control"  autocomplete="off">
     
                
             
         		<div class="row">
                	<h3 align="center">Ingresar pieza dental</h3>
                	  <br>
                 	<div class="col-md-5">
                         <div class="form-group">
                  	<div class="col-md-offset-2 col-md-10">
                        <label for="pieza" class="control-label">
                          N° PIEZA DENTAL<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-offset-2 col-md-10">
                 <input type="text" id="pieza" name="pieza" class="form-control" autocomplete="off"  placeholder="Ingrese numero de pieza dental" />
			
</div> 
                </div>
                     </div>
                     <div class="col-md-5">
                     	<div class="form-group">
                  	<div class="col-md-offset-2 col-md-5">
                    <label for="prec" class="control-label">
                      	NOMBRE PIEZA DENTAL<span style="color:#F00">*</span>
                    </label>
                    </div>
                    	<div class="col-md-offset-2 col-md-10">
                    <input type="hidden" name="id_pieza" id="id_pieza" class="form-control" autocomplete="off"/>
                    <textarea name="piezanom" id="piezanom" class="form-control" cols="100" rows="3" readonly style="resize: both;"></textarea>
                    	</div>
                  </div>
                	</div>
                </div>
     
                   <hr>
				<div class="row">
							<h3 align="center">Ingresar tratamiento</h3>
                          <br>
                           <div class="col-md-5">
					                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-10">
                        <label for="tra" class="control-label">
                          COD TRATAMIENTO<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-offset-2 col-md-10">
                 <input type="text" id="tra" name="tra" class="form-control" autocomplete="off"  placeholder="Ingrese Nombre o codigo tratamiento" />

					 <input type="hidden" name="precio" id="precio"/>
					 <input type="hidden" name="nomtra" id="nomtra"/>
					  <input type="hidden" name="codtra" id="codtra"/>
					  <input type="hidden" name="segtra" id="segtra"/>
					  <input type="hidden" name="idpago" id="idpago"/>
</div> 
                </div>
					</div>
              
               <div class="col-md-5">
                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-10">
                    <label for="pro2" class="control-label">
                      	DESCRIPCION TRATAMIENTO <span style="color:#F00">*</span>
                    </label>
                    </div>
                    	<div class="col-md-offset-2 col-md-10">
                    <textarea name="tranom" id="tranom" class="form-control" cols="100" rows="3" readonly style="resize: both;"></textarea>
                    	</div>
                  </div>
                  </div>

             
                </div>
                   
                     
                       <br>
                <hr>
                  <div class="form-group">
                  <div class="row">

                           <div class="col-md-7">
					                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-10">
                        <label for="pag" class="control-label">
                          Estado de pago<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-offset-2 col-md-10">
                <select id="pag" name="pag" class="form-control">
                	
                </select>
                	
					</div> 
               <span id="infControl" style="color:red"></span>
                </div>
					</div>
              
            

             
                </div>
                </div>
                       <hr>
                       <div class="form-group" >
                   <div class="row">

                           <div class="col-md-7">
					                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-10">
                        <label for="fec" class="control-label">
                          Fecha<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-offset-2 col-md-7">
                 <input type="date" id="fec" name="fec" class="form-control" autocomplete="off"  placeholder="Ingrese fecha de tratamiento" />


</div> 
                </div>
					</div>
              
            

             
                </div>
                </div>
               
			<br>
                <hr>
                  <div class="form-group" >
                  <div class="row">
						<?php $empleado=$base->query("SELECT * FROM tbl_empleados where estado='activo' and tipo_empleado='Medico'")->fetchAll(PDO::FETCH_OBJ); ?>
                           <div class="col-md-7">
					                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-10">
                        <label for="fec" class="control-label">
                          Medico que atendera este tratamiento<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-offset-2 col-md-10">
                <select id="med" name="med" class="form-control">
                	<option value="">Elija un medico</option>
                	<?php foreach($empleado as $emp):?>
<option value="<?php echo $emp->id_empleado ?>"><?php echo $emp->apellido_paterno . " " . $emp->apellido_materno . " " . $emp->nombre  ?></option>
<?php endforeach;
?>
                </select>

	
</div> 
                </div>
					</div>
              
            

             
                </div>
                </div>
			<br>

                   <div class="modal-footer">
                
                   
          <div class="col-md-2">
          
        <button type="button" class="btn btn-primary" id="enviar" name="enviar">Registrar</button>
       
        </div>
          <div class="col-md-2">
          
        <button type="button" class="btn btn-info" id="modificar" name="modificar">Modificar</button>
       
        </div>
      </div>
                </div>
         </div> 
        </div> 
</body>
</html>