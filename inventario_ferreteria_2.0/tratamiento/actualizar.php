<?php 
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Actualizar tratamiento</title>
<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>
    <script>
		$(document).ready(function(){
			$('.selesp').select2();
				$("#cod").on("keyup", function() {
    			cod=$("#cod").val();
    			id=$("#id").val();
    			nom=$("#nom").val();
				tipo="codigo";
				$.post("getCodigoact.php", {cod: cod,nom:nom, tipo:tipo, id:id }, function(data){
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
    			id=$("#id").val();
				nom=$("#nom").val();
				tipo="nombre";
				$.post("getCodigoact.php", {cod: cod, nom:nom, tipo:tipo, id:id }, function(data){
									
										
									$("#infonom").html(data);
									if(data!=""){
										$("#enviando").attr('disabled','disabled');
									}else{
										$("#enviando").removeAttr('disabled');
									}
									
								
							});
					
				});
				});
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
if(!isset($_POST['enviando'])){

	$id=$_GET["id"];
	$estudiante=$base->query("SELECT especialidad.nombre as especialidad,  especialidad.id_especialidad, tratamiento.nombre, tratamiento.id_tratamiento, tratamiento.codigo, precio, seguro FROM tratamiento INNER JOIN especialidad on tratamiento.id_especialidad=especialidad.id_especialidad  where tratamiento.id_tratamiento='$id'")->fetchAll(PDO::FETCH_OBJ);
	$nom=$estudiante[0]->nombre;
	$codigo=$estudiante[0]->codigo;
	$precio=$estudiante[0]->precio;
	$especialidad=$estudiante[0]->especialidad;
	$id_esp=$estudiante[0]->id_especialidad;
	$seg=$estudiante[0]->seguro;
	$sql1=$base->query("Select * From especialidad where estado='activo' order by nombre")->fetchAll(PDO::FETCH_OBJ);
	}
else {
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$cod=$_POST["cod"];
	$precio=$_POST["prec"];
	$esp=$_POST["esp"];
	$seg=$_POST["seg"];
	

	

	
	$sql="UPDATE tratamiento set codigo=:cod, nombre=:nom, precio=:prec, seguro=:seg, id_especialidad=:esp  where id_tratamiento=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":cod"=>$cod, ":nom"=>$nom, ":prec"=>$precio, ":seg"=>$seg, ":esp"=>$esp, ":id"=>$id));
	header("Location:tratamiento.php?act");
		
	}
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
   
          <h1>ACTUALIZAR PRODUCTO</h1>
          
          <form  name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="form-horizontal" role="form" >
          
          
            <div class="field-wrap">
              <input type="hidden" name="id" id="id" required value="<?php echo $id?>"/>
            </div>
            
              <div class="form-group">
                	<div class="col-md-offset-3 col-md-2">
                      <label for="cod" class="control-label">
                        CODIGO<span style="color:#F00">*</span>
                      </label>
                  </div>
                  	<div class="col-md-4">
                  <input type="text" name="cod" id="cod" class="form-control" autocomplete="off" value="<?php echo $codigo?>" required/>
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
                  <input type="text" name="nom" id="nom" class="form-control" autocomplete="off" value="<?php echo $nom?>" required/>
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
                    <input type="number" name="prec" id="prec" class="form-control" autocomplete="off" value="<?php echo $precio?>" required/>
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
                 <option value="<?php echo $seg ?>" required><?php echo $seg ?></option>
                 <option value="Si" required>Si</option>
                 <option value="No" required>No</option>
</select>
</div> 
                </div>

                  <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="esp" class="control-label">
                          ESPECIALIDAD<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                 <select class="form-control selesp" id="esp[]" name="esp[]"  multiple>
                 
                    <?php foreach($sql1 as $tip):?>
                        <option selected="" value="<?php echo $tip->id_especialidad ?>"><?php echo $tip->nombre ?></option>
                    <?php
endforeach;
?></select>
</div> 
                </div>
               
                  

          	<div class="col-md-offset-3 col-md-2">
          			<a href="tratamiento.php"><button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
                    </div>
        	   		<div class="col-md-2">
          			<button type="submit" name="enviando" class="btn btn-primary"/>ACTUALIZAR</button>
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