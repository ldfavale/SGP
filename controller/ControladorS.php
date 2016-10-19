<?php

/* 
 * Controlador para el manejo de las sedes
 * ABML sedes
 */
require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Persistencia/PSede.php");
require_once ($_SERVER["DOCUMENT_ROOT"]."/model/Logica/logica.php");



class ControladorS{
    private static $instance = NULL;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new ControladorS();
           
        }
        return self::$instance;
    }
    
    
    function AltaSede($arg_sede, $arg_Nombre, $arg_Departamento, $arg_Telefono){
        $sede= new Sede($arg_sede, $arg_Nombre, $arg_Departamento, $arg_Telefono);
        $persistenciasede= PSede::getInstance();
        return $persistenciasede->NuevaSede($sede);    
    }
    
//    function BajaEmpleado($id){
//       
//    }
    
    function ModificarSede($arg_sede, $arg_Nombre, $arg_Departamento, $arg_Telefono){
        $sede= new Sede($arg_sede, $arg_Nombre, $arg_Departamento, $arg_Telefono);
        $persistenciasede= PSede::getInstance();
        return $persistenciasede->ModificarSede($sede);         
    }
    
    function BuscarSede($id){
        $persistenciasede= PSede::getInstance();
        return $persistenciasede->BuscarSede($id);           
    }
    
    function ListarSedes(){
        $persistenciasede= PSede::getInstance();
        return $persistenciasede->ListarSedes();           
    }   
      
}
