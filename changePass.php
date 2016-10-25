
<a href="#"><strong><i class="glyphicon glyphicon-lock"></i> Cambiar Contrase&ntilde;a</strong></a>
<hr>
<div id="_AJAX_CHANGE_PASS_"></div>



 <form class="form-horizontal top-border col-md-7" role="form">
    	<div class="form-group padding-top-ten-px">
            <label class="col-md-5 control-label">Contrase&ntilde;a Actual:</label>
            <div class="col-md-7">
              <input class="form-control" onkeypress="runScriptChangePass(event)" id="actual" type="password" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-5 control-label">Nueva Contrase&ntilde;a:</label>
            <div class="col-md-7">
              <input class="form-control" onkeypress="runScriptChangePass(event)" id="nueva" type="password" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-5 control-label">Confirmar Contrase&ntilde;a:</label>
            <div class="col-md-7">
              <input class="form-control" id="confirma" onkeypress="runScriptChangePass(event)" type="password" value="">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-5 control-label"></label>
            <div class="col-md-6">
              <input type="button" class="btn btn-primary" onclick='goChangePass()' value="Guardar">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancelar">
            </div>
          </div>
        </form><!--/form-->

        <div class="col-md-4 col-md-offset-1 well">

            <p> La contrasena debe tener:
            <ul>
                <li>Al menos 8 caracteres</li>
               <li>Al menos una mayúscula</li>
                <li>Al menos una minuscula</li>
                <li>Al menos un número</li>
                </ul>
            </p>

        </div>







<script type="text/javascript" src="public/js/generales.js" > </script>
<script src="public/js/pass.js"></script>
