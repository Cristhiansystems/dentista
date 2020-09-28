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

  $lista_ext = array("CH","LP","CB","OR","PO","TJ","SC","BE","PA");

	$id=$_GET["id"];
	$paciente=$base->query("SELECT * FROM tbl_pacientes where id_paciente='$id'")->fetchAll(PDO::FETCH_OBJ);

$sqlmedicos=("SELECT id_empleado, concat(nombre,' ',apellido_paterno,' ',apellido_materno) as empleado FROM tbl_empleados where tipo_empleado='Medico'");
$medicos=$base->prepare($sqlmedicos);
$medicos->execute();



$sqlaseguradoras=("SELECT id_aseguradora,nombre FROM tbl_aseguradoras");
$aseguradoras=$base->prepare($sqlaseguradoras);
$aseguradoras->execute();



	$codp=$paciente[0]->codigo_paciente;
  $nom=$paciente[0]->nombre;
	$apep=$paciente[0]->apellido_paterno;
	$apem=$paciente[0]->apellido_materno;
  $cip=$paciente[0]->ci;
  $ext=$paciente[0]->extension;
  $fnac=$paciente[0]->fecha_nacimiento;
	$antp=$paciente[0]->antecedente_patologico;
  $ema=$paciente[0]->email;
  $fechpv=$paciente[0]->fecha_primera_visita;
	$cel=$paciente[0]->celular;

  $idme=$paciente[0]->id_medico;
  $idas=$paciente[0]->id_aseguradora;
	}
else {
	$id=$_POST["id"];
	$nom=$_POST["nom"];
	$apep=$_POST["apep"];
	$apem=$_POST["apem"];
  $ci=$_POST["ci"];
  $exts=$_POST["ext"];
  $fnac=$_POST["fnac"];
  $antp=$_POST["antp"];
	$ema=$_POST["correl"];
  $fechpv=$_POST["fechpv"];	
  $cel=$_POST["cel"];
  $idmed=$_POST["med"];
  $idaseg=$_POST["aseg"];

	
	$sql="UPDATE tbl_pacientes set nombre=:nom, apellido_paterno=:apep, apellido_materno=:apem,ci=:ci, extension=:ext, fecha_nacimiento=:fnac, antecedente_patologico=:antp, email=:ema, celular=:cel, fecha_primera_visita=:fechpv, id_medico=:idmed,id_aseguradora=:idaseg where id_paciente=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(
    ":nom"=>$nom, 
    ":apep"=>$apep, 
    ":apem"=>$apem, 
    ":ci"=>$ci, 
    ":ext"=>$exts,
    ":fnac"=>$fnac,
    ":antp"=>$antp,
    ":ema"=>$ema, 
    ":fechpv"=>$fechpv,
     ":cel"=>$cel,
     ":idmed"=>$idmed,
     ":idaseg"=>$idaseg,
    ":id"=>$id
    )
  );
	header("Location:paciente.php?act=$id");
		
	}

?>
  <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema Dental</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
   
          <h1>ACTUALIZAR PACIENTE</h1>
          
          <form  name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="form-horizontal" role="form" >
          
          
            <div class="field-wrap">
              <input type="hidden" name="id" id="id" required value="<?php echo $id?>"/>
            </div>
            
            
                  <div class="form-group">
                  <div class="col-md-offset-3 col-md-2">
                      <label for="nom" class="control-label">
                        CI<span style="color:#F00">*</span>
                      </label>
                  </div>
                    <div class="col-xs-9 col-sm-9 col-md-3">
                  <input type="text" name="ci" id="ci" class="form-control" value="<?php echo $cip ?>" autocomplete="off" required/>
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
                          CELULAR<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="number" name="cel" id="cel" class="form-control" value="<?php echo $cel ?>" autocomplete="off" required/>
                    </div>
                  </div>

               <div class="form-group has-success">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="cel" class="control-label">
                          CODIGO PACIENTE<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" readonly name="codp" id="codp" class="form-control" value="<?php echo $codp ?>" autocomplete="off" required/>
                    </div>
               </div>

                   <div class="form-group">
               <div class="col-md-offset-3 col-md-2">
                      <label for="ci" class="control-label">
                        ANTECEDENTE PATOLOGICO<span style="color:#F00">*</span>
                      </label>
                     </div>
                     <div class="col-md-4">
                      <input type="text" name="antp" id="antp" class="form-control" value="<?php echo $antp ?>"   autocomplete="off" required/>
                        <span style="color:#F00" id="repci"></span>
                        </div>
               </div>
                 
                   <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="cel" class="control-label">
                          CORREO ELECTRONICO<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="text" name="correl" id="correl" class="form-control" value="<?php echo $ema ?>" autocomplete="off" required/>
                    </div>
                  </div>

                   <div class="form-group">
                    <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          FECHA PRIMERA VISITA
                        </label>
                    </div>
                    <div class="col-md-4">
                    <input type="date" name="fechpv" id="fechpv" class="form-control" value="<?php echo $fechpv ?>" autocomplete="off"/>
                    </div>
                  </div>
                

                   <div class="form-group">
                     <div class="col-md-offset-3 col-md-2">
                        <label for="apem" class="control-label">
                          MEDICO
                        </label>
                    </div>
              <div class="col-md-4">
                <select class="form-control" name="med" id="med" >

                  <?php while ($fila_medico= $medicos->fetch(PDO::FETCH_ASSOC))  {
                        if ($fila_medico['id_empleado'] == $idme){
                        ?>
                  <option value="<?php echo $fila_medico['id_empleado'] ?>" selected="selected"><?php echo $fila_medico['empleado'] ?></option>
                        <?php
                        }else{
                          ?>
                          <option value="<?php echo $fila_medico['id_empleado'] ?> "><?php echo $fila_medico['empleado'] ?></option>

                  <?php
                       }}?>
                    
                      
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
                <select class="form-control" name="aseg" id="aseg" >
                  <?php if("0"==$idas){
                        ?>
                        <option value="0" selected>Ninguno</option>
                        <?php
                        }else{

                          ?>
                          <option value="0" selected>Ninguno</option>

                        <?php }
                        while ($fila_aseguradora= $aseguradoras->fetch(PDO::FETCH_ASSOC))  {
                       if ($fila_aseguradora['id_aseguradora'] == $idas){
                            ?>
                            <option value="<?php echo $fila_aseguradora['id_aseguradora'] ?>" selected="selected"><?php echo $fila_aseguradora['nombre'] ?></option>
                        <?php
                        }else {
                          ?>
                          <option value="<?php echo $fila_aseguradora['id_aseguradora'] ?> "><?php echo $fila_aseguradora['nombre'] ?></option>
                          <?php
                       }
                     }?>
                    
                      
                </select>
                    </div>
                  </div>


        	   <div class="form-group">
          	<div class="col-md-offset-5 col-xs-3 col-sm-2 col-md-1">
          			<a href="estudiantes.php"><button type="button" name="volver" class="btn btn-danger">VOLVER</button></a>
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