<?php
require_once("core.php");
require('model/Persistencia/class.Conexion.php');

if(!isset($_SESSION['id']) and isset($_GET['key']) ) {

  $db = new Conexion();
  //$id = $_SESSION['app_id'];
  $keypass = $db->real_escape_string($_GET['key']);// Importante aprendido real scape
  $sql = $db->query("SELECT idEmpleado,newpass FROM empleados WHERE  keypass='$keypass' LIMIT 1;");

  if($db->rows($sql) > 0) {

    $data = $db->recorrer($sql);
    $new_pass = Encrypt($data['newpass']);
    $password = $data['newpass'];
    $id_user = $data['idEmpleado'];

    $db->query("UPDATE empleados SET keypass='', newpass='', Pass='$new_pass' WHERE idEmpleado='$id_user';");




    include('lostpass_mensaje.php');

  } else {

  }
  $db->liberar($sql);// Importante aprendido
  $db->close();// Importante aprendido


} else {
  // include('html/public/logearte.php');
  header('location: index.php');
  close;
}
?>
