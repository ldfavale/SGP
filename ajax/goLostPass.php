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


if(!empty($_POST['email'])){

  $db = new Conexion();
  $email = $db->real_escape_string($_POST['email']);


  $sql = $db->query("SELECT idEmpleado,Nombre FROM empleados WHERE correoinstitucional='$email' OR correo='$email' LIMIT 1;");

  if($db->rows($sql) > 0){

    $data = $db->recorrer($sql);


    $id = $data['idEmpleado'];
    $user = $data['Nombre'];
    $keypass = md5(time());
    //$new_pass = strtoupper(substr(sha1(time()),0,8));
    $link = APP_URL . 'resetearPass.php?&key='.$keypass;

  /*******************************Contraseña aleatoria******************************/
      $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
      $arg_pass = "";
      for($i=0;$i<12;$i++) {
          $arg_pass .= substr($str,rand(0,62),1);
      }
  /**************************Encriptar Contraseña************************************/
    //$new_pass = Encrypt($arg_pass);
    $new_pass = $arg_pass;
    /***************************Envio Mail ************************************************/
    $hoy = date('d/m/Y');
    $body = 'Estimado/a '.$user.', El dia '.$hoy.' se solicito un reseteo de contraseña, Si Ud. no solicito dicha accion, haga caso omiso de este mensaje, de lo contrario haga  <a href="'.$link.'">click aqui<a/> para resetear su contraseña.';

    $mail = new Mailsmtp($email, $arg_pass, $user);
    if($mail->sendMailLostPass($body)){

      $db->query("UPDATE empleados SET keypass='$keypass',newpass='$new_pass' WHERE idEmpleado='$id';");

         $HTML = '<div class="alert alert-dismissible alert-success">
             <button type="button" class="close" data-dismiss="alert">x</button>
           <strong>Email enviado!</strong> Se ha enviado un email para confirmar la accion.</div>';
    }
    else{
      $HTML = '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Error!</strong> '.$mail->ErrorInfo.'.</div>';
      //     //$HTML = $mail->ErrorInfo;
    }
  //
  //     $mail->AltBody = 'Hola '.$user.', Para cambiar tu contraseña has click en el siguiente link:'.$link;
  //
  //   if(!$mail->send()) {
  //
  //     $HTML = '<div class="alert alert-dismissible alert-danger">
  //     <button type="button" class="close" data-dismiss="alert">x</button>
  //     <strong>Error!</strong> '.$mail->ErrorInfo.'.</div>';
  //     //$HTML = $mail->ErrorInfo;
  //
  //   }else {
  //
  //
  //     $db->query("UPDATE users SET keypass='$keypass',newpass='$new_pass' WHERE id='$id';");
  //     $HTML = 1;
  //
  //
  //
  //  }
//   $HTML = '<div class="alert alert-dismissible alert-warning">
// <button type="button" class="close" data-dismiss="alert">x</button>
// <strong>
// Email:</strong>  '.$email.'  <strong>
// Keyreg:</strong>'.$keypass.'
// <strong>
// Newpass:</strong> '.$new_pass.'
// <strong>
// Link:</strong> '.$link.'.
// <strong>
// Id:</strong> '.$id.'.
// <strong>
// User:</strong> '.$user.'.
//
// </div>';


  }else{
    $HTML = '<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Error!</strong> El email ingresado NO existe.
  </div>';
  }
  $db->liberar($sql);
  $db->close();
}else{
  $HTML = '<div class="alert alert-dismissible alert-danger">
<button type="button" class="close" data-dismiss="alert">x</button>
<strong>Error!</strong> El email no puede ser vacio.
</div>';
}
  echo $HTML;

  //$sql = $db->query("UPDATE  empleados SET Pass = '$pass' WHERE (Correo='$email' OR CorreoInstitucional='$email') ;");


//     if ( $sql === TRUE) {
//         //echo 1;
//       //echo $arg_pass;
//         if($db->affected_rows > 0){
//       echo '<div class="alert alert-dismissible alert-success">
//        <button type="button" class="close" data-dismiss="alert">x</button>
//       <h4>Contrase&ntilde;a Reseteada!</h4>
//       <p>La nueva contrase&ntilde;a es '.$arg_pass.'.</p>
//        </div>';
//        //<p>Te hemos enviado un email con la nueva contrase&ntilde;a.</p>
//      }else{
//        echo '<div class="alert alert-dismissible alert-danger">
//      <button type="button" class="close" data-dismiss="alert">x</button>
//      <strong>Error!</strong> Su email no esta registrado en el sistema.
//    </div>';
//      }
//     } else {
//
//         echo '<div class="alert alert-dismissible alert-danger">
//       <button type="button" class="close" data-dismiss="alert">x</button>
//       <strong>Error de base de datos:</strong>  '.$conn->error.'.
//     </div>';
//     }
//
//
//   //$db->liberar($sql);
//   $db->close();
//
// }else{
//   echo '<div class="alert alert-dismissible alert-danger">
// <button type="button" class="close" data-dismiss="alert">x</button>
// <strong>Error!</strong> Todos los datos deben estar llenos.
// </div>';
// }



?>
