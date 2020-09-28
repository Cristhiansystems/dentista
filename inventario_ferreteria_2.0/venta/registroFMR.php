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
<title>Registro venta</title>
<script src="../js/jQuery-2.1.4.min.js"></script>

    <script src="../js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/app.min.js"></script>

<script>

$(document).ready(function(){
			$("#ci").on("keyup", function() {
    			ci=$("#ci").val();
				
				$.post("getCliente.php", {ci: ci }, function(data){
									if(data!== ""){
										data=data.split("-");
									ci2=data[0];
									cliente=data[1];
									$("#id_cliente").val(ci2);
									$("#cliente").html(cliente);
									}else{
										$("#id_cliente").val("");
									$("#cliente").html("");
									}
									
								
							});
					
				});
	
		$("#pro").on("keyup", function() {
			pro = $(this).val();

			$.post("selpro.php", { pro:pro}, function(data){
									if(data!== ""){
										data=data.split("-");
									nombre=data[0];
									precio=data[1];
									$("#pro2").html(nombre);
									$("#precio").val(precio);
									}else{
										$("#pro2").html("");
										$("#precio").val(0);
									}

    });
					
			});
	function controlarClick() {
	  $("button[name='del']").off('click');
    $("button[name='del']").on('click', function(event){
       borrarcurso(event);
	   return false;
	});
		}


	cont=0;
	$("#anadir").click(function(){
		pretototal= $("#pretotal").val();
			cont=cont + 1;
			pro = $("#pro").val();
			precio = $("#precio").val();
			cantidad = $("#can").val();
			if (cantidad=="" || precio ==0){
				alert("Debe llenar cantidad y/o elegir un producto");
			}else{
				preciosubtotal=cantidad * precio;
				preciosubtotal = parseFloat((preciosubtotal).toFixed(2));
				fila="<tr id='" +cont + "'><td><input type='hidden' name='prot[]'  value='"+ pro + "' readonly>"  + pro + "</td><td><input type='hidden' name='cant[]'  value='"+ cantidad + "' readonly>" + cantidad  +"</td><td>"+ precio +"</td><td><input id='pret-" + cont+"' type='hidden' name='pret[]'  value='"+ preciosubtotal + "' readonly>" + preciosubtotal  + " Bs.</td><td><button name='del' id='del-" +cont + "' class='btn btn-danger'>-</button></td></tr>";
				$('#tabla tbody').append(fila);
				pretototal=parseFloat((pretototal))+ preciosubtotal;
				pretototal= parseFloat((pretototal).toFixed(2));
				$("#pretotal").val(pretototal);
				controlarClick();
				
			}
			return false;
					
			});
	
			$("button[name=del]").click(function(event){
			borrarcurso(event);
			return false;
			});
	
		function borrarcurso(event){
				subventa=event.target.id;
				sv=subventa.split("-");
				a_pretotal=sv[1];
				preciosubtotal=$("#pret-" + a_pretotal).val();
				 td=$("#"+ subventa).parent('td');
				 td.parent('tr').remove();
				pretototal= $("#pretotal").val();
			pretototal=parseFloat((pretototal)) - preciosubtotal;
				pretototal= parseFloat((pretototal).toFixed(2));
				$("#pretotal").val(pretototal);
				return false;
				}
	
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
	
	function errorci(){
	swal("ERROR EN EL REGISTRO","el nombre del producto ya existe","error");
	}
	
	function alerta(){
	swal("NO HAY SUFUCIENTE STOCK DE ALGUN PRODUCTO SELECCIONADO","","error");
	}
	
	
	
</script>
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
	
	if(isset($_GET['errorci'])){
	
	echo "<script>";
	echo "errorci();";
	echo "</script>";
	}
	if(isset($_GET['erroredad'])){
	
	echo "<script>";
	echo "erroredad();";
	echo "</script>";
	}
	if(isset($_GET['alerta'])){
	
	echo "<script>";
	echo "alerta();";
	echo "</script>";
	}
	$sql1=$base->query("Select * From tipo_producto where estado='activo' order by nombre")->fetchAll(PDO::FETCH_OBJ);
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
		                     <h1>REGISTRAR VENTA</h1>
          
          <form action="registroPHP.php" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
          <label class="control-label"> <span style="color:#F00">* Campos obligatorios</span></label>
          <div class="row">
				
                 <div class="row">
                 <div class="col-md-4">
					  <div class="form-group">
						<div class="col-md-offset-2 col-md-5">
						  <label for="ci" class="control-label">
							CI CLIENTE<span style="color:#F00">*</span>
						  </label>
					  </div>
						<div class=" col-md-offset-2 col-md-10">
					  <input type="text" name="ci" id="ci" class="form-control" autocomplete="off" required/>
					  </div>
					</div>
                </div>
         		 <div class="col-md-4">
                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-5">
                    <label for="prec" class="control-label">
                      	CLIENTE<span style="color:#F00">*</span>
                    </label>
                    </div>
                    	<div class="col-md-offset-2 col-md-10">
                    <input type="hidden" name="id_cliente" id="id_cliente" class="form-control" autocomplete="off"/>
                    <textarea name="cliente" id="cliente" class="form-control" cols="100" rows="3" readonly style="resize: both;"></textarea>
                    	</div>
                  </div>
                  </div>
                   </div>
                   
                 <div class="row">

                           <div class="col-md-4">
					                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-10">
                        <label for="pro" class="control-label">
                          PRODUCTO<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-offset-2 col-md-10">
                 <input type="text" id="pro" name="pro" class="form-control" autocomplete="off"/>

					 <input type="hidden" name="precio" id="precio" class="form-control" autocomplete="off"/>
</div> 
                </div>
					</div>
              
               <div class="col-md-4">
                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-5">
                    <label for="pro2" class="control-label">
                      	DESCRIPCION <span style="color:#F00">*</span>
                    </label>
                    </div>
                    	<div class="col-md-offset-2 col-md-10">
                    <textarea name="pro2" id="pro2" class="form-control" cols="100" rows="3" readonly style="resize: both;"></textarea>
                    	</div>
                  </div>
                  </div>
               
               
                          <div class="col-md-3">
					                   <div class="form-group">
                  	<div class="col-md-offset-2 col-md-10">
                        <label for="can" class="control-label">
                          CANTIDAD<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-offset-2 col-md-10">
                 <input type="number" id="can" name="can" class="form-control">
</div> 
                </div>
					</div>
               
               
               <div class="col-md-1">
					                   <div class="form-group">

                    <div class="col-md-10">
                <button class="btn btn-facebook" id="anadir">+</button>
</div> 
                </div>
					</div>
                </div>

                   </div>
                 
                 <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Bordered Table</h3>
            </div> 
            <!-- /.box-header -->
            <div class="box-body"> 
			
              <table class="table table-bordered" id="tabla">

               <thead>
               	<tr>
               		<th>Producto</th>
               		<th>Cantidad</th>
               		<th>Costo Unitario</th>
               		<th>Importe</th>
               		
               	</tr>
               </thead>
               <tbody>
               
               </tbody>
              </table>
					 </div>
           
           
           
            <div class="box-footer clearfix">
            <div class="pull-right">
            	Precio Total <input type="number" id='pretotal' name="pretotal" value="0" readonly>Bs.
            </div>
             
            </div>
            </div>
            <!-- /.box-body -->
      		 <div class="form-group">
                 	<div class="col-md-offset-3 col-md-2">
                      <label for="ci" class="control-label">
                        TIPO<span style="color:#F00">*</span>
                      </label>
                     </div>
                     <div class="col-md-4">
                  		<select name="tipo" id="tipo" class="form-control"  autocomplete="off" required>
                  		<option value="Venta">Venta</option>
                  		<option value="Proforma">Proforma</option>
						 </select>
                        </div>
                </div>	
          

        	   
         	<div class="col-md-offset-3 col-md-2">
          			<a href="venta.php"><button type="button" name="volver" class="btn btn-danger"/>VOLVER</button></a>
                    </div>
        	   		<div class="col-md-2">
          			<button type="submit" name="enviando" class="btn btn-primary"/>REGISTRAR</button>
                    </div>
          
          
          
          </form>
              </div>            
                          </div>
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