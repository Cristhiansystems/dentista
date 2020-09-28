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
<title>Ver tratamiento</title>
<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>
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

	$id=$_GET["ide"];
	
	$alumno=$base->query("SELECT especialidad.nombre as especialidad,  especialidad.id_especialidad, tratamiento.nombre, tratamiento.id_tratamiento, tratamiento.codigo, precio, seguro FROM tratamiento INNER JOIN especialidad on tratamiento.id_especialidad=especialidad.id_especialidad  where tratamiento.id_tratamiento='$id'")->fetch(PDO::FETCH_ASSOC);
	
	
?>
<div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Tratamientos</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
  
          <h1>DETALLE DE PRODUCTO</h1>
          
         <div class="wrappera">
          <div class="panel panel-primary">
          	 <div class="panel-heading">
    			<h3 class="panel-title">Tratamiento: <?php echo $alumno['nombre']  ?> </h3>
 			 </div>
          
          </div>
          
            	<div class="panel-body">
                	
                	<div class="row">
                    <table align="center" class="table table-striped">
                    
                    			<tr>
                           
                            <td><h4>Codigo :</h4></td>
                          
                            <td><b><?php echo $alumno['codigo'];  ?></b></td>
                            
                            </tr>

                    	
                        	<tr>
                           
                            <td><h4>Precio :</h4></td>
                          
                            <td><b><?php echo $alumno['precio'];  ?></b></td>
                            
                            </tr>
							<tr>
                           
                            <td><h4>¿Cubre Seguro? :</h4></td>
                          
                            <td><b><?php echo $alumno['seguro'];  ?></b></td>
                            
                            </tr>

                       
                        
                        
                        
                       <tr>
                            <td><h4>Especialidad :</h4> </td>
                           
                           <td> <b><?php echo $alumno['especialidad'];  ?> </b></td>
                         </tr>
                        
                       
                           

               		</table>
                </div>
                
                </div>
                <div class="panel-footer">
              <a href="tratamiento.php"> <button type="button" name="enviando" class="btn btn-primary"/>Volver</button></a>
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