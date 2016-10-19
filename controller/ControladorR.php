<?php

/* 
 *   @author Fredd Hannay
 */

require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Logica/logica.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PReloj.php");


class ControladorR{
    private static $instance = NULL;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new ControladorR();
           
        }
        return self::$instance;
    }
    
    
    function AltaReloj($arg_id, $arg_puerto, $arg_ip, $arg_db, $arg_sede){
        $reloj= new Reloj($arg_id, $arg_puerto, $arg_ip, $arg_db, $arg_sede);
        $persistenciareloj= PReloj::getInstance();
        return $persistenciareloj->NuevoReloj($reloj);    
    }
    
    function ModificarReloj($arg_id, $arg_puerto, $arg_ip, $arg_db, $arg_sede){
        $reloj= new Reloj($arg_id, $arg_puerto, $arg_ip, $arg_db, $arg_sede);
        $persistenciareloj= PReloj::getInstance();
        return $persistenciareloj->ModificarReloj($reloj);         
    }
    
     function ListarRelojes(){
        $persistenciareloj= PReloj::getInstance();
        return $persistenciareloj->ListarRelojes();           
    }   
      
    function BuscarReloj($id) {
        $persistenciareloj= PReloj::getInstance();
        return $persistenciareloj->BuscarReloj($id);
    }
}
