<h1 align="center">PAGOS</h1>
<div class="wrapper">
<form  method="post" class="form-horizontal" role="form">
    <div class="panel panel-primary">
       
               <div class="form-group">
            <label for="ci" class="col-md-2 control-label">Paciente</label>
            <div class="col-md-5">
                <input type="text" name="ci" id="ci" class="form-control" autocomplete="off" placeholder="Ingrese CI o Codigo de Paciente" />
            </div>
        </div>     
        
            <div class="form-group">
            <label for="fecha" class="col-md-2 control-label">FECHA INICIAL</label>
            <div class="col-md-3">
                <input type="date" name="fechai" id="fechai" class="form-control" autocomplete="off" >
            </div>
             <label class="col-md-2 control-label">FECHA FINAL</label>
              <div class="col-md-3">
                <input type="date" name="fechaf" id="fechaf" class="form-control" autocomplete="off" >
            </div>
        </div>  
        <div class="panel-footer">
        	<div class="form-group">

                 <div class="col-md-2">
                  <input type="button" name="bus" id="bus" value="Buscar" class="btn btn-primary">
                </div> 
                  <div class="col-md-2">
                  <input type="button" name="ar" id="arqueo" value="Arqueo de caja" class="btn btn-warning">
                </div>
            </div>
        </div>
     </div>
     </form>
</div>
