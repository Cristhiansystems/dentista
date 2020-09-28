$(document).ready(function(){




//Eliminado en vesrion 2.0	
/*z$("#agen").change(function(){
          
        var id_agen=$( "#agen option:selected" ).attr('value');

        CargarAgend(id_agen);
});
mostrarAgencias($("#idagen").val());
//mostrarAsistentes();*/


//Eliminado parametro de id_agencia en v2.0
CargarAgend();










$('.clockpickerInicio').clockpicker();
$('.clockpickerFin').clockpicker();
});



function mostrarModalPacientes(){
	$('#moda_list_paci').modal('show');
}
function mostrarModalMedicos(){
	$('#moda_list_med').modal('show');
}

function print_calendar() 
    {
        window.print();  
    }


var calendar;
//Eliminado el parametro de id_agencia en v2.0
function CargarAgend(){
	
			$.ajax({
			url:"Columnas.php",
			type:"POST",
			async: false,
			
			success:function(json){
				Columnas = JSON.parse(json);
			},
		})
				//Eliminado parametro de id_agencia en v2.0
				Agenda(Columnas);

									
	}

	function enviarSms(){
			/*var parametros={'idcita':$('#idcita').val()};
		var url = 'shorten.php';
		$.ajax({
		type:'POST',
		url:url,
		data:parametros	,
		success: function(datos){
			
			//alert(datos);

			url=datos
		},
		})
		alert(url);*/

		Enviar($('#idcita').val(),'Paciente');
		//Enviar($('#idcita').val(),'Medico');
		//obtener_url_corta($('#idcita').val());
	}


	function obtener_url_corta(id_cita){

	}
	function Enviar(id_cita,tipo){
		var parametros={'idcita':id_cita,'tipo':tipo};
		var url = 'testAltiriaSms.php';
		$.ajax({
		type:'POST',
		url:url,
		data:parametros	,
		success: function(datos){
			alert(datos);
			 $('#newModal').modal('hide');
									  //    alert("se añadio");
									     // calendar.refetchEvents();
									      calendar.refetchEvents();
		},
		})
	}
	


	function editarRegistro (id_cita)
{ //Aqui lo recibo el parametro

	//$('#formulario')[0].reset();
	var url = 'edita_cita.php';
	//alert(codigo);
	//alert(cod);
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id_cita,
		success: function(valores){

				var datos = eval(valores);

				//console.log(moment(datos[3],'HH:mm:ss').format("hh:mm a"));
			/*	$('#reg').hide();
				$('#edi').show();

		$('#eli').show();*/
				$('#ProCita').val('Edicion');



			
			//	$('#id-registro').val(codigo);
				$('#idcita').val(id_cita);
				$('#Fecha').val(datos[1]);
				$('#TiempoInicio').val(moment(datos[2],'HH:mm:ss').format("HH:mm"));
				$('#TiempoFin').val(moment(datos[3],'HH:mm:ss').format("HH:mm"));
				$('#Estado').val(datos[4]);
				$('#idpac').val(datos[5]);
				$('#paciente').val(datos[6]);
				$('#celular').val(datos[12]);
				$('#medcelular').val(datos[13]);
				
				//document.forms[0].reset();
				$('#idmed').val(datos[7]);
				$('#medico').val(datos[8]);

              // var medicos = document.querySelector('#med');
               	//medicos.value = datos[7];   // Set SELECT value to 'ID' ("Indonesia")
             	//medicos.options[medicos.selectedIndex].defaultSelected = true;

             /*	var asistentes = document.querySelector('#asist')
               asistentes.value = datos[9];   // Set SELECT value to 'ID' ("Indonesia")
             	asistentes.options[asistentes.selectedIndex].defaultSelected = true;*/
             //	$('#asist').val(datos[9]);
				$('#idcons').val(datos[11]);
				
				
				$('#BtnEnviar').hide();	
				$('#BtnEditar').show();
				$('#BtnEliminar').show();
				$('#BtnSms').show();
				$('#newModal').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
};


/*function enviarsms (id_cita,numeropac,numeromedico,fechacita,horacita)
{ //Aqui lo recibo el parametro

	//mostrarAsistentes();
	//	mostrarMedicos();
	//$('#formulario')[0].reset();
	var params = { idcita: id_cita,nropac:numeropac,nromed:numeromedico,fech:fechacita,hora:horacita  }; // etc.
	var ser_data = jQuery.param( params ); 
	data=
	var url = 'enviosms.php';
	//alert(codigo);
	//alert(cod);
		$.ajax({
		type:'POST',
		url:url,
		data:ser_data,
		success: function(valores){
				alert(valores);
				return false
		}
	});
	return false;
};*/





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

$(function(){
	

	$('#bs-med').on('keyup',function(){

		var dato = $('#bs-med').val();
		var url = 'busca_medico.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#lista_medicos').html(datos);
		}
	});
	return false;
	});	
});


