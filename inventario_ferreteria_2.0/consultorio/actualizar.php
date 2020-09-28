<?php 
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Actualizar consultorio</title>
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
if(!isset($_POST['enviando'])){

	$id=$_GET["id"];
	$estudiante=$base->query("SELECT cons.nombre, ag.nombre as agencia, ag.id_agencia FROM tbl_consultorios cons INNER JOIN tbl_agencias ag on cons.id_agencia=cons.id_agencia  where cons.id_consultorio='$id'")->fetchAll(PDO::FETCH_OBJ);
	$nom=$estudiante[0]->nombre;
	$agencia=$estudiante[0]->agencia;
	$id_agencia=$estudiante[0]->id_agencia;
	$sql1=$base->query("Select * From tbl_agencias where estado='activo' order by nombre")->fetchAll(PDO::FETCH_OBJ);
	}
else {
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$idag=$_POST["age"];
	

	

	
	$sql="UPDATE tbl_consultorios set  nombre=:nom,  id_agencia=:idag  where id_consultorio=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array( ":nom"=>$nom,  ":idag"=>$idag, ":id"=>$id));
	header("Location:consultorio.php?act");
		
	}
?>
  <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Consultorios</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
   
          <h1>ACTUALIZAR AGENCIA</h1>
          
          <form  name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="form-horizontal" role="form" >
          
          
            <div class="field-wrap">
              <input type="hidden" name="id" id="id" required value="<?php echo $id?>"/>
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
                        <label for="esp" class="control-label">
                          AGENCIA<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                 <select id="age" name="age" class="form-control"><option selected value="<?php echo $id_agencia?>" required><?php echo $agencia?></option>
<?php foreach($sql1 as $tip):?>
<option value="<?php echo $tip->id_agencia ?>"><?php echo $tip->agencia ?></option>
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