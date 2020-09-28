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
<title>Registro cuenta por cuotas</title>
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

<script type="text/javascript" src="funciones.js"></script>
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
                  <h3 class="box-title">Cuenta por cuotas</h3>
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
				
                 
                
					  <div class="form-group">
						
						<div class="col-md-offset-1 col-md-2">

                    	<input type="button" name="btn-paciente" id="btn-paciente"  href="#moda_list_paci" value="Bucar Paciente" class="btn btn-primary ">
					  
					  </div>
					  <div class="col-md-4">

                    <input type="hidden" name="id_cliente" id="id_cliente" class="form-control" autocomplete="off"/>
                    <input type="hidden" name="seg" id="seg" class="form-control" autocomplete="off"/>
                    <input type="text" name="cliente" id="cliente" class="form-control" >
                    	</div>
                    	 <div class=" col-md-4">
					 
					
  						<input type="text" name="alertseg" id="alertseg" class="form-control" >
				
					
				
               
         		
                   </div>
					</div>
              

         		
                   
                   
                
                   <hr>

                 
                 
				  <div class="col-md-offset-8 col-md-1">
				<div class="form-group">

                    <div class="col-md-10">
                <button class="btn btn-facebook" id="anadir">Agregar tratamiento +</button>
</div> 
             
                <hr>
					</div>
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
            	Precio del tratamiento (Bs.)
            	</div>
            		<div  class="col-md-1">
            		<input type="text" readonly id="pretotal" name="pretotal" class="form-control" value="0"/> 
            	</div>
            	<div  class="col-md-offset-6 col-md-2">
            	N° de Pagos
            	</div>
            		<div  class="col-md-1">
            	<input type="text"  id="nropagos" name="nropagos" class="form-control" value="0" required /> 
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

<div class="modal fade" id="moda_list_paci" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Lista de Pacientes</h4>
        </div>
        <div class="modal-body">

          Buscador:
          <div><input type="text" class="form-control" name="bs-pac" id="bs-pac" autofocus></div>
          <br>  
            <div id="lista_pacientes"></div>

        </div>
      </div><!-- /.modal-content -->
    </div>
  </div>



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