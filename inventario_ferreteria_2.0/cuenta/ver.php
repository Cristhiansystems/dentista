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
<title>Ver producto</title>
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
	
	$alumno=$base->query("SELECT tipo_producto.nombre as tipo, tipo_producto.id_tipo_producto, producto.nombre, producto.id_producto, precio, descripcion, cantidad, imagen FROM producto INNER JOIN tipo_producto on producto.id_tipo_producto=tipo_producto.id_tipo_producto where producto.id_producto='$id'")->fetch(PDO::FETCH_ASSOC);
	
	
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
  
          <h1>VER ESTUDIANTE</h1>
          
         <div class="wrappera">
          <div class="panel panel-primary">
          	 <div class="panel-heading">
    			<h3 class="panel-title">Producto: <?php echo $alumno['nombre']  ?> </h3>
 			 </div>
          
          </div>
          
            	<div class="panel-body">
                	
                	<div class="row">
                    <table align="center" class="table table-striped">
                    
                    		<tr>
                            <td>
                            <?php 
							if($alumno['imagen']!=""){
                           echo '<img src="../img/'. $alumno["imagen"] .'" alt="imagen" width="200px" height="200px" class="img-thumbnail">';}
						   
						   else {
							   echo '<img src="../img/sinfoto.png" alt="imagen" width="200px" height="200px" class="img-thumbnail">';
							   }
						   
						   ?>
                          
                            </td>
                            
                            </tr>
                    	
                        	<tr>
                           
                            <td><h4>Precio :</h4></td>
                          
                            <td><b><?php echo $alumno['precio'];  ?></b></td>
                            
                            </tr>


                        <tr>
                           
                           <td><h4> Cantidad : </h4></td>
                           
                           	<td><b> <?php echo $alumno['cantidad'];  ?> </b></td>
                        
                        
                        
                       <tr>
                            <td><h4>Tipo de Producto :</h4> </td>
                           
                           <td> <b><?php echo $alumno['tipo'];  ?> </b></td>
                         </tr>
                        
                        <tr>
                            <td><h4>Descripcion : </h4></td>
                            
                          <td> <b> <?php echo $alumno['descripcion'];  ?> </b></td>
                           

               		</table>
                </div>
                
                </div>
                <div class="panel-footer">
              <a href="producto.php"> <button type="button" name="enviando" class="btn btn-primary"/>Volver</button></a>
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