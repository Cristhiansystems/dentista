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
<title>Actualizar cliente</title>
<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>

    <link rel="stylesheet" href="../css/font-awesome.css">
    <link rel="stylesheet" href="../css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/_all-skins.min.css">
    <link rel="stylesheet" href="../css/sweetalert.css">
    <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../img/favicon.ico">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/sweetalert.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php
include("../header.php");
include("../conexion.php");
if(!isset($_POST['enviando'])){
  $lista_ext = array("CH","LP","CB","OR","PO","TJ","SC","BE","PA");
	$id=$_GET["id"];
	$empleado=$base->query("SELECT * FROM tbl_empleados where id_empleado='$id'")->fetchAll(PDO::FETCH_OBJ);
	$nom=$empleado[0]->nombre;
	$apep=$empleado[0]->apellido_paterno;
	$apem=$empleado[0]->apellido_materno;
  $ali=$empleado[0]->alias;
  $fnac=$empleado[0]->fecha_nacimiento;
	$ci=$empleado[0]->ci;
  $ext=$empleado[0]->extension;
  $dir=$empleado[0]->direccion;
  $fot=$empleado[0]->foto;
	$cel=$empleado[0]->celular;
  $tipo=$empleado[0]->grupo_sanguineo;
  $temp=$empleado[0]->tipo_empleado;
  $login=$empleado[0]->login;
	}
else {
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$apep=$_POST["apep"];
	$apem=$_POST["apem"];
  $ali=$_POST["ali"];
  $fnac=$_POST["fnac"];
	$ci=$_POST["ci"];
  $exts=$_POST["ext"];
  $dir=$_POST["dir"];
  $sang=$_POST["tipo"];
  $foto_ruta=$_POST["fotsds"];
	
  $cel=$_POST["cel"];
  $temp=$_POST["temp"];
  $log=$_POST["log"];
$clav=$_POST["clav"];






    $imgFile = $_FILES['fot']['name'];
    $tmp_dir = $_FILES['fot']['tmp_name'];
    $imgSize = $_FILES['fot']['size'];
           
    if($imgFile)
    {
      $upload_dir = 'imagenes/'; // upload directory 
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
      $userpic = rand(1000,1000000).".".$imgExt;
      if(in_array($imgExt, $valid_extensions))
      {     
        if($imgSize < 1000000)
        {
          unlink($foto_ruta);
          move_uploaded_file($tmp_dir, $upload_dir. $userpic);
        }
        else
        {
          $errMSG = "El archivo no puede superar 1MB";
        }
      }
      else
      {
        $errMSG = "Solo archivos JPG, JPEG, PNG & GIF .";    
      } 
    }
    else
    {
      // if no image selected the old image remain as it is.
      $userpic = $foto_ruta; // old image from database
    } 
         
	
 if(!isset($errMSG))
    {

	
	$sql="UPDATE tbl_empleados set nombre=:nom, apellido_paterno=:apep, apellido_materno=:apem, alias=:ali, fecha_nacimiento=:fnac, ci=:ci,extension=:ext, celular=:cel, grupo_sanguineo=:sang,direccion=:dir, foto=:fot, celular=:cel, tipo_empleado=:temp,login=:log,clave=:clav where id_empleado=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(
    ":nom"=>$nom, 
    ":apep"=>$apep, 
    ":apem"=>$apem, 
    ":ali"=>$ali,
    ":fnac"=>$fnac,
    ":ci"=>$ci, 
    ":ext"=>$exts,
    ":dir"=>$dir,
    ":fot"=> $upload_dir.$userpic,
     ":cel"=>$cel,
     ":sang"=>$sang,
     ":temp"=>$temp,
     ":log"=>$log,
     ":clav"=>$clav,

    ":id"=>$id
    )
  );
	header("Location:empleado.php?act=$id");
		
	}else{$errMSG = "Sorry Data Could Not Updated !";}}
