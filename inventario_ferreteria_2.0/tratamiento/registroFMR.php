<?php 
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro tratamiento</title>

<script src="../js/jQuery-2.1.4.min.js"></script>
  
    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>
   

<script>

$(document).ready(function(){
  $('.selesp').select2();
			
				$("#cod").on("keyup", function() {
    			cod=$("#cod").val();
    			nom=$("#nom").val();
				
				$.post("getCodigo.php", {cod: cod,nom:nom }, function(data){
									$("#info").html(data);
									if(data!=""){
										$("#enviando").attr('disabled','disabled');
									}else{
										$("#enviando").removeAttr('disabled');
									}
									
									
									
								
							});
					
				});
	
				$("#nom").on("keyup", function() {
    			cod=$("#cod").val();
				nom=$("#nom").val();
				$.post("getCodigo.php", {cod: cod, nom:nom }, function(data){
									
										
									$("#infonom").html(data);
									if(data!=""){
										$("#enviando").attr('disabled','disabled');
									}else{
										$("#enviando").removeAttr('disabled');
									}
									
								
							});
					
				});
				});
	
function mensaje(){
	swal("producto2 REGISTRADO CON EXITO","", "success");
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
  
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
   
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../img/favicon.ico">
   
  
<script src="../js/sweetalert.min.js"></script>
 <script src="../js/select2.min.js"></script>

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
	
	if(isset($_GET['errornombre'])){
	
	echo "<script>";
	echo "errornombre();";
	echo "</script>";
	}


	$sql1=$base->query("Select * From especialidad where estado='activo' order by nombre")->fetchAll(PDO::FETCH_OBJ);
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
		                     <h1>REGISTRAR TRATAMIENTO</h1>
          
          <form action="registroPHP.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
          <label class="control-label"> <span style="color:#F00">* Campos obligatorios</span></label>
          <div class="row">
                  
                    <div class="form-group">
                	<div class="col-md-offset-3 col-md-2">
                      <label for="cod" class="control-label">
                        CODIGO<span style="color:#F00">*</span>
                      </label>
                  </div>
                  	<div class="col-md-4">
                  <input type="text" name="cod" id="cod" class="form-control" autocomplete="off" required/>
                  <span id="info"></span>
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
                  <span id="infonom"></span>
                  </div>
                </div>
         
                   <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                    <label for="prec" class="control-label">
                      	PRECIO<span style="color:#F00">*</span>
                    </label>
                    </div>
                    	<div class="col-md-4">
                    <input type="number" name="prec" id="prec" class="form-control" autocomplete="off" required step = "any"/>
                    	</div>
                  </div>
                  

                  <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="seg" class="control-label">
                         ¿CUBRE SEGURO?<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                 <select id="seg" name="seg" class="form-control">
                 <option value="Si" required>Si</option>
                 <option value="No" required>No</option>
</select>
</div> 
                </div>

                  <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="tip" class="control-label">
                         ESPECIALIDAD<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                 <select class="form-control selesp" id="esp[]" name="esp[]"  multiple>
<?php foreach($sql1 as $tip):?>
<option value="<?php echo $tip->id_especialidad ?>"><?php echo $tip->nombre ?></option>
<?php
endforeach;
?></select>
</div> 
                </div>
                

        	   
         	<div class="col-md-offset-3 col-md-2">
          			<a href="tratamiento.php"><button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
                    </div>
        	   		<div class="col-md-2">
          			<button type="submit" name="enviando" id="enviando" class="btn btn-primary"/>REGISTRAR</button>
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