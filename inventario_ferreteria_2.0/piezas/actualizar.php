<?php 
ob_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Actualizar pieza dental</title>
<script src="../js/jQuery-2.1.4.min.js"></script>
    <script>
	function mensaje(){
	swal("REGISTRADO CON EXITO","", "success");
	}
	function mensaje2(){
	swal("ERROR EN EL REGISTRO","","error");
	}
	function mensaje3(){
	swal("ERROR EN EL REGISTRO","","error");
	}
	
	function errornombre(){
	swal("ERROR EN EL REGISTRO","el numero de pieza dental","error");
	}
	</script>

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
if(isset($_GET['errornombre'])){
	
	echo "<script>";
	echo "errornombre();";
	echo "</script>";
	}
if(!isset($_POST['enviando'])){

	$id=$_GET["id"];
	$estudiante=$base->query("SELECT * FROM pieza where id_pieza='$id'")->fetchAll(PDO::FETCH_OBJ);
	$nom=$estudiante[0]->nombre;
	$pieza=$estudiante[0]->pieza;
  $tipo=$estudiante[0]->tipo;
  	}
else {
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$pieza=$_POST["pie"];
	$tipo=$_POST["tipo"];
	$sql3="select * from pieza where pieza=:num and id_pieza<>:id";
		$resultado3=$base->prepare($sql3);
		$resultado3->execute(array(":num"=>$pieza, ":id"=>$id));
		
		
		if($resultado3->rowCount()>0){
		
		header("Location:actualizar.php?id=$id&errornombre");
		
		}
		 else{

	$sql="UPDATE pieza set nombre=:nom, pieza=:pie,tipo=:tip  where id_pieza=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":nom"=>$nom, ":pie"=>$pieza,":tip"=>$tipo, ":id"=>$id));
	header("Location:piezas.php?act");
		 }
		
	}
?>
  <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Pieza Dental</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
   
          <h1>ACTUALIZAR PIEZA DENTAL</h1>
          
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
                  <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $nom ?>"   autocomplete="off" required/>
                  </div>
                </div>
                
                   <div class="form-group">
                	<div class="col-md-offset-3 col-md-2">
                      <label for="pie" class="control-label">
                        N° PIEZA<span style="color:#F00">*</span>
                      </label>
                  	</div>
                  	<div class="col-md-4">
                  <input type="number" name="pie" id="pie" class="form-control" value="<?php echo $pieza ?>"  required/>
                  </div>
                </div>
                 <div class="form-group has-success">
                  <div class="col-md-offset-3 col-md-2">
                      <label for="tipo" class="control-label">
                        Tipo de Diente:<span style="color:#F00">*</span>
                      </label>
                    </div>
                    <div class="col-md-4">
                  <select id="tipo" name="tipo" class="form-control">
                    <?php if($tipo=="Permanente"): ?>
                    <option value="Permanente" selected="selected">Permanente</option>
                    <option value="Temporal">Temporal</option>
                    <?php else:?>
                    <option value="Temporal" selected="selected">Temporal</option>
                    <option value="Permanente" >Permanente</option>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>
  
          	<div class="col-md-offset-3 col-md-2">
          			<a href="piezas.php"><button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
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