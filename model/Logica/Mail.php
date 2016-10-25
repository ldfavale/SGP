<?php

/* 
 *   Clase para enviar un correo automatico luego del alta NuevoEmpleado
 *   Ubicacion SGPH/model/logica
 *   @author Fredd Hannay
 */

Class Mail{
    
    private $email;
    private $pass;
    
    public function __construct($arg_email, $arg_pass) {
        $this->email=$arg_email;
        $this->pass=$arg_pass;
        
    }
            
function sendmail(){
            //Correo Remitente
            $from = "CURE<personal@cure.edu.uy>";
            //Variable correo receptor
            $to = $this->email;
            //Asunto
            $subject = "[CURE] Alta SGPH";
            //Cuerpo del mensaje en HTML que contiene el password
            $body = "<blockquote>Su contrase;a previsoria es: <b>".  $this->pass."</b></blockquote>";


           // Ahora se envía el e-mail usando la función mail() de PHP
           $headers  = 'MIME-Version: 1.0' . "\r\n";
           $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
           $headers .= 'From: '.$from."\r\n".
           'Reply-To: '.$from."\r\n" .
           'X-Mailer: PHP/' . phpversion();
           mail($to, $subject, $body, $headers);
           header('Location: index.html'); 
        }    
}
   