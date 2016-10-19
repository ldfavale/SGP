<?php

require_once($_SERVER ['DOCUMENT_ROOT']."/controller/Controller.php");

$controlador = ControladorE::getInstance();
$controladorMarcas=  ControladorM::getInstance();


$idEmpleado = isset($_GET['id']) ? $_GET['id'] : null ;

if(isset($idEmpleado)){

$emp= $controlador->obtenerEmpleado($idEmpleado);

}



if(isset($_SESSION['id']) ){

  if(isset($_GET['id']) and $_GET['id'] == $_SESSION['id']){ //si son iguales cambia tu propia pass
    require('changePass.php');
  }else{ // sino estas queriendo cambiar una pass de otro usuario
    if( $_SESSION['tipo'] > 2){// si no sos administrador: permiso denegado
      ?>
      <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Permiso Denegado!</strong> Ud. no tiene los permisos suficientes para acceder a esta pagina.
      </div>

      <?php
    }else{

      ?>
      <a href="#"><strong><i class="glyphicon glyphicon-lock"></i> Resetear Contrase&ntilde;a</strong></a>
      <hr>


      <form class="form col-md-4">


          <!-- <h3>Resetear Contrase&ntilde;a</h3> -->
        <?php
          if(isset($emp)){
            ?>
            <h4><?php echo $emp->getnombre().' '.$emp->getapellido()?></h4>
            <p>Se enviara un e-mail a <?php echo $emp->getcorreoinstitucional()?> con el link para confirmar la accion.</p>
          <input type="hidden" id="email" class="form-control" onkeypress="runScriptLostPass(event)" placeholder="Email" value="<?php echo $emp->getcorreoinstitucional()?>" required autofocus>
          <?php
        }else{
              ?>

              <input type="text" id="email" class="form-control" onkeypress="runScriptLostPass(event)" placeholder="Email" required autofocus>

              <?php
          }
                  ?>  <!-- <input type="password" id="pass" class="form-control inputPassword" placeholder="Password" required> -->
          <!-- <div id="remember" class="checkbox">
              <label>
                  <input type="checkbox" id="rec"  checked> Recuerdame
              </label>
          </div> -->
          <button class="btn btn-md btn-primary btn-block " id="recuperar_pass" onclick="goLostPass()" type="button">Resetear</button>
      </form><!-- /form -->
      <div id="_AJAX_LOST_PASS_" class="col-md-8 "></div>

      <script type="text/javascript" src="public/js/generales.js" > </script>
      <script src="public/js/pass.js"></script>
      <?php


    }

  }

}else{
?>
  <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Error!</strong> Ha ocurrido un error, por favor, intentelo de nuevo.
  </div>
<?php
}

?>