function mostrarMedicos(){
  $.ajax({
    type: "GET",
    url: 'medicos.php', 
    dataType: "json",
    success: function(data){

      $.each(data,function(key, registro) {

        $("#med").append('<option value='+registro.id_empleado+'>'+registro.empleado+'</option>');
      
      });        
    },
    error: function(data) {
      alert('error');
    }
  })};
//Eliminado la funcion mostrarAgencias en v2.0
 /* function mostrarAgencias(id_agencia){
  $.ajax({
    type: "GET",
    url: 'agencias.php', 
    dataType: "json",
    success: function(data){
      $.each(data,function(key, registro) {

        $("#agen").append('<option value='+registro.id_agencia+'>'+registro.nombre+'</option>');
      
      }); 
        document.getElementById('agen').value =id_agencia ;    
    },
    error: function(data) {
      alert('error');
    }
  })};*/
function mostrarAsistentes(){
  $.ajax({
    type: "GET",
    url: 'asistentes.php', 
    dataType: "json",
    success: function(data){
      $.each(data,function(key, registro) {
        $("#asist").append('<option value='+registro.id_empleado+'>'+registro.empleado+'</option>');
      });        
    },
    error: function(data) {
      alert('error');
    }
  })


};
function limpiar_calendario(){
	//alert("limpio");
	$("#calendar").html('');
	
	
};