?>
  <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Empleados</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
   
          <h1>ACTUALIZAR EMPLEADO</h1>
          
          <form  name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="form-horizontal" role="form" >
          
          
            <div class="field-wrap">
              <input type="hidden" name="id" id="id" required value="<?php echo $id?>"/>
            </div>
            
            
                
               <div class="form-group">
                 	<div class="col-md-offset-3 col-md-2">
                      <label for="ci" class="control-label">
                        CI<span style="color:#F00">*</span>
                      </label>
                     </div>
                     <div class="col-xs-9 col-sm-9 col-md-3">
                  		<input type="number" name="ci" id="ci" class="form-control" value="<?php echo $ci ?>"   autocomplete="off" required/>
                        <span style="color:#F00" id="repci"></span>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-1">
                <select class="form-control" name="ext" id="ext" >

                  <?php foreach ($lista_ext as $value) {
                    
                  
                        if ($value == $ext){
                        ?>
                  <option value="<?php echo  $ext ?>" selected="selected"><?php echo  $ext; ?></option>
                        <?php
                        }else{
                          ?>
                          <option value="<?php echo $value ?> "><?php echo $value; ?></option>

                  <?php
                       }}?>
                    
                      
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
                  <input type="text" name="nom" id="nom" class="form-control" value="<?php echo $nom ?>" autocomplete="off" required/>
                  </div>
                </div>
         
                   <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                    <label for="apep" class="control-label">
                      	APELLIDO PATERNO<span style="color:#F00">*</span>
                    </label>
                    </div>
                    	<div class="col-md-4">
                    <input type="text" name="apep" id="apep" class="form-control" value="<?php echo $apep ?>" autocomplete="off" required/>
                    	</div>
                  </div>
                  
                   <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          APELLIDO MATERNO<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="apem" id="apem" class="form-control" value="<?php echo $apem ?>" autocomplete="off" required/>
                    </div>
                  </div>

                   <div class="form-group">
                     <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          TIPO DE EMPLEADO
                        </label>
                    </div>
                    <div class="col-md-4">
                     <select class="form-control" name="temp" id="temp" >
                       <?php switch ($temp) {
                         case "Administrativo":
                           ?>
                           <option value="0">Seleccionar...</option>
                           <option value="Administrativo" selected="selected">Administrativo</option>
                             <option value="Recepcionista" >Recepcionista</option>
                           <option value="Asistente">Asistente</option>
                             <option value="Medico">Medico</option>
                           <?php
                           break;
                         case "Asistente":
                         ?>
                         <option value="0">Seleccionar...</option>
                           <option value="Administrativo" >Administrativo</option>
                             <option value="Recepcionista">Recepcionista</option>
                           <option value="Asistente" selected="selected">Asistente</option>
                             <option value="Medico">Medico</option>
                         <?php
                         break;
                         case "Medico":
                           ?>
                                 <option value="0">Seleccionar...</option>
                           <option value="Administrativo" >Administrativo</option>
                             <option value="Recepcionista" >Recepcionista</option>
                           <option value="Asistente" >Asistente</option>
                             <option value="Medico" selected="selected">Medico</option>
                           <?php
                           break;
                             case "Recepcionista":
                           ?>
                                 <option value="0">Seleccionar...</option>
                           <option value="Administrativo" >Administrativo</option>
                           <option value="Recepcionista" selected="selected">Recepcionista</option>
                           <option value="Asistente" >Asistente</option>
                             <option value="Medico" >Medico</option>
                             
                           <?php
                           break;
                         default:
                           # code...
                           break;
                       }?>
                    
                      
                    </select>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="cel" class="control-label">
                          ALIAS<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="ali" id="ali" class="form-control" value="<?php echo $ali ?>" autocomplete="off" required/>
                    </div>
                  </div>
                   

                   <div class="form-group">
                  	<div class="col-md-offset-3 col-md-2">
                        <label for="cel" class="control-label">
                          CELULAR<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="number" name="cel" id="cel" class="form-control" value="<?php echo $cel ?>" autocomplete="off" required/>
                    </div>
                  </div>
                  <div class="form-group has-success">
                  <div class="col-md-offset-3 col-md-2">
                      <label for="tipo" class="control-label">
                        Grupo Sanguineo:<span style="color:#F00">*</span>
                      </label>
                    </div>
                    <div class="col-md-4">
                  <select id="tipo" name="tipo" class="form-control">
                    <?php if($tipo=="A+"): ?>
                    <option value="A+" selected="selected" >A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                   
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">0-</option>  
                    <?php elseif($tipo=="A-"):?>
                   <option value="A+" >A+</option>
                    <option value="A-" selected="selected" >A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">0-</option>
                      <?php elseif($tipo=="B+"):?>
                   <option value="A+" >A+</option>
                    <option value="A-" >A-</option>
                    <option value="B+"selected="selected">B+</option>
                    <option value="B-">B-</option>
                   
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">0-</option>
                      <?php elseif($tipo=="B-"):?>
                   <option value="A+" >A+</option>
                    <option value="A-"  >A-</option>
                    <option value="B+">B+</option>
                    <option value="B-" selected="selected">B-</option>
                   
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">0-</option>
                      <?php elseif($tipo=="AB+"):?>
                   <option value="A+" >A+</option>
                    <option value="A-" >A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                 
                    <option value="AB+" selected="selected">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">0-</option>
                      <?php elseif($tipo=="AB-"):?>
                   <option value="A+" >A+</option>
                    <option value="A-" >A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                   
                    <option value="AB+">AB+</option>
                    <option value="AB-" selected="selected">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">0-</option>
                      <?php elseif($tipo=="O-"):?>
                   <option value="A+" >A+</option>
                    <option value="A-"  >A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+" selected="selected">O+</option>
                    <option value="O-">0-</option>
                      <?php elseif($tipo=="O+"):?>
                   <option value="A+" >A+</option>
                    <option value="A-"  >A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                   
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-" selected="selected">O-</option>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>



                   <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="cel" class="control-label">
                          FECHA DE NACIMIENTO<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="date" name="fnac" id="fnac" class="form-control" value="<?php echo $fnac ?>" autocomplete="off" required/>
                    </div>
                  </div>
                   <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="cel" class="control-label">
                          DIRECCION<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="dir" id="dir" class="form-control" value="<?php echo $dir ?>" autocomplete="off" required/>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          FOTO
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="file" name="fot" id="fot" class="form-control"  autocomplete="off"/>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          LOGIN
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="log" id="log" class="form-control" value="<?php echo $login ?>" autocomplete="off"/>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                         CLAVE
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="clav" id="clav" class="form-control" autocomplete="off"/>
                    </div>
                  </div>

                   <div class="form-group">
                   
                    <div class="col-md-4">
                    <input type="hidden" name="fotsds" id="fotsdsd" class="form-control" value="<?php echo $fot ?>" autocomplete="off"/>
                    </div>
                  </div>


                  

        	<div class="form-group">
          	   <div class="col-md-offset-5 col-xs-3 col-sm-2 col-md-1">
          			<a href="empleados.php"><button type="button" name="volver" class="btn btn-danger">VOLVER</button></a>
                    </div>

        	   		<div class="col-xs-9 col-sm-9 col-md-1">
          			<button type="submit" name="enviando" class="btn btn-primary">ACTUALIZAR</button>
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