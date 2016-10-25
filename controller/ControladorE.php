<?php

/*
 *   Controlador Empleado
 *   Este controlador es el intermediario entre la logica/persistencia y la vista.
 *   Este controlador brinda a la vista las funciones necesarias para interactuar
 *   con los datos en la base de datos referentes al Empleado.
 *   Los archivos que intervienen son la PEmpleado (Persistencia Empleado) y la clase Emplado.
 *
 *   @author Fredd Hannay
 */

require_once (APP_DIR."/model/Logica/logica.php");
require_once (APP_DIR."/model/Persistencia/PEmpleado.php");
require_once (APP_DIR."/model/Persistencia/PPrivilegio.php");
require_once (APP_DIR."/model/Persistencia/PReloj.php");
require_once (APP_DIR."/model/Persistencia/Reloj/FuncReloj.php");
require_once (APP_DIR."/model/Persistencia/Reloj/Reloj.php");
require_once (APP_DIR."/funciones/encrypt.php");

class ControladorE{
    private static $instance = NULL;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new ControladorE();

        }
        return self::$instance;
    }

    function AltaEmpleado($arg_nick, $arg_privilegio, $arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_horario, $arg_cargo, $arg_estado,  $arg_arrayrelojes){

        //instanciamos la presistenciareloj para poder trabajar en la BD
        $controladorReloj=  ControladorR::getInstance();
        //Se crea instancia de la presistencia empleado
        $persistenciaempleado= PEmpleado::getInstance();

    /*******************************Contraseña aleatoria******************************/
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $arg_pass = "";
        for($i=0;$i<12;$i++) {
            $arg_pass .= substr($str,rand(0,62),1);
        }
    /*********************************************************************************/
        //encriptamos el password
        $encryptpass = Encrypt($arg_pass);

        //recorremos el arreglo de ids de relojes seleccionados
        $relojes=null;
        if($arg_arrayrelojes!=null){
            foreach ($arg_arrayrelojes as $id){
                //Buscamos el reloj por el id y creamos un objeto
                $reloj=$controladorReloj->BuscarReloj($id);
                // lo colocamos en un arreglo que luego pasaremos al objeto empleado
                $relojes[]=$reloj;
            }
        }

        //Se crea el objeto empleado
        $empleado= new Empleado(null,$arg_nick, $encryptpass, $arg_privilegio, $arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_horario, $arg_cargo, $arg_estado,$relojes);

        //se carga el objeto a la presistencia
        $estado = $persistenciaempleado->NuevoEmpleado($empleado);

        //si el estado es ok, se procede a crear el empleado en el reloj
        if($estado == 1){
            if($relojes!=null){
                //Buscamos el ultimo empleado agregado para obtejer el ID
                $empleado->setid($persistenciaempleado->MAXid());

                //Creamos el usuario para el reloj
                $FuncionarioReloj = new FuncReloj($empleado->getid(),$arg_nick);

                //Colocamos el usuario en un array para posteriormente pasarlo
                $arrayempleados=array($FuncionarioReloj);

                //Para cada reloj logico seleccionado, le cargamos a su equivalente fisico el nuevo funcionario
                foreach ($empleado->getrelojes() as $reloj){
                    //Generamos el reloj (fisico) al que subiremos el empleado
                    $Relojfisico = new Reloj($reloj->getid(),$reloj->getip(),$reloj->getpuerto(),$reloj->getdb());
                    //Modificamos el reloj fisico agregando el nuevo usuario
                    $Relojfisico->setFuncionarios($arrayempleados);
                    //para cada reloj se agrega a la tabla Empleado-relojes una entrada unica
                    $persistenciaempleado->AltaEmpleadoReloj($empleado->getid(), $reloj->getid());
                }
            }
        }else{
            return $estado;
        }


        $log = new Log("Nuevo_empleado",$_SERVER["DOCUMENT_ROOT"]."/logs/");
        $log->insert($empleado->toString(), false, false, false);


//        $mail=new Mail($arg_correo, $arg_pass);
//        if($mail->sendmail()){
//           return "ok";
//        }
//
//        return "error";

        $mail=new Mailsmtp($arg_correoinstitucional, $arg_pass, $arg_nombre);
        $resultadomail=$mail->sendmail();
        if($resultadomail!=1){
            return "Error: ".$resultadomail;
        }

        return 1;

    }

    function BajaEmpleado($id){
        $persistenciaempleado= PEmpleado::getInstance();
        return $persistenciaempleado->BajaEmpleado($id);
    }

    function ModificarEmpleado($arg_id, $arg_nick, $arg_privilegio, $arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_horario, $arg_cargo, $arg_estado, $arg_arrayrelojes){

        //obtenemos los datos viejos para asi guardarlos
        $empleado=$this->obtenerEmpleado($arg_id);

        //instanciamos los controladores necesarios
        $persistenciaempleado= PEmpleado::getInstance();
        $controladorReloj=  ControladorR::getInstance();
        $relojes=null;

        //generamos el array con los ultimos relojes seleccionados
        if(isset($arg_arrayrelojes)){
            foreach ($arg_arrayrelojes as $id){
                //Buscamos el reloj por el id y creamos un objeto
                $reloj=$controladorReloj->BuscarReloj($id);
                // lo colocamos en un arreglo que luego pasaremos al objeto empleado
                $relojes[]=$reloj;
            }
        }

        //Generamos la modificacion
        $modificacion= new Empleado($arg_id,$arg_nick, null, $arg_privilegio, $arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_horario, $arg_cargo, $arg_estado,$relojes);

        //Si es correcta la modificacions se carga al reloj y se guarda en el log
        if($persistenciaempleado->ModificarEmpleado($modificacion)){
            if($relojes!=null){
                //Creamos el usuario para el reloj
                $FuncionarioReloj = new FuncReloj($arg_id,$arg_nick);

                //Colocamos el usuario en un array para posteriormente pasarlo
                $arrayempleados=array($FuncionarioReloj);

                //Para cada reloj lo añadimos en el reloj fisico
                foreach ($modificacion->getrelojes() as $reloj){
                    //Generamos el reloj (fisico) al que subiremos el empleado
                    $Relojfisico = new Reloj($reloj->getid(),$reloj->getip(),$reloj->getpuerto(),$reloj->getdb());
                    //Modificamos el reloj fisico agregando el nuevo usuario
                    $Relojfisico->setFuncionarios($arrayempleados);
                    //para cada reloj se agrega a la tabla Empleado-relojes una entrada unica
                    $persistenciaempleado->AltaEmpleadoReloj($modificacion->getid(), $reloj->getid());
                }

            }
  /// colocar el nombre del administrador que realiza la modificacion


            //si se acepta la modificacion guardamos un log
            $log = new Log("Modificar_empleado",$_SERVER["DOCUMENT_ROOT"]."/logs/");
            $texto= "Adminstrador ID: ".$_SESSION["id"]." Empleado: ".$empleado->toString()." ***Modificacion: ".$modificacion->toString();
            $log->insert($texto, false, false, false);
            return 1;
        }
        //si no es posible la modificacion devolvemos cero
        return 0;
    }

    function BuscarEmpleados($busqueda){
        //$empleado= new Empleado($arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_horario, $arg_cargo, $arg_estado, $arg_identificacion);
        $persistenciaempleado= PEmpleado::getInstance();
        return $persistenciaempleado->BuscarEmpleados($busqueda);
    }
     function ListarEmpleados(){
        $persistenciaempleado= PEmpleado::getInstance();
        return $persistenciaempleado->ListarEmpleados();
    }
     function obtenerEmpleado($idEmpleado){
        $modelo = PEmpleado::getInstance();
        return $modelo->obtenerEmpleado($idEmpleado);
    }
     function AltaEmpleadoReloj($idEmpleado, $idReloj){
        $modelo = PEmpleado::getInstance();
        return $modelo->AltaEmpleadoReloj($idEmpleado, $idReloj);
    }
    function ListarPrivilegios(){
        $persistenciaprivilegio= PPrivilegio::getInstance();
        //Devuelve un array de privilegio
        return $persistenciaprivilegio->ListarPrivilegios();
    }

}
