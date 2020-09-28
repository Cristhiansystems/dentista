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
<title>Registro Empleado</title>


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
	
	function errorci(){
	swal("ERROR EN EL REGISTRO","el ci del cliente ya existe","error");
	}
	
	
</script>
 <script src="../js/jQuery-2.1.4.min.js"></script>
 
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/bootstrap.min.css">


      <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>
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
	if(isset($_GET['errorfoto'])){
	
	echo "<script>";
	echo "errorfoto();";
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
                  <h3 class="box-title">Empleados</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                     <h1>REGISTRAR EMPLEADO</h1>
          
          <form action="registroPHP.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">

          <label class="control-label"> <span style="color:#F00">* Campos obligatorios</span></label>
         
          		
          		
          
                 <div class="form-group">
                 	<div class="col-md-offset-3 col-md-2">
                      <label for="ci" class="control-label">
                        CI<span style="color:#F00">*</span>
                      </label>
                     </div>
                     <div class="col-xs-9 col-sm-9 col-md-3">
                  		<input type="text"class="form-control" name="ci" id="ci"   autocomplete="off" required/>
                        <span style="color:#F00" id="repci"></span>
                        </div>
                         <div class="col-xs-3 col-sm-3 col-md-1">
                   <select  class="form-control" id="ext" name="ext">
                      <option value="LP">CH</option>
                      <option value="CH">LP</option>
                      <option value="CB">CB</option>
                      <option value="OR">OR</option>
                      <option value="PT">PO</option>
                      <option value="TJ">TJ</option>
                      <option value="SC">SC</option>
                      <option value="BE">BE</option>
                      <option value="PD">PA</option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group">
                	<div class="col-md-offset-3 col-md-2">
                      <label for="nom" class="control-label">
                        NOMBRE<span style="color:#F00">*</span>
                      </label>
                  </div>
                  	<div class="col-md-4">
                  <input type="text" class="form-control" name="nom" id="nom"  autocomplete="off" required/>
                  </div>
                </div>
         
                  <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                    <label for="apep" class="control-label">
                      	APELLIDO PATERNO
                    </label>
                    </div>
                    	<div class="col-md-4">
                    <input type="text" name="apep" id="apep" class="form-control" autocomplete="off"/>
                    	</div>
                  </div>
                  
                   <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          APELLIDO MATERNO
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="apem" id="apem" class="form-control" autocomplete="off"/>
                    </div>
                  </div>

                  <div class="form-group">
                     <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          TIPO DE EMPLEADO
                        </label>
                    </div>
                    <div class="col-md-4">
                     <select class="form-control" name="temp" id="temp">
                       <option value="#">Seleccionar...</option>
                       <option value="Administrativo">Administrativo</option>
                       <option value="Administrativo">Recepcionista</option>
                       <option value="Asistente">Asistente</option>
                         <option value="Medico">Medico</option>
                      
                    </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          ALIAS
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="ali" id="ali" class="form-control" autocomplete="off"/>
                    </div>
                  </div>

                   <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="cel" class="control-label">
                          CELULAR<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="number" name="cel" id="cel" class="form-control" autocomplete="off" required/>
                    </div>
                  </div>

                <div class="form-group has-success">
                  <div class="col-md-offset-3 col-md-2">
                      <label for="sang" class="control-label">
                        Grupo sanguineo:<span style="color:#F00">*</span>
                      </label>
                    </div>
                    <div class="col-md-4">
                  <select id="sang" name="sang" class="form-control"> 
                    <option value="A+" >A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                   
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>  
                  </select>
                  </div>
                </div>


                  <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          FECHA DE NACIMIENTO
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="date" name="fnac" id="fnac" class="form-control" autocomplete="off"/>
                    </div>
                  </div>

                    <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          DIRECCIÓN
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="dir" id="dir" class="form-control" autocomplete="off"/>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          FOTO
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="file" name="fot" id="fot" class="form-control" autocomplete="off"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          LOGIN
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="log" id="log" class="form-control" autocomplete="off"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                         CLAVE
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="clav" id="clav" class="form-control" autocomplete="off"/>
                    </div>
                  </div>

                 

                   


        	   
         	 <div class="form-group">
                <div class="col-md-offset-5 col-xs-3 col-sm-2 col-md-1">
          			<a href="empleado.php"><button type="button" name="volver" class="btn btn-danger">VOLVER</button></a>
              </div>
                    
        	   	<div class="col-xs-9 col-sm-9 col-md-1">
          			<button type="submit" name="enviando" class="btn btn-primary">REGISTRAR</button>
                  </div> 
          
          </div>
          
          </form>
                           
                           
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