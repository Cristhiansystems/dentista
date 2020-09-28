<h1 align="center"><a href="registroFMR.php"><button class="btn btn-primary">Nuevo </button></a></h1>

<div class="wrapper">
<form  method="post" class="form-horizontal" role="form">
    <div class="panel panel-primary">
      
       
        <div class="form-group">
                  	<div class="col-md-offset-1 col-md-2">
                        <label for="ci" class="control-label">
                          PACIENTE<span style="color:#F00">*</span>
                        </label>
                    </div>
                    <div class="col-md-5">
                 <input type="text" id="ci" name="ci" class="form-control">
</div> 
                </div>
                
                <div class="form-group">
            <label for="fecha" class="col-md-2 control-label">FECHA INICIAL</label>
            <div class="col-md-3">
                <input type="date" name="fechai" id="fechai" class="form-control" autocomplete="off">
            </div>
             <label class="col-md-2 control-label">FECHA FINAL</label>
              <div class="col-md-3">
                <input type="date" name="fechaf" id="fechaf" class="form-control" autocomplete="off" >
            </div>
        </div>
        
        <div class="panel-footer">
        	<div class="form-group">
                <div class="col-md-offset-2 col-md-2">
                    <input type="button" name="bus" id='bus' value="Buscar"class="btn btn-info">
                </div>
              
                 <div class="col-md-2">
                  <input type="button" name="des" id="des" value="Desactivados" class="btn btn-warning">
                </div>
            </div>
        </div>
     </div>
     </form>
</div>
