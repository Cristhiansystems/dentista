<h1 align="center">Tratamientos<a href="registroFMR.php"><button class="btn btn-primary">Nuevo </button></a></h1>
<?php  $sql1=$base->query("Select * From especialidad where estado='activo' order by nombre")->fetchAll(PDO::FETCH_OBJ); ?>
<div class="wrapper">
<form  method="post" class="form-horizontal" role="form">
    <div class="panel panel-primary">
      
       
        <div class="form-group">
                  	<div class="col-md-offset-1 col-md-2">
                        <label for="esp" class="control-label">
                          ESPECIALIDAD<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-5">
                 <select id="esp" name="esp" class="form-control"><option selected value="0" required>Seleccione especialidad</option>
<?php foreach($sql1 as $tip):?>
<option value="<?php echo $tip->id_especialidad ?>"><?php echo $tip->nombre ?></option>
<?php
endforeach;
?></select>
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
