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
<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>

<script>

$(document).ready(function(){
			        mostrarAseguradoras();
              mostrarMedicos();





   
});

					   
				
  function mostrarAseguradoras(){
  $.ajax({
    type: "GET",
    url: 'aseguradoras.php', 
    dataType: "json",
    success: function(data){
      $.each(data,function(key, registro) {
        $("#aseg").append('<option value='+registro.id_aseguradora+'>'+registro.nombre+'</option>');
      });        
    },
    error: function(data) {
      alert('error');
    }
  })


}
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

$(function(){

$('#apep').on('keyup',function(){

    var apellido = $('#apep').val();
    if(apellido ==''){
        $('#codpac').val('');

    }else{


    var letra_apellido=apellido.charAt(0)
    letra_apellido=letra_apellido.toUpperCase();
    //alert(letra_apellido);
    var url = 'contar_registros.php';
    $.ajax({
    type:'POST',
    url:url,
    data:'dato='+letra_apellido,
    success: function(datos){
        
    var str = "" + datos;
    var pad = "0000";
    var ans = pad.substring(0, pad.length - str.length) + str;
    var cod_paciente=letra_apellido+ans;
      $('#codpac').val(cod_paciente);
    } 
  });
  return false;

} });
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
    
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../img/favicon.ico">
    <script src="../js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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
                  <h3 class="box-title">Pacientes</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                     <h1>REGISTRAR PACIENTE</h1>
          
          <form action="registroPHP.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
          <label class="control-label"> <span style="color:#F00">* Campos obligatorios</span></label>
          
          		
          		

                <div class="form-group">
                  <div class="col-md-offset-3 col-md-2">
                      <label for="nom" class="control-label">
                        CI<span style="color:#F00">*</span>
                      </label>
                  </div>
                    <div class="col-xs-9 col-sm-9 col-md-3">
                  <input type="text" name="ci" id="ci" class="form-control" autocomplete="off" required/>
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
                  <input type="text" name="nom" id="nom" class="form-control" autocomplete="off" required/>
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
                          FECHA NACIMIENTO  
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="date" name="fnac" id="fnac" class="form-control" autocomplete="off"/>
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

                <div class="form-group">
                  <div class="col-md-offset-3 col-md-2">
                      <label for="ci" class="control-label">
                        Codigo Paciente<span style="color:#F00">*</span>
                      </label>
                     </div>
                     <div class="col-md-4">
                      <input type="text" name="codpac" id="codpac" class="form-control"  autocomplete="off" required/>
                        <span style="color:#F00" id="repci"></span>
                        </div>
                </div>

                  <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          Antecedente Patológico:
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="antpat" id="antpat" class="form-control" autocomplete="off"/>
                    </div>
                  </div>

                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-2">
                        <label for="corele" class="control-label">
                          CORREO ELECTRONICO
                        </label>
                      </div>
                      <div class="col-md-4">
                        <input type="text" name="corele" id="corele" class="form-control" autocomplete="off"/>
                      </div>
                    </div>
                  <div class="form-group">
                      <div class="col-md-offset-3 col-md-2">
                        <label for="fprim" class="control-label">
                        FECHA PRIMERA VISITA
                      </label>
                      </div>

                      <div class="col-md-4">
                          <input type="date" name="fprimvis" id="fprimvis" class="form-control" autocomplete="off" >
                      </div>
                                        </div>


                 

                  <div class="form-group">
                     <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          MEDICO
                        </label>
                    </div>
                    <div class="col-md-4">
                     <select class="form-control" name="med" id="med">
                        <option value="#">Seleccionar...</option>
                    </select>
                    </div>
                  </div>
                    <div class="form-group">
                     <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          SEGURO MÉDICO
                        </label>
                    </div>
                    <div class="col-md-4">
                     <select class="form-control" name="aseg" id="aseg">
                        <option value="0">Ninguno</option>
                    </select>
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
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->


        </section><!-- /.content -->
        </div>
        

 
<?php include("../pie_de_pagina.html"); ?>  
</body>
</html>