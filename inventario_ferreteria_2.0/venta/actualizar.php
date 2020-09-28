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
<title>Actualizar producto</title>
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
	$estudiante=$base->query("SELECT tipo_producto.nombre as tipo, tipo_producto.id_tipo_producto, producto.nombre, producto.id_producto, precio, descripcion, cantidad, imagen FROM producto INNER JOIN tipo_producto on producto.id_tipo_producto=tipo_producto.id_tipo_producto where producto.id_producto='$id'")->fetchAll(PDO::FETCH_OBJ);
	$nom=$estudiante[0]->nombre;
	$precio=$estudiante[0]->precio;
	$descripcion=$estudiante[0]->descripcion;
	$tip=$estudiante[0]->tipo;
	$id_tip=$estudiante[0]->id_tipo_producto;
	$foto=$estudiante[0]->imagen;
	if($foto==""){
		$foto='sinfoto.png';
		}
	}
else {
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$precio=$_POST["prec"];
	$des=$_POST["des"];
	$tip=$_POST["tip"];
	

	if ($_FILES['foto']['name']!="") {
		$carpeta=$_SERVER['DOCUMENT_ROOT'] . '/inventario_ferreteria/img/';
		$image= addslashes(file_get_contents($_FILES['foto']['tmp_name']));
		$nombrefoto= $_FILES['foto']['name'];
		move_uploaded_file($_FILES["foto"]["tmp_name"], $carpeta . $_FILES["foto"]["name"]);
		$sql="UPDATE producto set nombre=:nom, precio=:prec, descripcion=:des, id_tipo_producto=:tip, imagen=:img where id_producto=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":nom"=>$nom, ":prec"=>$precio, ":des"=>$des, ":tip"=>$tip, ":img"=>$nombrefoto, ":id"=>$id));
	header("Location:producto.php?act=$id");
		}else{

	
	$sql="UPDATE producto set nombre=:nom, precio=:prec, descripcion=:des, id_tipo_producto=:tip where id_producto=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":nom"=>$nom, ":prec"=>$precio, ":des"=>$des, ":tip"=>$tip, ":id"=>$id));
	header("Location:producto.php?act=$id");
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
   
          <h1>ACTUALIZAR CLIENTE</h1>
          
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
                        <label for="tip" class="control-label">
                          TIPO DE PRODUCTO<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                 <select id="tip" name="tip" class="form-control"><option selected value="<?php echo $id_tip?>" required><?php echo $tip?></option>
<?php foreach($sql1 as $tip):?>
<option value="<?php echo $tip->id_tipo_producto ?>"><?php echo $tip->nombre ?></option>
<?php
endforeach;
?></select>
</div> 
                </div>
                
                      <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="des" class="control-label">
                          DESCRIPCION<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <textarea name="des" id="des" class="form-control" autocomplete="off"  required/><?php echo $descripcion?></textarea>
                    </div>
                  </div>

				
                   <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="ocu" class="control-label">
                          FOTO
                        </label>
                    </div>
                    <div class="col-md-4">
                     <img src="../img/<?php echo $foto ?>" alt="imagen" width="200px" height="200px" class="img-thumbnail">
                   <input type="file" class="form-control" name="foto" id="foto"/>
                   </div>
                  </div>
                  

          	<div class="col-md-offset-3 col-md-2">
          			<a href="producto.php"><button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
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