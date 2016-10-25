<?php

/*
 *   Controlador MARCA

 */

require_once (APP_DIR."/model/Logica/Empleado.php");
require_once (APP_DIR."/model/Logica/Marca.php");
require_once (APP_DIR."/model/Persistencia/PMarca.php");

class ControladorM{

    private static $instance = NULL;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new ControladorM();

        }
        return self::$instance;
    }

//    function NuevaMarca(){
//
//        return 0;
//    }
//    function BorrarMarca(){
//
//        return 0;
//    }

    function ModificarMarca($id, $userid,$tipo,$fecha){
        $marca= new Marca($id,$userid,$tipo,$fecha);
        $persistenciamarca= PMarca::getInstance();
        return $persistenciamarca->ModificarMarca($marca);
    }
    function BuscarMarcas($userid,$desde,$hasta){
        //$empleado= new Empleado($arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_horario, $arg_cargo, $arg_estado, $arg_identificacion);
        $persistenciamarca= PMarca::getInstance();
        $result = $persistenciamarca->BuscarMarcas($userid,$desde,$hasta);

        if(!isset($result)){
          $result = 'Lo sentimos pero No hay resultados para la busqueda solicitada';
        }
       //print_r ($result);

        return $result;
    }



}