function eliminarRegistro(){
	var id=$('#idcita').val();

	var url = 'elimina_cita.php';
	var pregunta = confirm('¿Esta seguro de eliminar esta Cita?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){

		 // CargarAgend($('#salonId').val());
			$('#newModal').modal('toggle');
			calendar.refetchEvents();
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
};




//Eliminado parametro de idag en la funcion Agenda en v2.0
function Agenda(AgendaColumnas) {
	
    var FechaActual = Date.now(); 
 limpiar_calendario();

  var calendarEl = document.getElementById('calendar');
  
  calendar = new FullCalendar.Calendar(calendarEl, {

			  schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
			  plugins: [ 'interaction', 'resourceDayGrid', 'resourceTimeGrid' ],
			  editable: false,
			  locale:'es',
			  defaultView: 'resourceTimeGridDay',
			  minTime: '08:00:00',
			  maxTime: '23:00:00',

			
			    			     
			   slotEventOverlap: false,
			      selectable: true,
			     // allow "more" link when too many events
			   customButtons: {
            // Add custom datepicker
            datepicker: {
                text: 'Calendario',
                click: function(e) {
                    picker.show();
                }
            }
        },
			      header: {
			        left: ' prev,next today',
			        center: 'title',
			        right: 'datepicker'
			      },
			    
			 
			      // uncomment this line to hide the all-day slot
			     					 allDaySlot: false,
										timeFormat:"h:mma",
			   						 resources:AgendaColumnas,
			   						 //Eliminado  el parametro de idag para la clasificacion de citas en v2.0
			   						 events: "Eventos.php",
							    
     

    
								      select: function(arg) {
								    
								 
								 	 $('#Formulario').trigger("reset"); 
								    var HoraInicio = new Date(arg.startStr);
								    var HoraFin = new Date(arg.endStr);
								    var Fecha=new Date(arg.endStr);
								 
								    document.getElementById("TiempoInicio").value = moment(HoraInicio).format("HH:mm");
								    document.getElementById("TiempoFin").value = moment(HoraFin).format("HH:mm");
								    document.getElementById("idcons").value=arg.resource.id;

								    fecha_actual = new Date(String(Fecha.getFullYear()+"-"+(Fecha.getMonth()+1)+"-"+ Fecha.getDate()));
								
									 $("#Fecha").val(moment(Fecha).format("YYYY-MM-DD"));
									$('#idpac').val("");
				$('#paciente').val("");
				$('#celular').val("");
				$('#idcita').val("");
				$('#idmed').val("");
				$('#medico').val("");
				$('#medcelular').val("");
				$('#Estado').val("Registrado");
				$('#alerta_medico').html(""); 
			
				//$('#asist').prop('selectedIndex',0);
								    //    alert("hola");
								   //   document.getElementById("Fecha").value=moment(Fecha).format("DD/MM/YYYY");
								  	$('#ProCita').val('Registro');
								  	$('#BtnEnviar').show();
								     $('#BtnEditar').hide();
								     $('#BtnEliminar').hide();
								      $('#BtnSms').hide();
								    $('#newModal').modal('show');

								      
								       

								      },



									      dateClick: function(arg) {


									      	//alert ("hola");
									        console.log(
									          'dateClick',
									          arg.date,
									        
									          arg.resource ? arg.resource.id : '(no resource)'
									      
									        );
									//  alert(arg.resource.id);
									      },


									      eventClick: function(arg) {	

									      editarRegistro (arg.event.id)	;		    
									      
									  
									      }
       
    })
  

    calendar.render();
      var picker = new Pikaday({
        field: document.querySelector('.fc-datepicker-button'),
         i18n: {
    previousMonth : 'Anterior',
    nextMonth     : 'Siguiente',
    months        : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',' Diciembre'],
weekdays      : ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
weekdaysShort : ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb']
        },


        format: 'yy-mm-dd',
        onSelect: function(dateString) {
            picker.gotoDate(new Date(dateString));
            calendar.gotoDate(new Date(dateString));
        }
    });
/*$('#FechaNota').val(moment(calendar.getDate()).format("DD-MM-YYYY"));
  //  alert(moment(calendar.getDate()).format("DD-MM-YYYY"));
  pagination(moment(calendar.getDate()).format("DD-MM-YYYY"),$('#salonId').val());
$('.fc-prev-button').click(function(){
	$('#FechaNota').val(moment(calendar.getDate()).format("DD-MM-YYYY"));	
	  pagination(moment(calendar.getDate()).format("DD-MM-YYYY"),$('#salonId').val());
});
$('.fc-today-button').click(function(){
	$('#FechaNota').val(moment(calendar.getDate()).format("DD-MM-YYYY"));		
	  pagination(moment(calendar.getDate()).format("DD-MM-YYYY"),$('#salonId').val());
});
$('.fc-next-button').click(function(){
	$('#FechaNota').val(moment(calendar.getDate()).format("DD-MM-YYYY"));	
	  pagination(moment(calendar.getDate()).format("DD-MM-YYYY"),$('#salonId').val());




});*/





	
 
};




function mostrarPaciente (idpaciente,paciente,celular){
		
	$('#idpac').val(idpaciente);
	$('#paciente').val(paciente);	
	$('#celular').val(celular);	
	$('#moda_list_paci').modal('hide');;	
};

function alerta_medico(idmed,fec,hor){
	var registrado;
	//var parametros={'idcita':id_cita,'tipo':tipo};
	var parametros={id_medico:idmed,fecha:fec,hora:hor};

	$.ajax({
    type: "POST",
    url: 'medico_cita.php', 
    data:parametros,
  
    success: function(data){
      $('#alerta_medico').html(data);      
    },
    error: function(data) {
      alert('error');
    }
  })
	//alert(registrado);
	//return registrado;
}

function mostrarMedico (idmedico,medico,celular,alerta){	
	$('#idmed').val(idmedico);
	$('#medico').val(medico);	
	alerta_medico(idmedico,$('#Fecha').val(),$('#TiempoInicio').val());
	$('#medcelular').val(celular);	
	$('#moda_list_med').modal('hide');	
};







function agregarRegistro(){

	
									
									var url='agrega_cita.php';
							//	alert($('#formulario').serialize());
									$.ajax({
									  type:'POST',
									  url:url,
									  data: $('#formulario').serialize(),
									  success :function (msg){
									  //	alert(msg);
									    $('#newModal').modal('hide');
									     // alert("se añadio");
									     // calendar.refetchEvents();
									      calendar.refetchEvents();
									     
									    return false;  
									  }
									});
									
}
