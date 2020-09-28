<h1 align="center">Ventas<a href="registroFMR.php"><button class="btn btn-primary">Nuevo </button></a></h1>
<?php  $sql1=$base->query("Select * From tipo_producto where estado='activo' order by nombre")->fetchAll(PDO::FETCH_OBJ); ?>
<div class="wrapper">
<form  method="post" class="form-horizontal" role="form">
    <div class="panel panel-primary">
      
       
        <div class="form-group">
                  	<div class="col-md-offset-1 col-md-2">
                        <label for="tip" class="control-label">
                          CLIENTE<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-5">
                 <input type="number" id="ci" name="ci" class="form-control">
</div> 
                </div>
                
                <div class="form-group">
            <label for="fecha" class="col-md-2 control-label">FECHA INICIAL</label>
            <div class="col-md-3">
                <input type="date" name="fechai" id="fechai" class="form-control" autocomplete="off" value="<?php  if(isset($_POST['fechai'])){ echo $_POST['fechai']; } ?>">
            </div>
             <label class="col-md-2 control-label">FECHA FINAL</label>
              <div class="col-md-3">
                <input type="date" name="fechaf" id="fechaf" class="form-control" autocomplete="off" value="<?php  if(isset($_POST['fechaf'])){ echo $_POST['fechaf']; } ?>">
            </div>
        </div>
        
        <div class="panel-footer">
        	<div class="form-group">
                <div class="col-md-offset-2 col-md-2">
                    <input type="button" name="bus" id='bus' value="Buscar"class="btn btn-info">
                </div>
                <div class="col-md-2">
                  <input type="button" name="rep" id="rep" value="Reporte" class="btn btn-info">
                </div>
                 <div class="col-md-2">
                  <input type="button" name="des" id="des" value="Desactivados" class="btn btn-warning">
                </div>
            </div>
        </div>
     </div>
     </form>
</div>
