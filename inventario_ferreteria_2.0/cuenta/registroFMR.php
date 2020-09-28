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
<title>Registro cuenta</title>
<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>

<script>

$(document).ready(function(){
		$("#divseg").hide();
		$("#registrar").attr('disabled','disabled');
		$("#anadir").attr('disabled','disabled');
			$("#ci").on("keyup", function() {
    			ci=$("#ci").val();

				$.post("getCliente.php", {ci: ci }, function(data){
									console.log(data);
									if(data['id_paciente']!==""){

									$("#id_cliente").val(data['id_paciente']);
									$("#cliente").html(data['paciente']);
									$("#seg").val(data['seg']);
										seg=$("#seg").val();
										if(seg=="si"){
											$("#divseg").show();
											$("#alertseg").html("Paciente asegurado"+ " - "+ data['seguro']);
										}else{
											$("#divseg").hide();
											$("#alertseg").html("Paciente particular");
										}
									$("#registrar").removeAttr('disabled');
									$("#anadir").removeAttr('disabled');
									
									}else{
									$("#id_cliente").val("");
									$("#cliente").html("");
									$("#seg").val("");
									$("#divseg").hide();
									$("#registrar").attr('disabled','disabled');
									$("#anadir").attr('disabled','disabled');
										$("#alertseg").html("");
									$('#tabla tbody').html("");
									}
									
								
							});
					
				});
	
	

			
	
	
	$("#pieza").on("keyup", function() {
    			pieza=$("#pieza").val();
			
				$.post("getPieza.php", {pieza: pieza }, function(data){
			
									if(data['id_pieza']!==""){

									$("#id_pieza").val(data['id_pieza']);
									$("#piezanom").html(data['pieza']);
										
									
									}else{
									$("#id_pieza").val("");
									$("#piezanom").html("");
								
									}
									
								
							});
					
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
										if(segtra=="Si" && seg=="si"){
											opcion="<option val='Seguro'>Seguro</option>";
											$("#pag").html(opcion);
										}else{
											opcion="<option value='Debe'>Debe</option>";
                							opcion+="<option value='Pagado'>Pagado</option>";
                						
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
	

	function controlarClick() {
		
	  $("button[name='del']").off('click');
    $("button[name='del']").on('click', function(event){
       borrarcurso(event);
	   return false;
	});
		
	
	
	 $("input[name='reacheck']").off('click');
	$("input[name='reacheck']").on('click', function(event){
       cambiarEstado(event);
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
			return false;
					
			});
	
	$("#enviar").click(function(){
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
				
				if(pago=="Pagado"){
					bgcolor="#abebc6";	
				}else if(pago=="Debe"){
					bgcolor="#f7dc6f";
				}else if(pago=="Cuotas"){
					bgcolor="#eb984e";
				}else if(pago=="Control"){
					bgcolor="#d5dbdb";
					precio=0;
				}else if(pago=="Seguro"){
					bgcolor="#85c1e9";
				}
				preciosubtotal=parseFloat((precio));
				preciosubtotal	= preciosubtotal.toFixed(2);
				fila="<tr id='" +cont + "'><td><input type='hidden' name='pieza[]'  value='"+ id_pieza + "'>"  + pieza + "</td><td><input type='hidden' name='trat[]'  value='"+ id_tratamiento + "' >" + tratamiento  +"</td><td><input type='hidden' name='prec[]' id='prec-"+cont+"' value='"+ precio + "'>"+ precio +" Bs.</td><td><input type='hidden' name='fecha[]'  value='"+ fecha + "' >" + fecha  + " </td><td bgcolor='#f5b7b1'><input type='hidden' name='realizado[]' id='realizado-"+cont+"'  value='no' > <input type='checkbox' name='reacheck' id='reacheck-"+cont+"' ></td><td bgcolor='"+bgcolor+"'><input type='hidden' name='estpag[]' id='estpag-"+cont+"'  value='"+ pago + "'>"  + pago + "</td><td><input type='hidden' name='medico[]'  value='"+ id_doctor + "'>"  + doctor + "</td><td><button name='del' id='del-" +cont + "' class='btn btn-danger'>-</button></td></tr>";
				$('#tabla tbody').append(fila);
				pretototal=parseFloat(pretototal)+ parseFloat(preciosubtotal);
				
				pretototal= parseFloat((pretototal));				pretototal=pretototal.toFixed(2);

				$("#pretotal").val(pretototal);
				$("#fmrenviar").modal("hide");
				controlarClick();
				
				
			}
		
		obtenerPago();
	});
	
	$("#descuento").change(function(){
		obtenerPago();
	})
			
	function obtenerPago(){
			pagar=0;
			seguro=0;
		$("input[name='estpag[]']").each(function(){
									
										 if($(this).val()=="Pagado"){
											 subventa=$(this).attr('id');
											
											sv=subventa.split("-");
											a_pretotal=sv[1];
											 precio=$("#prec-"+a_pretotal).val()
											 pagar=parseFloat((pagar)) + parseFloat((precio));
											
										 }
			
										if($(this).val()=="Seguro"){
											 subventa=$(this).attr('id');
											
											sv=subventa.split("-");
											a_pretotal=sv[1];
											 precio=$("#prec-"+a_pretotal).val()
											 seguro=parseFloat((seguro)) + parseFloat((precio));
											
										 }
				
										 });

					pretototal= $("#pretotal").val();
					saldo=parseFloat(pretototal) - parseFloat(pagar);
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
					saldo=saldo.toFixed(2);
					
					
					$("#pagar").val(pagar);
					$("#pagseguro").val(seguro);
					$("#pagardescuento").val(pagardescuento);
					$("#saldo").val(saldo);
					

	}
		function borrarcurso(event){
				subventa=event.target.id;
				sv=subventa.split("-");
				a_pretotal=sv[1];
				preciosubtotal=$("#prec-" + a_pretotal).val();
				 td=$("#"+ subventa).parent('td');
				 td.parent('tr').remove();
				pretototal= $("#pretotal").val();
				pretototal=parseFloat((pretototal)) - preciosubtotal;
				pretototal= parseFloat((pretototal).toFixed(2));
				$("#pretotal").val(pretototal);
				obtenerPago();
			controlarClick();
				return false;
				}
	
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
 <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../img/favicon.ico">
<script src="../js/sweetalert.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php
include("../header.php");
include("../conexion.php");

	if(isset($_GET['mensaje2'])){
	
	echo "<script>";
echo "mensaje2();";
echo "</script>";
	}
	if(isset($_GET['mensaje3'])){
	
	echo "<script>";
echo "mensaje3();";
echo "</script>";
	}
	if(isset($_GET['errorrude'])){
	
	echo "<script>";
	echo "errorrude();";
	echo "</script>";
	}
	
	if(isset($_GET['errorci'])){
	
	echo "<script>";
	echo "errorci();";
	echo "</script>";
	}
	if(isset($_GET['erroredad'])){
	
	echo "<script>";
	echo "erroredad();";
	echo "</script>";
	}
	if(isset($_GET['alerta'])){
	
	echo "<script>";
	echo "alerta();";
	echo "</script>";
	}

?>

   <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Cuenta</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                     <h1>REGISTRAR CUENTA</h1>
          
          <form action="registroPHP.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
          <label class="control-label"> <span style="color:#F00">* Campos obligatorios</span></label>
          <div class="row">
				
                 
                 <div class="col-md-4">
					  <div class="form-group">
						<div class="col-md-offset-2 col-md-5">
						  <label for="ci" class="control-label">
							COD PACIENTE<span style="color:#F00">*</span>
						  </label>
					  </div>
						<div class=" col-md-offset-2 col-md-10">
					  <input type="text" name="ci" id="ci" class="form-control" autocomplete="off" placeholder="Ingrese CI o codigo paciente" required/>
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
                    <input type="hidden" name="id_cliente" id="id_cliente" class="form-control" autocomplete="off"/>
                    <input type="hidden" name="seg" id="seg" class="form-control" autocomplete="off"/>
                    <textarea name="cliente" id="cliente" class="form-control" cols="100" rows="3" readonly style="resize: both;"></textarea>
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
            		<div  class="col-md-1">
            	<input type="text" readonly id="pagar" name="pagar" class="form-control" value="0"/> 
            	</div>
            	</div>
            	
            	
            	 <div class="form-group">
              	<div  class="col-md-offset-6 col-md-2">
            	Descuento
            	</div>
            		<div  class="col-md-2">
            	<select class="form-control" id="descuento" name="descuento">
					<option value="0">0 %</option>
					<option value="10">10 %</option>
					<option value="20">20 %</option>
					<option value="30">30 %</option>
					<option value="40">40 %</option>
					<option value="50">50 %</option>
					<option value="60">60 %</option>
					<option value="70">70 %</option>
					<option value="80">80 %</option>
					<option value="90">90 %</option>
					<option value="100">100 %</option>
            	</select>
            	</div>
            	</div>
            	
            	  <div class="form-group">
              	<div  class="col-md-offset-6 col-md-2">
            	Total con descuento (Bs.) 
            	</div>
            		<div  class="col-md-1">
            		<input type="text" readonly id="pagardescuento" name="pagardescuento" class="form-control" value="0"/> 
            	</div>
            	</div>
            	
            	 <div class="form-group" id="divseg">
              	<div  class="col-md-offset-6 col-md-2">
            	Seguro (Bs.)
            	</div>
            		<div  class="col-md-1">
            	  		<input type="text" readonly id="pagseguro" name="pagseguro" class="form-control" value="0"/> 
            	</div>
            	</div>
            	
            	
            	  <div class="form-group">
              	<div  class="col-md-offset-6 col-md-2">
            	Saldo (Bs.)
            	</div>
            		<div  class="col-md-1">
            	  		<input type="text" readonly id="saldo" name="saldo" class="form-control" value="0"/> 
            	</div>
            	</div>
             
               <div class="form-group">
              	<div  class="col-md-offset-6 col-md-2">
            	Precio del tratamiento (Bs.)
            	</div>
            		<div  class="col-md-2">
            		<input type="text" readonly id="pretotal" name="pretotal" class="form-control" value="0"/> 
            	</div>
            	</div>
             
           
            </div>
            </div>
            <!-- /.box-body -->
			 
         	<div class="col-md-offset-3 col-md-2">
          			<a href="cuenta.php"><button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
                    </div>
        	   		<div class="col-md-2">
          			<button type="submit" name="enviando" id="registrar" class="btn btn-primary"/>REGISTRAR</button>
                    </div>
          
          
          
          </form>
              </div>            
                          </div>
                           </div>
                           
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->


        </section><!-- /.content -->
        </div>
        

 
<?php include("../pie_de_pagina.html"); ?>  
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

					 <input type="hidden" name="precio" id="precio"  />
					 <input type="hidden" name="nomtra" id="nomtra"  />
					  <input type="hidden" name="codtra" id="codtra" />
					  <input type="hidden" name="segtra" id="segtra"/>
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
      </div>
                </div>
         </div> 
        </div> 
</body>

</html>