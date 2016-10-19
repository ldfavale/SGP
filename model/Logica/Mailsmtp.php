<?php

/*
 *   Clase para enviar un correo automatico luego del alta NuevoEmpleado
 *   Este es por SMTP
 *   Ubicacion SGPH/model/logica
 *   @author Fredd Hannay
 */
require $_SERVER["DOCUMENT_ROOT"].'/libs/PHPMailer/PHPMailerAutoload.php';

Class Mailsmtp{

    private $email;
    private $pass;
    private $nombre;


    public function __construct($arg_email, $arg_pass, $arg_nombre) {
        $this->email=$arg_email;
        $this->pass=$arg_pass;
        $this->nombre= $arg_nombre;

    }

    function sendmail(){

        //instancio un objeto de la clase PHPMailer
        $mail = new PHPMailer(); // defaults to using php "mail()"
        //indico a la clase que use SMTP
        $mail->IsSMTP();
        //permite modo debug para ver mensajes de las cosas que van ocurriendo
        //$mail->SMTPDebug = 2;
        //Debo de hacer autenticación SMTP
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        // Opciones para certificados auto firmados http://qiku.es/pregunta/325908/phpmailer-genera-php-warning-stream_socket_enable_crypto-certificado-de-peer-no-encontro-lo-esperado-phpmailer-generates-php-warning-stream_socket_enable_crypto-peer-certificate-did-not-match-expected
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //Activo condificacción utf-8
        $mail->CharSet = 'UTF-8';
        //indico el servidor de Gmail para SMTP
        $mail->Host = "smtps.cure.edu.uy";
        //indico el puerto que usa Gmail
        $mail->Port = 465;
        //indico un usuario / clave de un usuario de gmail
        $mail->Username= "no-responder@cure.edu.uy";
        $mail->Password ="r1Fi29aAcVHCBhWeRP";
        //defino el email y nombre del remitente del mensaje
        $mail->SetFrom('no-responder@cure.edu.uy', 'Sistema de Gestion de Personal');
        //defino la dirección de email de "reply", a la que responder los mensajes
        //Obs: es bueno dejar la misma dirección que el From, para no caer en spam
        $mail->AddReplyTo("no-responder@cure.edu.uy","Sistema de Gestion de Personal");
        //Añado un asunto al mensaje
        $mail->Subject = "Contraseña para ingreso en sistema de personal";
        $mail->MsgHTML("Su contraseña es: ".$this->pass);
        //Defino la dirección de correo a la que se envía el mensaje
        $address = $this->email;
        //la añado a la clase, indicando el nombre de la persona destinatario
        $mail->AddAddress($address, $this->nombre);
        //envío el mensaje, comprobando si se envió correctamente
        if(!$mail->Send()) {
            echo "Error al enviar: " . $mail->ErrorInfo;
        } else {
            //echo "Mensaje enviado!";
            return 1;
        }
    }



    function sendMailLostPass($body){

        //instancio un objeto de la clase PHPMailer
        $mail = new PHPMailer(); // defaults to using php "mail()"
        //indico a la clase que use SMTP
        $mail->IsSMTP();
        //permite modo debug para ver mensajes de las cosas que van ocurriendo
        //$mail->SMTPDebug = 2;
        //Debo de hacer autenticación SMTP
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        // Opciones para certificados auto firmados http://qiku.es/pregunta/325908/phpmailer-genera-php-warning-stream_socket_enable_crypto-certificado-de-peer-no-encontro-lo-esperado-phpmailer-generates-php-warning-stream_socket_enable_crypto-peer-certificate-did-not-match-expected
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //Activo condificacción utf-8
        $mail->CharSet = 'UTF-8';
        //indico el servidor de Gmail para SMTP
        $mail->Host = "smtps.cure.edu.uy";
        //indico el puerto que usa Gmail
        $mail->Port = 465;
        //indico un usuario / clave de un usuario de gmail
        $mail->Username= "no-responder@cure.edu.uy";
        $mail->Password ="r1Fi29aAcVHCBhWeRP";
        //defino el email y nombre del remitente del mensaje
        $mail->SetFrom('no-responder@cure.edu.uy', 'Sistema de Gestion de Personal');
        //defino la dirección de email de "reply", a la que responder los mensajes
        //Obs: es bueno dejar la misma dirección que el From, para no caer en spam
        $mail->AddReplyTo("no-responder@cure.edu.uy","Sistema de Gestion de Personal");
        //Añado un asunto al mensaje
        $mail->Subject = "Resetear contraseña de sistema de personal";
        $mail->Body = $body;
        $mail->AltBody = $body;

        //$mail->MsgHTML("Su contraseña es: ".$this->pass);
        //Defino la dirección de correo a la que se envía el mensaje
        $address = $this->email;
        //la añado a la clase, indicando el nombre de la persona destinatario
        $mail->AddAddress($address, $this->nombre);
        //envío el mensaje, comprobando si se envió correctamente
        if(!$mail->Send()) {
            return $mail->ErrorInfo;
        } else {

            return true;
        }
    }
}
