<?php 
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Consultorio</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/font-awesome.css">
   <link rel="stylesheet" href="../css/AdminLTE.min.css">
   <link rel="stylesheet" href="../css/_all-skins.min.css">
   <link rel="stylesheet" href="../css/sweetalert.css">
   <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
   <link rel="shortcut icon" href="../img/favicon.ico">

<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>
    <script src="../js/sweetalert.min.js"></script>
<script>
$(document).ready(function(){
	$("#tipo").val("activo");
	consulta($("#tipo").val());

	function consulta(estado,nropagina){
					//	esp=$("#esp").val();
		$.post("consulta.php", { estado:estado,pagina:nropagina }, function(data){
																			
									$("#tabla").html(data);
									controlarClick();
									return false;
									
					})
					   };

	function buscarconsulta(criterio,nropagina,tipoestado){
			
		$.post("buscar.php", { buscar:criterio,pagina:nropagina,estado:tipoestado}, function(data){																				$("#tabla").html(data);
			     controlarClick();
		     return false;
		});
	}
	
		$("#bus").click(function(){
		
		estado="activo";
		consulta(estado);
		
		});

		$("#rep").click(function(){
		criterio=$("#buscar").val();
		estado=$("#tipo").val();
		 window.location="reporte.php?criterio=" +criterio+ "&estado="+ estado ;
		
		});


	$("#buscar").keyup(function(){
	
		buscEmpl=$("#buscar").val();
		//alert($("#tipo").val());
		if(buscEmpl==''){
			//$("#tipo").val("activo");
			consulta($("#tipo").val(),"");
		}else{
			buscarconsulta(buscEmpl,"", $("#tipo").val());
		}
	
		
	});

		$("#des").click(function(){
		
			if($("#tipo").val()=="activo"){
				//	$("#tipo").val("desactivo");
				//	consulta($("#tipo").val());
					$("#tipo").val("desactivo");
					consulta($("#tipo").val());
					$('#des').removeClass('btn-warning');
               		 $('#des').addClass('btn-success');
               		$("#des").prop('value', 'Activos'); 
               		 
				}else{
						$('#des').removeClass('btn-success');
               		 $('#des').addClass('btn-warning');
               		 $("#tipo").val("activo");
					consulta($("#tipo").val());
					
					$("#des").prop('value', 'Desactivados'); 
				}
		
		});

		function controlarClick() {
    $("input[name='del']").off('click');
    $("input[name='del']").on('click', function(event){
       borrarest(event);
	});
}

$("#tabla").on('click','#btnbuscpag', function(event){
 		event.preventDefault();
 		buscEmpl=$("#buscar").val();
        var pag = $(this).attr('data');	
       	buscarconsulta(buscEmpl, pag, $("#tipo").val());	
     }); 


	$("#tabla").on('click','#btnpag', function(event){
        
 		event.preventDefault();
        var page = $(this).attr('data');	
       	consulta($("#tipo").val(), page);	
       var dataString = 'page='+page;
      
 
   
     }); 


function borrarest(event){
							        swal({
			  title: "¿ESTA SEGUR@ QUE DESEA ELIMINAR EL CONSULTORIO?",
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
								
								$.post("borrar.php", { ide: ide }, function(data){
																			
									swal("SE HA ELIMINADO AL PRODUCTO CORRECTAMENTE", "","success");
									
									$("#tabla").html(data);
									estado="activo";
									consulta(estado);
									
									
	          
					});
 
    });

	}			
});



function error(){
	
	swal("ERROR ","no se puede eliminar","error");
	
	}
function act(a){

	swal("SE HA ACTUALIZADO EL TRATAMIENTO " ,"","success");
	
	}
function mensaje(){
	swal("SE HA REGISTRADO EL PRODUCTO CON EXITO","","success");
	
	}
	function res(){

	swal("SE HA RESTAURADO EL TRATAMIENTO  " ,"","success");
	
	}
	
	function ver(id2){
	
	 window.location="ver.php?ide=" + id2;
	
	}
function rest(id2){
		swal({
  title: "¿ESTA SEGUR@ QUE DESEA RESTAURAR EL CONSULTORIO?",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "SI! deseo restaurarlo",
  cancelButtonText: "No, cancelar",
  closeOnConfirm: false
},
function(){
 
	   window.location="restaurar.php?ide=" + id2;
 
});
}
</script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php
include("../header.php");
include("../conexion.php");


if(isset($_GET['res'])){

	echo "<script>";
	echo "res();";
	echo "</script>";
	
	}
if(isset($_GET['act'])){

	echo "<script>";
	echo "act();";
	echo "</script>";
	
	}
if(isset($_GET['error'])){
	echo "<script>";
	echo "error();";
	echo "</script>";
	
	}
if(isset($_GET['mensaje'])){
	echo "<script>";
	echo "mensaje();";
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
                  <h3 class="box-title">Consultorios</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
	                    
		              <?php
							include("filtros-productos.php");
						?>	
							
<h1 align="center">LISTA DE CONSULTORIOS</h1>

<div class="table-responsive">
								 <div id="tabla">


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
</body>

</html>