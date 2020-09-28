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
<title>venta</title>
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
	
	
	$("#bus").click(function(){
		ci=$("#ci").val();
		fi=$("#fechai").val();
		ff=$("#fechaf").val();
		$.post("buscar.php", {ci:ci, fi:fi, ff:ff }, function(data){
																			
									
									$("#tabla").html(data);
									controlarClick();
									return false;
									
									
	          
					});
		
	});

		$("#rep").click(function(){
		ci=$("#ci").val();
		fi=$("#fechai").val();
		ff=$("#fechaf").val();
		 window.location="reporte.php?ci=" + ci+ "&fi="+ fi + "&ff="+ ff;
		
		});
			$("#des").click(function(){
		
			$.post("desactivados.php", { }, function(data){
																			
									
									$("#tabla").html(data);
									controlarClick();
									return false;
									
									
	          
					});
		
		});
		
		$("input[name='del']").on("click",function(event){

				 borrarest(event);
				});
						
					
			
				
		function controlarClick() {
    $("input[name='del']").off('click');
    $("input[name='del']").on('click', function(event){
       borrarest(event);
	});
}


function borrarest(event){
							        swal({
			  title: "¿ESTA SEGUR@ QUE DESEA ELIMINAR AL PRODUCTO?",
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
								console.log(ide);
								ci=$("#ci").val();
								fi=$("#fechai").val();
								ff=$("#fechaf").val();

								$.post("borrar.php", { ide: ide, ci:ci, fi:fi, ff:ff}, function(data){
																			
									swal("SE HA ELIMINADO AL PRODUCTO CORRECTAMENTE", "","success");
									
									$("#tabla").html(data);
									controlarClick();
									
									
	          
					});
 
    });

	}			
});
function error(){
	
	swal("ERROR ","no se puede eliminar","error");
	
	}
function act(a){
	var it=a;
	swal("SE HA ACTUALIZADO EL PRODUCTO CON EL ID " + it ,"","success");
	
	}
function mensaje(){
	swal("SE HA REGISTRADO EL PRODUCTO CON EXITO","","success");
	
	}
	function res(i){
	var it=i;
	swal("SE HA RESTAURADO EL PRODUCTO CON EL ID " + it ,"","success");
	
	}
	
	function ver(id2){
	
	 window.location="ver.php?ide=" + id2;
	
	}
function rest(id2){
		swal({
  title: "¿ESTA SEGUR@ QUE DESEA RESTAURAR AL PRODUCTO?",
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
	$i=$_GET['res'];
	echo "<script>";
	echo "res($i);";
	echo "</script>";
	
	}
if(isset($_GET['act'])){
	$a=$_GET['act'];
	echo "<script>";
	echo "act($a);";
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
                  <h3 class="box-title">Sistema de Ventas</h3>
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
							
<h1 align="center">VENTAS</h1>

<table id="tabla" align="center" class="table">


</table>
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