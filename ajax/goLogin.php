<?php //echo 'estoy en goLogin.php';
//echo $_POST['user'];
//echo $_POST['pass'];
require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Logica/logica.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PEmpleado.php");
// require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PPrivilegio.php");
// require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PReloj.php");
// require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/Reloj/FuncReloj.php");
// require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/Reloj/Reloj.php");
//echo $pass;

require('model/Persistencia/class.Conexion.php');
//require('funciones/encrypt.php');


if(!empty($_POST['user']) and !empty($_POST['pass'])){

  $db = new Conexion();
  $user = $db->real_escape_string($_POST['user']);
  $pass = Encrypt($_POST['pass']);
  ///echo $pass;
  $sql = $db->query("SELECT * FROM empleados WHERE (Nick='$user' OR CorreoInstitucional='$user') AND Pass='$pass' ;");
  if($db->rows($sql) > 0){
    if($_POST['rec']){ ini_set('session.cookie_lifetime', time()+(60*60*24));}
while ($emp = $db->recorrer($sql)) {
  $_SESSION['id'] = $emp['idEmpleado'];
  $_SESSION['nombre'] = $emp['Nombre'];
  $_SESSION['tipo'] = $emp['FkPrivilegio'];
}
    // $_SESSION['id'] = $db->recorrer($sql)[0];
    // $_SESSION['nombre'] = $db->recorrer($sql)[4];

    echo 1;
  }else{

    echo '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Error!</strong> Credenciales Incorrectas.
</div>';

  }
  $db->liberar($sql);
  $db->close();
}else{
  echo '<div class="alert alert-dismissible alert-danger">
<button type="button" class="close" data-dismiss="alert">x</button>
<strong>Error!</strong> Todos los datos deben estar llenos.
</div>';
}



?>
