<?php

  if($_POST){

require('core.php'); // contiene constantes, archivo conexion
$mode = isset($_GET['mode']) ? $_GET['mode'] : null;
switch ($mode) {

  case 'login':
    require('ajax/goLogin.php');
    break;
  case 'lostpass':
    require('ajax/goLostPass.php');
    break;
  case 'changepass':
    require('ajax/goChangePass.php');
    break;

  default:
    header('location: index.php');
    break;
}
  }else{
    header('location: index.php');
  }

?>
