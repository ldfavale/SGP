<?php

/* 
 * L Privilegio
 * @author Fredd Hannay
 */

require_once ($_SERVER["DOCUMENT_ROOT"] . "/model/Logica/logica.php");
require_once ("Conexion.php");

class PPrivilegio extends Conectar {

    private static $instance = NULL;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new PPrivilegio();
        }
        return self::$instance;
    }

    function ListarPrivilegios() {

        $sql = "SELECT * FROM `privilegios`";
        
        
        if($consulta = $this->conexion()->query($sql)){
            
            while ($fila = $consulta->fetch_assoc()) {                 
            $privilegio = new Privilegio($fila["id"],$fila["Nombre"]);
            $privilegios[] = $privilegio;
            }  
            return $privilegios; 
        }
        
        return "error";
        
    }
        
}
