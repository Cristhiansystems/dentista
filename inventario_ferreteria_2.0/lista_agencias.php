<?php
session_start();
$id_empleado=$_SESSION["id"];
include("conexion.php");



$query = $base->query("SELECT concat_ws(' ',nombre, apellido_paterno,apellido_materno) as empleado ,ci, direccion,foto,celular,tipo_empleado FROM tbl_empleados where id_empleado='$id_empleado'" );

 $registros=$base->query("SELECT age.nombre,age.direccion,usu.id_usuario FROM tbl_usuarios usu inner join tbl_empleados emp on usu.id_empleado=emp.id_empleado INNER join tbl_agencias age on usu.id_agencia=age.id_agencia WHERE emp.id_empleado='$id_empleado'")->fetchAll(PDO::FETCH_OBJ);





?>
<!DOCTYPE html>
<html>
<head>
	<title>
		

	</title>


   <link rel="stylesheet" href="css/font-awesome.css">
   <link rel="stylesheet" href="css/AdminLTE.min.css">
   <link rel="stylesheet" href="css/_all-skins.min.css">
   <link rel="stylesheet" href="css/sweetalert.css">
   <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
   <link rel="shortcut icon" href="img/favicon.ico">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jQuery-2.1.4.min.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/app.min.js"></script>
    <script src="js/sweetalert.min.js"></script>

</head>
<body class="hold-transition login-page">
<?php

include("conexion.php");


?>
   
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row ">
            <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos Empleado</h3>
                 <?php foreach ($query as $empleado) { 
								
							 ?>
                </div>
                <!-- /.box-header -->
                <form role="form" id="frmAcceder" name="frmAcceder">
                  <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                          <div class="box box-widget widget-user-2">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header bg-yellow">
                           
                              <img class="img-thumbnail" src="empleado/<?php echo $empleado['foto']; ?>" alt="Usuario" width="80" height="100" style=" margin-left: auto;margin-right: auto;display: block;">
                         
                          
                          </div>

                          <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                              <li><a href="#"><strong>Empleado:</strong>&nbsp; <?php echo $empleado['empleado']; ?><span class="pull-right badge bg-blue"><i class="fa fa-fw fa-users"></i></span></a></li>
                              <li><a href="#"><strong>Cedula de Identidad:</strong>&nbsp; <?php echo $empleado['ci']; ?><span class="pull-right badge bg-green"><i class="fa fa-fw fa-newspaper-o"></i></span></a></li>
                              <li><a href="#"><strong>Dirección:</strong>&nbsp; <?php echo $empleado['direccion']; ?><span class="pull-right badge bg-red"><i class="fa fa-fw fa-map-marker"></i></span></a></li>
                              <li><a href="#"><strong>Celular:</strong>&nbsp; <?php echo $empleado['celular']; ?> <span class="pull-right badge bg-blue"><i class="fa fa-fw fa-mobile-phone"></i></span></a></li>
                              <li><a href="#"><strong>Tipo de Empleado:</strong>&nbsp; <?php echo $empleado['tipo_empleado']; ?><span class="pull-right badge bg-aqua"><i class="fa fa-fw fa-filter"></i></span></a></li>
                            
                            </ul>
                          </div>
                        </div><!-- /.widget-user -->

                    </div>
                  </div> 
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <a type="button" href="ajax/UsuarioAjax.php?op=Salir" class="btn btn-danger">Cerrar Sesión</a>
                  </div>
                </form>

            <?php } ?>
              
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->

<div class="col-md-8">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Lista Agencias</h3>
               
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="box">
                
                <div class="box-body no-padding">
                  <table class="table table-hover" >
                    <thead><tr>                      
                      <th>Opcion</th>
                      <th>Sucursal</th>
                      <th>Dirección</th>
                      
                    </tr>
                    
                    </thead>
                    <tbody>
                    <?php
                    foreach($registros as $productos):
                    	?>
                    <tr>


	             		<td><button type="button" onclick="Acceder(<?php echo $productos->id_usuario ;?>)" class="btn btn-info pull-left">Acceder</button></td>
		                <td><?php echo $productos->nombre ;?></td>
		                <td><?php echo $productos->direccion ; ?></td>
		                
	             	</tr> 

	             	<?php endforeach;?>
	             </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             </div><!-- /.row -->


                
              </div><!-- /.box -->

 

       
   </div>
   </section>
         <script type="text/javascript">
      

     
      function Acceder(id_usuario){
      //	console.log(id_usuario);
      	var data = { 
            "idusuario": id_usuario
           
        };
        $.post("creacion_usuario.php", { idusuario: id_usuario }, function(r){
        //	alert(r);
                $(location).attr("href", "agenda/agenda.php");
          });

      }




  </script>


</body>
</html>