 <?php 
ob_start();
ini_set('session.save_path',realpath($_SERVER['DOCUMENT_ROOT']).'/inventario_ferreteria/sessiones');
session_start();
include("../conexion.php");

if(!isset($_SESSION["idusu"])){
	
	header("location:../login.php");
	}else{
	
  $id_usuario=$_SESSION["idusu"];
 // print($id_usuario);

$sql=$base->query("SELECT menu_mantenimiento,menu_grupo_dental,menu_citas,menu_caja,menu_procesos_dentales,menu_consultas,menu_seguridad, concat_ws(' ',emp.nombre,emp.apellido_paterno) as empleado, emp.foto, agen.nombre as agencia, agen.direccion,emp.tipo_empleado,agen.id_agencia,emp.id_empleado FROM tbl_usuarios usu inner JOIN tbl_empleados emp on usu.id_empleado=emp.id_empleado inner join tbl_agencias agen on usu.id_agencia=agen.id_agencia WHERE usu.id_usuario=$id_usuario")->fetch(PDO::FETCH_ASSOC);

$menu_mantenimiento=$sql['menu_mantenimiento'];
$menu_grupo_dental=$sql['menu_grupo_dental'];
$menu_citas=$sql['menu_citas'];
$menu_caja=$sql['menu_caja'];
$menu_procesos_dentales=$sql['menu_procesos_dentales'];
$menu_consultas=$sql['menu_consultas'];
$menu_seguridad=$sql['menu_seguridad'];
$empleado=$sql['empleado'];
$foto =$sql['foto'];  
$agencia=$sql['agencia'];
$direccion=$sql['direccion'];  
$tipo_empleado=$sql['tipo_empleado'];
$id_agencia=$sql['id_agencia'];
$id_empleado=$sql['id_empleado'];
//echo ($paciente);
}
?>  
          <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>DENT</b>V</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>DENTALL</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
               <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../imagenes/logorep.jpeg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Agencia - <?php echo strtoupper($agencia);?> </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../imagenes/logorep.jpeg" class="img-circle" alt="User Image">
                    <p>
                     <?php echo ($empleado ." - ". $tipo_empleado);?> <small> <?php echo($tipo_empleado.", ". strtoupper($agencia) ." - ". $direccion);?>  </small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="../lista_agencias.php" class="btn btn-default btn-flat">Cambiar Sucursal</a>
                    </div>
                    <div class="pull-right">
                      <a href="../login.php" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>




              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../empleado/<?php echo $foto; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $empleado; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
            </div>
          </div>

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
          <?php if($menu_mantenimiento==1):?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Mantenimiento</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <!--Se cambio el nombre para mostrar las agencias  de id_agencia en v2.0  -->
                <li><a href="../agencia/agencia.php"><i class="fa fa-circle-o"></i>Sucursales</a></li>
                <li><a href="../consultorio/consultorio.php"><i class="fa fa-circle-o"></i>Consultorios</a></li>
                  <li><a href="../empleado/empleado.php"><i class="fa fa-circle-o"></i>Empleados</a></li>
                  <li><a href="../seguro/seguro.php"><i class="fa fa-circle-o"></i>Seguros</a></li>
                  <li><a href="../usuario/usuario.php"><i class="fa fa-circle-o"></i>Usuarios</a></li>
              </ul>
            </li>
          <?php endif;?>

          <?php if($menu_grupo_dental==1):?>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Grupo Dental</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               
                  
                 <li><a href="../especialidad/especialidad.php"><i class="fa fa-circle-o"></i>Especialidades</a></li>
                  <li><a href="../tratamiento/tratamiento.php"><i class="fa fa-circle-o"></i> Tratamientos</a></li>
                  <li><a href="../piezas/piezas.php"><i class="fa fa-circle-o"></i> Piezas</a></li>
                  
              
              </ul>
            </li>
          <?php endif;?>
            <?php if($menu_grupo_dental==1):?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Citas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../agenda/agenda.php"><i class="fa fa-circle-o"></i> Agenda</a></li>
              </ul>
            </li>
          <?php endif;?>
            
            <?php if($menu_caja==1):?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Caja</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../pagos/pagos.php"><i class="fa fa-circle-o"></i> Pagos</a></li>
              </ul>
            </li>
          <?php endif ;?>
              <?php if($menu_procesos_dentales==1):?>         
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Procesos Dentales</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../cuenta/cuenta.php"><i class="fa fa-circle-o"></i> Cuenta</a></li>
                <li><a href="../cuotas/cuenta.php"><i class="fa fa-circle-o"></i> Cuenta por cuotas</a></li>
                <li><a href="../paciente/paciente.php"><i class="fa fa-circle-o"></i> Pacientes</a></li>
                
              </ul>
            </li>
          <?php endif;?>

          <?php if($menu_consultas==1):?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Consultas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../pacientes_deudores/pacientes.php"><i class="fa fa-circle-o"></i> Pacientes Deudores</a></li>
                 
                
              </ul>
            </li>
          <?php endif;?>

          <?php if($menu_seguridad==1):?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Seguridad</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="../seguridad/copia_seguridad.php"><i class="fa fa-circle-o"></i>Copia de Seguridad</a></li>
                 
                
              </ul>
            </li>
          <?php endif ;?>

           
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>




