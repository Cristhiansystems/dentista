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
<title>Actualizar Usuario</title>
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
<script>

$(document).ready(function(){
     // mostrarAgencias();
        
        });

  
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

  
</script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<?php
include("../header.php");
include("../conexion.php");
if(!isset($_POST['enviando'])){

	$id=$_GET["id"];
	$estudiante=$base->query("SELECT agen.nombre as agencia,concat_ws(' ',emp.nombre,emp.apellido_paterno,emp.apellido_materno) as empleado,usu.tipo_usuario,usu.menu_mantenimiento,usu.menu_grupo_dental,usu.menu_citas,usu.menu_caja,usu.menu_procesos_dentales,usu.menu_consultas,usu.menu_seguridad, agen.id_agencia, emp.id_empleado FROM tbl_usuarios usu inner join tbl_empleados emp on usu.id_empleado=emp.id_empleado inner join tbl_agencias agen on usu.id_agencia=agen.id_agencia  where id_usuario='$id'")->fetchAll(PDO::FETCH_OBJ);

  $sqlagencias=("SELECT id_agencia, nombre FROM tbl_agencias ");
  $agencias=$base->prepare($sqlagencias);
  $agencias->execute();

	$agencia=$estudiante[0]->agencia;
  $empleado=$estudiante[0]->empleado;
  $tipo_usuario=$estudiante[0]->tipo_usuario;
  $menu_mant=$estudiante[0]->menu_mantenimiento;
  $menu_grup=$estudiante[0]->menu_grupo_dental;
  $menu_cit=$estudiante[0]->menu_citas;
  $menu_caja=$estudiante[0]->menu_caja;
  $menu_proc_dent=$estudiante[0]->menu_procesos_dentales;
  $menu_cons=$estudiante[0]->menu_consultas;
  $menu_seg=$estudiante[0]->menu_seguridad;
  $id_agencia=$estudiante[0]->id_agencia;
  $id_empleado=$estudiante[0]->id_empleado;

	}
