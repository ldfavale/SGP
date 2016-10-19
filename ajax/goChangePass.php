<?php


require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Logica/logica.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PEmpleado.php");
// require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PPrivilegio.php");
// require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PReloj.php");
// require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/Reloj/FuncReloj.php");
// require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/Reloj/Reloj.php");
//echo $pass;

require('model/Persistencia/class.Conexion.php');
//require('funciones/encrypt.php');


if(!empty($_POST['actual']) and !empty($_POST['nueva']) and !empty($_POST['confirma'])){

  $db = new Conexion();
  $actual = $db->real_escape_string($_POST['actual']);
  $nueva = $db->real_escape_string($_POST['nueva']);
  $confirma = $db->real_escape_string($_POST['confirma']);

    if($nueva === $confirma ){

      $actual = Encrypt($actual);
      $nueva = Encrypt($nueva);
      $id= $_SESSION['id'];

      $sql = $db->query("UPDATE empleados SET Pass = '$nueva' WHERE idEmpleado='$id' AND Pass='$actual';");


        if ($sql === TRUE) {
            //echo 1;
            if($db->affected_rows > 0){
              echo '<div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Contrase&ntilde;a cambiada con &Eacute;xito!</strong>
          </div>';
        }else{
            if($nueva === $actual){
              echo '<div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Error!</strong> La Contrase&ntilde;a nueva es igual a la actual.
          </div>';
            }else{
                  echo '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>Error!</strong> La Contrase&ntilde;a actual no es correcta.
              </div>';
            }
        }

        } else {
          echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Error de base de datos:</strong>  '.$conn->error.'.
      </div>';

        }


      //$db->liberar($sql);
      $db->close();
  }else{
    echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Error!</strong> Las Contrase&ntilde;as no coinciden.
  </div>';
  }
}else{

  echo '<div class="alert alert-dismissible alert-danger">
<button type="button" class="close" data-dismiss="alert">x</button>
<strong>Error!</strong> Todos los datos deben estar llenos.
</div>';

}



?>
