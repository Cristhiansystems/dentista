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
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registro usuarios</title>
<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>
    

<script>

$(document).ready(function(){
  
			mostrarAgencias();
				
				});

  function mostrarAgencias(){
  $.ajax({
    type: "GET",
    url: 'agencias.php', 
    dataType: "json",
    success: function(data){
      $.each(data,function(key, registro) {
        $("#agen").append('<option value='+registro.id_agencia+'>'+registro.nombre+'</option>');
      });        
    },
    error: function(data) {
      alert('error');
    }
  })};
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
	function mostrarEmpleado (idempleado,empleado){
    
  $('#idemp').val(idempleado);
  $('#empleado').val(empleado); 
  $('#moda_list_empl').modal('toggle');
   $(this).removeData();  
};
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
                  <h3 class="box-title">Usuarios</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                     <h1>REGISTRAR USUARIOS</h1>
          
          <form action="registroPHP.php" method="post"  class="form-horizontal" role="form">
          <label class="control-label"> <span style="color:#F00">* Campos obligatorios</span></label>
        
                  <div class="form-group">
                     <div class="col-md-offset-3 col-md-2 col-sm-4">
                        <label for="apem" class="control-label">
                          Agencia:
                        </label>
                    </div>
                    <div class="col-md-4 ">
                     <select class="form-control" name="agen" id="agen">
                        <option value="#">Seleccionar...</option>
                    </select>
                    </div>
                  </div>

                  <div  class="form-group">

                   <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          Empleado:
                        </label>
                    </div>
                    <div class="col-md-4">
                  <div class="input-group">
                     <span class="input-group-btn">
                      <button type="button" class="btn btn-info" data-toggle="modal" id="btn-paciente" data-target="#moda_list_empl" >Buscar</button>
                  </span>
                  <input type="text" class="form-control" name="empleado" id="empleado"   required>
                  </div>
                </div>
                  </div>

                   <div class="form-group">
                     <div class="col-md-offset-3 col-md-2 col-sm-4">
                        <label for="apem" class="control-label">
                          Tipo Usuario:
                        </label>
                    </div>
                    <div class="col-md-4 ">
                     <select class="form-control" name="tipousu" id="tipousu">
                        <option value="Administrador">Administrador</option>
                        <option value="Empleado">Empleado</option>
                    </select>
                    </div>
                  </div>

          

                  <input type="hidden" name="idemp" id="idemp">
                     <div class="form-group ">
                      
                           <div class=" col-md-2 col-md-offset-3 ">
                  <label class="heading">Seleccione los permisos:</label>
                      </div>
                      <div class="col-md-3">
                  <div class="checkbox">
                    <label><input type="checkbox" name="mantenimiento" value="mantenimiento">Mantenimiento</label>
                  </div>
                  <div class="checkbox"> 
                    <label><input type="checkbox" name="grupodental" value="grupodental">Grupo Dental</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="citas" value="citas">Citas</label>
                  </div> 
                  <div class="checkbox">
                    <label><input type="checkbox" name="caja" value="caja">Caja</label>
                  </div> 
                  <div class="checkbox">
                    <label><input type="checkbox" name="procesosd" value="procesosd">Procesos Dentales</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="consultasp" value="consultasp">Consultas Procedimientos</label>
                  </div>  
                  <div class="checkbox">
                    <label><input type="checkbox" name="copiaseg" value="copiaseg">Copia de Seguridad</label>
                  </div>
                </div>
                  </div>

                 
         
                  

        	   <div class="form-group">
            	<div class="col-sm-offset-4 col-sm-10">
          			<a href="usuario.php">
                <button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
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
  <div class="modal fade" id="moda_list_empl" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
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
        

 
<?php include("../pie_de_pagina.html"); ?>  
</body>
</html>