else {
	$id=$_POST["id"];
	$id_agen=$_POST["agen"];
$id_emp=$_POST["idemp"];
$bool_mant;
$bool_grup_dent;
$bool_cit;
$bool_caja;
$bool_proc_dent;
$bool_consul;
$bool_segur;

if (isset($_POST["mantenimiento"])) {
   $bool_mant=true;
} else {
   $bool_mant=false;
}
if (isset($_POST["grupodental"])) {
   $bool_grup_dent=true;
} else {
   $bool_grup_dent=false;
}
if (isset($_POST["citas"])) {
   $bool_cit=true;
} else {
   $bool_cit=false;
}
if (isset($_POST["caja"])) {
   $bool_caja=true;
} else {
   $bool_caja=false;
}
if (isset($_POST["procesosd"])) {
   $bool_proc_dent=true;
} else {
   $bool_proc_dent=false;
}
if (isset($_POST["consultasp"])) {
   $bool_consul=true;
} else {
   $bool_consul=false;
}
if (isset($_POST["copiaseg"])) {
   $bool_segur=true;
} else {
   $bool_segur=false;
}

$tip_usu=$_POST["tipousu"];


	$sql="UPDATE tbl_usuarios set tipo_usuario=:tip, menu_mantenimiento=:menman, menu_grupo_dental=:mengr, menu_citas=:mencit, menu_caja=:mencaj, menu_procesos_dentales=:menpro, menu_consultas=:mencon ,menu_seguridad=:menseg ,id_agencia=:idage, id_empleado=:idemp where id_usuario=:id";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":tip"=>$tip_usu,  ":menman"=>$bool_mant, ":mengr"=>$bool_grup_dent, ":mencit"=>$bool_cit, ":mencaj"=>$bool_caja, ":menpro"=>$bool_proc_dent, ":mencon"=>$bool_consul, ":menseg"=>$bool_segur,":idage"=>$id_agen,":idemp"=>$id_emp,":id"=>$id));
	header("Location:usuario.php?act=$id");
		
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
   
          <h1>ACTUALIZAR USUARIO</h1>
          
          <form  name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="form-horizontal" role="form" >
          
          
            <div class="field-wrap">
              <input type="hidden" name="id" id="id" required value="<?php echo $id?>"/>
            </div>
            
            
                <div class="form-group">
                     <div class="col-md-offset-3 col-md-2 col-sm-4">
                        <label for="apem" class="control-label">
                          Agencia:
                        </label>
                    </div>
                    <div class="col-md-4 ">
                     <select class="form-control" name="agen" id="agen">
                       <?php while ($fila_agencia= $agencias->fetch(PDO::FETCH_ASSOC))  {
                        if ($fila_agencia['id_agencia'] == $id_agencia){
                        ?>
                  <option value="<?php echo $fila_agencia['id_agencia'] ?>" selected="selected"><?php echo $fila_agencia['nombre'] ?></option>
                        <?php
                        }else{
                          ?>
                          <option value="<?php echo $fila_agencia['id_agencia'] ?> "><?php echo $fila_agencia['nombre'] ?></option>

                  <?php
                       }}?>
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
                  <input type="text" class="form-control" name="empleado" id="empleado"  value='<?php echo $empleado ?>' required>
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
                      <?php if($tipo_usuario=='Administrador') :?>
                        <option value="Administrador" selected="selected">Administrador</option>
                        <option value="Empleado">Empleado</option>
                         <?php else:?> 
                           <option value="Administrador">Administrador</option>
                        <option value="Empleado" selected="selected">Empleado</option>
                           <?php endif;?> 
                    </select>
                    </div>
                  </div>

                  <input type="hidden" name="idemp" id="idemp" value='<?php echo $id_empleado ?>'>
                     <div class="form-group ">
                      
                           <div class=" col-md-2 col-md-offset-3 ">
                  <label class="heading">Seleccione los permisos:</label>
                      </div>
                      <div class="col-md-3">
                <?php if($menu_mant==1):?>
                  <div class="checkbox">
                    <label><input type="checkbox" checked="true" name="mantenimiento" value="mantenimiento">Mantenimiento</label>
                  </div>
                <?php else:?>
                     <div class="checkbox">
                    <label><input type="checkbox"  name="mantenimiento" value="mantenimiento">Mantenimiento</label>
                  </div>
                <?php endif;?>

                <?php if($menu_grup==1):?>
                  <div class="checkbox"> 
                    <label><input type="checkbox" checked="true" name="grupodental" value="grupodental">Grupo Dental</label>
                  </div>
                 <?php else:?>
                  <div class="checkbox"> 
                    <label><input type="checkbox" name="grupodental" value="grupodental">Grupo Dental</label>
                  </div>
                 <?php endif;?>

                 <?php if($menu_cit==1):?>
                  <div class="checkbox">
                    <label><input type="checkbox" checked="true" name="citas" value="citas">Citas</label>
                  </div> 
                  <?php else:?>
                   <div class="checkbox">
                    <label><input type="checkbox" name="citas" value="citas">Citas</label>
                  </div> 
                  <?php endif;?>


                  <?php if($menu_caja==1):?>
                  <div class="checkbox">
                    <label><input type="checkbox" checked="true" name="caja" value="caja">Caja</label>
                  </div> 
                  <?php else:?>
                   <div class="checkbox">
                    <label><input type="checkbox" name="caja" value="caja">Caja</label>
                  </div>
                  <?php endif;?>



                  <?php if($menu_proc_dent==1):?>
                  <div class="checkbox">
                    <label><input type="checkbox"  checked="true" name="procesosd" value="procesosd">Procesos Dentales</label>
                  </div>
                  <?php else:?>
                  <div class="checkbox">
                    <label><input type="checkbox" name="procesosd" value="procesosd">Procesos Dentales</label>
                  </div>
                  <?php endif;?>

                   <?php if($menu_cons==1):?>
                  <div class="checkbox">
                    <label><input type="checkbox" checked="true" name="consultasp" value="consultasp">Consultas Procedimientos</label>
                  </div> 
                    <?php else:?>
                  <div class="checkbox">
                    <label><input type="checkbox" name="consultasp" value="consultasp">Consultas Procedimientos</label>
                  </div> 
                  <?php endif;?>

                   <?php if($menu_seg==1):?>
                  <div class="checkbox">
                    <label><input type="checkbox" checked="true" name="copiaseg" value="copiaseg">Copia de Seguridad</label>
                  </div>
                   <?php else:?>

                    <div class="checkbox">
                    <label><input type="checkbox" name="copiaseg" value="copiaseg">Copia de Seguridad</label>
                  </div>
                   <?php endif;?>
                </div>
                  </div>

        	  <div class="form-group">
              <div class="col-sm-offset-4 col-sm-8">
              			<a href="usuario.php">
                      <button type="button" name="volver" class="btn btn-danger">VOLVER</button>
                    </a>
                
              
            
          	   
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