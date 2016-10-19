<?php

/* 
 *   @author Fredd Hannay
 */

require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Logica/logica.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PPrivilegio.php");


class ControladorP{
    private static $instance = NULL;
    private $privilegios=null;
    
    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new ControladorP();
           
        }
        return self::$instance;
    }
    
     function ListarPrivilegios(){
        
         if($this->$privilegios==null){
             $persistenciaPrivilegio= PPrivilegio::getInstance();
             $this->privilegios= $persistenciaPrivilegio->ListarPrivilegios();             
         }
        return $this->privilegios;
    }   

}
