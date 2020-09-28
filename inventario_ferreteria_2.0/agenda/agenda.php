<?php

/*include('../conexion.php');*/
/*session_start();
    
  
if (isset($_SESSION['Codigo'])){


}else{

header('Location: ../login.php');//Aqui lo redireccionas al lugar que quieras.
     die() ;

}*/


/*$codigo="1";
$query=$conexion->query("select");
*/

?>
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
	<title>Agenda</title>
<script src="../js/jQuery-2.1.4.min.js"></script>

 	  <link rel="stylesheet" href="../css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/font-awesome.css">
   <link rel="stylesheet" href="../css/AdminLTE.min.css">
   <link rel="stylesheet" href="../css/_all-skins.min.css">
   <link  rel='stylesheet' href='../css/sweetalert.css' />
   <link rel="apple-touch-icon" href="../img/apple-touch-icon.png">
   <link rel="shortcut icon" href="../img/favicon.ico">

 <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

	
<script src="../js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="../js/app.min.js"></script>
<script src="../js/sweetalert.min.js"></script>

<link href='../css/core.main.css' rel='stylesheet' />

<script src='../js/bootstrap-clockpicker.min.js'></script>
<link href='../css/bootstrap-clockpicker.min.css' rel='stylesheet' />

<link href='../css/daygrid.main.css' rel='stylesheet' />
<link href='../css/timegrid.main.css' rel='stylesheet' />
 <link href="https://unpkg.com/pikaday@1.8.0/css/pikaday.css" rel="stylesheet">

<script src='../js/moment.js'></script>
<script src='../js/core.main.js'></script> 
<script src='../js/interaction.main.js'></script>
<script src='../js/daygrid.main.js'></script>
<script src='../js/timegrid.main.js'></script>
<script src='../js/resource.common.main.js'></script>
<script src='../js/resource.daygrid.main.js'></script>
<script src='../js/resource.timegrid.main.js'></script>
<script src='../js/sweetalert.min.js'></script>
<script src='../js/locales-all.js'></script>
<script src="https://unpkg.com/pikaday@1.8.0/pikaday.js"></script>


<script type="text/javascript" src="funciones.js"></script>

<style type="text/css">
  .clockpicker-popover{
    z-index: 999999;

}
#celular {
     border-width:1px; 
  border-style: solid;
  border-color: green;
}

  

</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">

  <?php 
      include("../header.php");
  ?>
	
  <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                
                <div class="box-header with-border">
                  <h3 class="box-title">Agenda</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">


                        <input type="hidden" name="idagen" id="idagen" value="<?php echo $id_agencia;?>">
                      	<!--Eliminado el elemento select para mostrar las agencias  de id_agencia en v2.0  -->
                        

                        <div id='calendar'>  
                        </div>
                           
                        </div>
                        
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->

              </div>
        </section><!-- /.content -->
    </div>





	
	
  
    <!-- Modal -->
  <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Registrar Cita</h4>
        </div>

        <div class="modal-body">

        <form  class="form" id="formulario" >
         

        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="Fecha">Proceso :</label>
                  <input type='text' class="form-control" id="ProCita" name="ProCita"  readonly="" /> 
                 </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                  <label for="Fecha">Fecha :</label>
                  <input type='date' class="form-control" id="Fecha" name="Fecha"   />
               </div>
            </div>  
        </div>

        <div class="row">

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
              <label for="TiempoInicio">Tiempo Inicio :</label>
              <div class="input-group clockpickerInicio" data-placement="left" data-align="top" data-autoclose="true">
              <input type="text" class="form-control"  id="TiempoInicio" name="TiempoInicio">
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
              </span>
               </div>
            </div> 
          </div>

           <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
              <label for="TiempoFin">Tiempo Fin :</label>  
              <div class="input-group clockpickerFin" data-placement="left" data-align="top" data-autoclose="true">
              <input type="text" class="form-control"  id="TiempoFin" name="TiempoFin">
              <span class="input-group-addon">
                  <span class="glyphicon glyphicon-time"></span>
              </span>
            </div> 
            
            </div>
          </div>
        </div>
                
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8">
                <div class="form-group">
               <label for="tratamiento">Paciente :</label>
              <div class="input-group">
                 <span class="input-group-btn">
                  <input type="button" class="btn btn-info" onclick="mostrarModalPacientes();"  id="btn-paciente" href="#moda_list_paci" value="Buscar">
                  </span>
                  <input type="text" class="form-control" name="paciente" id="paciente"  autocomplete="off"  required>
              </div>
           </div>
         </div>

          <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                <label for="celular">Celular :</label>
                <input type="text" class="form-control" name="celular" id="celular" autocomplete="off"  required >   
            </div>
        </div>
      </div>


        <div class="row">
           <div class="col-xs-8 col-sm-8 col-md-8">
            <div class="form-group">
               <label for="tratamiento">Medico :</label>
              <div class="input-group">
                 <span class="input-group-btn">
                  <input type="button" class="btn btn-info" onclick="mostrarModalMedicos();"  id="btn-medico" href="#moda_list_med" value="Buscar">
                  </span>
                  <input type="text" class="form-control" name="medico" id="medico"  autocomplete="off"  required>
              </div>
           </div>
         </div>
             <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                <label for="celular">Celular :</label>
                <input type="text" class="form-control" name="medcelular" id="medcelular" autocomplete="off"  required >   
            </div>
        </div>
                
            
        </div>

        <div id="alerta_medico" ></div>

           <div class="row">
                   
          <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                <label for="estado">Estado :</label>
                <input type="text" class="form-control" name="Estado" id="Estado" autocomplete="off"  required > 
            </div>
          </div>
          </div> 


          <div class="row">
             <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
              <input type="button" onclick="agregarRegistro();"  value="Registrar" id="BtnEnviar" class="btn btn-primary">  
            </div>
          </div>
        </div>
        <div class="row">
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
              <input type="button" onclick="agregarRegistro();"  value="Actualizar" id="BtnEditar" class="btn  btn-primary">
              <input type="button" onclick="eliminarRegistro();" id="BtnEliminar" class="btn btn-danger" value="Eliminar"> 
               
            </div>
          </div>
              <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group"> 
                   <input type="button" onclick="enviarSms();" id="BtnSms" class="btn btn-success" value="Enviar Sms">
                  </div>
          </div>

        </div>
         

            <input type="text" name="asist" id="asist" value="<?php echo $id_empleado; ?>">
           <input type="hidden" name="idcons" id="idcons" >
           <input type="hidden" name="idpac" id="idpac" >
            <input type="hidden" name="idmed" id="idmed" >
           <input type="hidden" name="NombreArea" id="NombreArea" >
           <input type="hidden" name="idcita" id="idcita" >
            
          </form>

        </div>
      </div><!-- /.modal-content -->
    </div>
  </div>

  

  <div class="modal fade" id="moda_list_paci" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
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

  <div class="modal fade" id="moda_list_med" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Lista de Medicos</h4>
        </div>
        <div class="modal-body">

          Buscador:
          <div><input type="text" class="form-control" name="bs-med" id="bs-med" autofocus></div>
          <br>  
            <div id="lista_medicos"></div>

        </div>
      </div><!-- /.modal-content -->
    </div>
  </div>


  
 
  
   
  
 
<?php include("../pie_de_pagina.html"); ?> 

</body>
</html>
