

$(document).ready(function(){

var md_pacientes = document.getElementById('btn-paciente'); 
md_pacientes.addEventListener('click', mostrarModalPacientes); 

		$("#divseg").hide();
		$("#registrar").attr('disabled','disabled');
		$("#anadir").attr('disabled','disabled');
		
			


			/*$("#ci").on("keyup", function() {
    			ci=$("#ci").val();

				$.post("getCliente.php", {ci: ci }, function(data){
									console.log(data);
									if(data['id_paciente']!==""){

									
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
					
				});*/

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
										
											opcion="<option value='Debe'>Debe</option>";
											opcion+="<option value='Pagado'>Pagado</option>";
                							opcion+="<option value='Seguro'>Seguro</option>";
                							opcion+="<option value='Control'>Control</option>";
											$("#pag").html(opcion);
										
									
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
	}
	);
	 $("input[name='reacheck']").off('click');
	$("input[name='reacheck']").on('click', function(event){
       cambiarEstado(event);
	   //return false;
	});
		
	}

$(function(){
	

	$('#bs-pac').on('keyup',function(){

		var dato = $('#bs-pac').val();
		var url = 'busca_paciente.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#lista_pacientes').html(datos);
		}
	});
	return false;
	});	
});


function mostrarModalPacientes(){
	$('#moda_list_paci').modal('show');
}

	$("#pag").change(function(){
		estadoPago=$("#pag").val();
		if(estadoPago=="Control"){
			$("#infControl").html("Al ser un control tendra un costo de 0 Bs.");
			//$("#nropag").hide();
		}else {
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
			$("#fec").val("");/////////////////////////////////////////////////
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
			fecha=$("#fec").val();//////////////////////////////

			doctor=$("#med option:selected").text();
			id_doctor=$("#med option:selected").val();
			pago=$("#pag option:selected").val();
			if (id_tratamiento=="" || fecha =="" || id_doctor ==""){
				alert("Debe llenar los campos tratamiento, fecha y doctor");
			}else{
				
				if(pago=="Pagado"){
					bgcolor="#abebc6";
					valor="<input type='checkbox' name='estcheck' id='estcheck-"+cont+"' checked>";	
				}else if(pago=="Debe"){
					bgcolor="#f7dc6f";
					valor="<input type='checkbox' name='estcheck' id='estcheck-"+cont+"'>";
				}else if(pago=="Control"){
					bgcolor="#d5dbdb";
					precio=0;
					valor="<input type='checkbox' name='estcheck' id='estcheck-"+cont+"' checked>"
				}else if(pago=="Seguro"){
					bgcolor="#85c1e9";
					valor="<input type='checkbox' name='estcheck' id='estcheck-"+cont+"' checked disabled>";
				}
				preciosubtotal=parseFloat((precio));
				preciosubtotal	= preciosubtotal.toFixed(2);
				fila="<tr id='" +cont + "'><td><input type='hidden' name='pieza[]'  value='"+ id_pieza + "'>"  + pieza + "</td><td><input type='hidden' name='trat[]'  value='"+ id_tratamiento + "' >" + tratamiento  +"</td><td><input type='hidden' name='prec[]' id='prec-"+cont+"' value='"+ precio + "'>"+ precio +" Bs.</td><td bgcolor='"+bgcolor+"'><input type='text' name='estpag[]' id='estpag-"+cont+"'  value='"+ pago + "'> "+ valor +"  " +pago + "</td><td><input type='hidden' name='medico[]'  value='"+ id_doctor + "'>"  + doctor + "</td><td><button name='del' id='del-" +cont + "' class='btn btn-danger'>-</button></td></tr>";
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
function mostrarPaciente (idpaciente,paciente,seguro,){

									$("#id_cliente").val(idpaciente);
									$("#cliente").val(paciente);
								/*	$("#seg").val(data['seg']);
										seg=$("#seg").val();*/
										if(seguro=="Particular"){
											$("#divseg").hide();
											$("#alertseg").val("Paciente particular");
											
										}else{
											$("#divseg").show();
											$("#alertseg").val("Paciente asegurado"+ " - "+ seguro);
										}
									$("#registrar").removeAttr('disabled');
									$("#anadir").removeAttr('disabled');
		
	
									$('#moda_list_paci').modal('hide');;	
};

	
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
	
	
	
