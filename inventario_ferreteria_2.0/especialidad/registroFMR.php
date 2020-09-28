<?php 
ob_start();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro especialidad</title>
<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>

<script>

$(document).ready(function(){
			
					
				});
	
function mensaje(){
	swal("CLIENTE2 REGISTRADO CON EXITO","", "success");
	}
	function mensaje2(){
	swal("ERROR EN EL REGISTRO","","error");
	}
	function mensaje3(){
	swal("ERROR EN EL REGISTRO","el rude del estudiante ya existe","error");
	}
	
	function errornombre(){
	swal("ERROR EN EL REGISTRO","el nombre ya existe","error");
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

	
	if(isset($_GET['errornombre'])){
	
	echo "<script>";
	echo "errornombre();";
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
                  <h3 class="box-title">Especialidades</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                     <h1>REGISTRAR ESPECIALIDAD</h1>
          
          <form action="registroPHP.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
          <label class="control-label"> <span style="color:#F00">* Campos obligatorios</span></label>
          <div class="row">
          		
          		
          
               

                  <div class="form-group">
                	<div class="col-md-offset-3 col-md-2">
                      <label for="nom" class="control-label">
                        NOMBRE<span style="color:#F00">*</span>
                      </label>
                  	</div>
                  	<div class="col-md-4">
                  <input type="text" name="nom" id="nom" class="form-control" autocomplete="off" required/>
                  </div>
                </div>

        	   
         	<div class="col-md-offset-3 col-md-2">
          			<a href="especialidad.php"><button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
                    </div>
        	   		<div class="col-md-2">
          			<button type="submit" name="enviando" class="btn btn-primary"/>REGISTRAR</button>
                    </div>
          
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
</body>
</html>