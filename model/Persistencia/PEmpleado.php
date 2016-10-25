<?php
/*
 *   Persistencia Empleado
 *   Esta clase permite acceder a la base de datos para enviar y traer daots relacionados
 *   con empleado. Las clases principal involucrada es Empleado y Conexion.
 *
 *   @author Fredd Hannay
 */

require_once (APP_DIR."/model/Logica/logica.php");
require_once ("Conexion.php");

class PEmpleado extends Conectar {

    private static $instance = NULL;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new PEmpleado();
        }
        return self::$instance;
    }

    function NuevoEmpleado(Empleado $empleado) {

        $nick= mysqli_real_escape_string($this->conexion(), $empleado->getNombreUsuario());
        $pass=mysqli_real_escape_string($this->conexion(), $empleado->getContraseña());
        $nrofuncionario = mysqli_real_escape_string($this->conexion(), $empleado->getnrofuncionario());
        $Nombre = mysqli_real_escape_string($this->conexion(), $empleado->getnombre());
        $apellido = mysqli_real_escape_string($this->conexion(), $empleado->getapellido());
        $cedula = mysqli_real_escape_string($this->conexion(), $empleado->getcedula());
        $direccion = mysqli_real_escape_string($this->conexion(), $empleado->getdireccion());
        $residencia = mysqli_real_escape_string($this->conexion(), $empleado->getresidencia());
        $tel = mysqli_real_escape_string($this->conexion(), $empleado->gettel());
        $cel = mysqli_real_escape_string($this->conexion(), $empleado->getcel());
        $correo = mysqli_real_escape_string($this->conexion(), $empleado->getcorreo());
        $correoinstitucional = mysqli_real_escape_string($this->conexion(), $empleado->getcorreoinstitucional());
        $horario = mysqli_real_escape_string($this->conexion(), $empleado->gethorario()); //horario pertenece a la clase Horario, hay que caster el id del horario del empleado
        $cargo = mysqli_real_escape_string($this->conexion(), $empleado->getcargo());
        $estado = mysqli_real_escape_string($this->conexion(), $empleado->getestado()); //Booleano
        $privilegio=mysqli_real_escape_string($this->conexion(), $empleado->getPrivilegio());

        $sql = "INSERT INTO `empleados`(`Nick`,`Pass`,`NroFuncionario`,`Nombre`, `Apellido`, `Cedula`, `Direccion`, `Residencia`, `Tel`, `Cel`, `Correo`, `CorreoInstitucional`, `FkHorario`, `FkCargo`, `FkPrivilegio`, `Estado`) VALUES "
                . "('" . $nick . "','". $pass . "','". $nrofuncionario . "','" . $Nombre . "','" .
                $apellido . "','" . $cedula . "','" . $direccion . "','" . $residencia . "','" .
                $tel . "','" . $cel . "','" . $correo . "', '" . $correoinstitucional . "', '" .
                $horario . "','" . $cargo . "','". $privilegio . "','" . $estado ."')";

        if (!$this->conexion()->query($sql)){
            return $this->conexion()->error;
        }

            return 1;
    }

    function ModificarEmpleado($empleado) {

        $id= mysqli_real_escape_string($this->conexion(), $empleado->getid());
        $nrofuncionario = mysqli_real_escape_string($this->conexion(), $empleado->getnrofuncionario());
        $Nombre = mysqli_real_escape_string($this->conexion(), $empleado->getnombre());
        $apellido = mysqli_real_escape_string($this->conexion(), $empleado->getapellido());
        $cedula = mysqli_real_escape_string($this->conexion(), $empleado->getcedula());
        $direccion = mysqli_real_escape_string($this->conexion(), $empleado->getdireccion());
        $residencia = mysqli_real_escape_string($this->conexion(), $empleado->getresidencia());
        $tel = mysqli_real_escape_string($this->conexion(), $empleado->gettel());
        $cel = mysqli_real_escape_string($this->conexion(), $empleado->getcel());
        $correo = mysqli_real_escape_string($this->conexion(), $empleado->getcorreo());
        $correoinstitucional = mysqli_real_escape_string($this->conexion(), $empleado->getcorreoinstitucional());
        $horario = mysqli_real_escape_string($this->conexion(), $empleado->gethorario());
        $cargo = mysqli_real_escape_string($this->conexion(), $empleado->getcargo());
        $estado = mysqli_real_escape_string($this->conexion(), $empleado->getestado()); //Booleano
        $privilegio=mysqli_real_escape_string($this->conexion(), $empleado->getprivilegio()); //Booleano

        $sql = "UPDATE `empleados` SET `FkPrivilegio`= '" . $privilegio . "',`NroFuncionario`= '" . $nrofuncionario . "', `Nombre`= '" . $Nombre . "', `Apellido`= '" . $apellido . "', `Cedula`= '" . $cedula . "', `Direccion`= '" . $direccion . "', `Residencia`= '" . $residencia . "', `Tel`= '" . $tel . "', `Cel`= '" . $cel . "', `Correo`= '" . $correo . "', `CorreoInstitucional`= '" . $correoinstitucional . "', `FkHorario`= '" . $horario . "', `FkCargo`= '" . $cargo . "', `Estado`= '" . $estado . "' WHERE `idEmpleado`= '" . $id . "'";

        if (!$this->conexion()->query($sql)){
            return $this->conexion()->error;
        }

            return 1;
    }

    function BuscarEmpleados($busqueda) {

        $valores = null;

    if (!isset($busqueda['busqueda'])){
        if (isset($busqueda)){

                if ($busqueda['nrofuncionario'] != null && $busqueda['nrofuncionario'] != "") {
                    //$sql = $sql . "`NroFuncionario` LIKE '" . $busqueda['nrofuncionario'] . "'";
                    $valores["NroFuncionario"] = $busqueda['nrofuncionario'];
                }
                if ($busqueda['idEmpleado'] != null && $busqueda['idEmpleado'] != "") {  //Revisar en la vista la busqueda
                    $valores["idEmpleado"] = $busqueda['idEmpleado'];
                }
                if ($busqueda['nombre'] && $busqueda['nombre'] != "") {
                    $valores["Nombre"] = $busqueda['nombre'];
                }
                if ($busqueda['apellido'] != null && $busqueda['apellido'] != "") {
                    $valores["Apellido"] = $busqueda['apellido'];
                }
                if ($busqueda['cedula'] != null && $busqueda['cedula'] != "") {
                    $valores["Cedula"] = $busqueda['cedula'];
                }
                if ($busqueda['direccion'] != null && $busqueda['direccion'] != "") {
                    $valores["Direccion"] = $busqueda['direccion'];
                }
                if ($busqueda['residencia'] != null && $busqueda['residencia'] != "") {
                    $valores["Residencia"] = $busqueda['residencia'];
                }
                if ($busqueda['telefono'] != null && $busqueda['telefono'] != "") {
                    $valores["Tel"] = $busqueda['telefono'];
                }
                if ($busqueda['celular'] != null && $busqueda['celular'] != "") {
                    $valores["Cel"] = $busqueda['celular'];
                }
                if ($busqueda['email'] != null && $busqueda['email'] != "") {
                    $valores["Correo"] = $busqueda['email'];
                }
                if ($busqueda['emailinstitucional'] != null && $busqueda['emailinstitucional'] != "") {
                    $valores["CorreoInstitucional"] = $busqueda['emailinstitucional'];
                }
                if ($busqueda['horario'] != null && $busqueda['horario'] != "") {
                    $valores["Horario"] = $busqueda['horario'];
                }
                if ($busqueda['cargo'] != null && $busqueda['cargo'] != "") {
                    $valores["Cargo"] = $busqueda['cargo'];
                }
                if ($busqueda['estado'] != null && $busqueda['estado'] != "") {
                    $valores["Estado"] = $busqueda['estado'];
                }
                $pivote="AND";

        }
    }else{

                            $valores["NroFuncionario"]      = $busqueda['busqueda'];
                            $valores["idEmpleado"]          = $busqueda['busqueda'];
                            $valores["Nombre"]              = $busqueda['busqueda'];
                            $valores["Apellido"]            = $busqueda['busqueda'];
                            $valores["Cedula"]              = $busqueda['busqueda'];
                            $valores["Direccion"]           = $busqueda['busqueda'];
                            $valores["Residencia"]          = $busqueda['busqueda'];
                            $valores["Tel"]                 = $busqueda['busqueda'];
                            $valores["Cel"]                 = $busqueda['busqueda'];
                            $valores["Correo"]              = $busqueda['busqueda'];
                            $valores["CorreoInstitucional"] = $busqueda['busqueda'];
                            $valores["FkHorario"]           = $busqueda['busqueda'];
                            $valores["FkCargo"]             = $busqueda['busqueda'];
                            $valores["Estado"]              = $busqueda['busqueda'];
                            $pivote="OR";

        }

        if (isset($valores)){

            $sql = "SELECT * FROM `empleados` WHERE `";
            $i = 0;

            foreach ($valores as $clave => $valor) {
                if ($i == 0) {
                    $sql = $sql . $clave . "` LIKE '%" . $valor . "%'";
                } else {
                    $sql = $sql . $pivote. " `" . $clave . "` LIKE '%" . $valor . "%'";
                }
                $i++;
            }
            $sql= $sql." ORDER BY Nombre, Apellido";
         }else{
             $sql = "SELECT * FROM `empleados` ORDER BY Nombre, Apellido";
         }
            $consulta = $this->conexion()->query($sql);

            while ($filas = $consulta->fetch_assoc()) {  //Error en esta linea "Call to a member function fetch_assoc() on boolean in"
                $empleados[] = $filas; //metemos cada fila de la tabla (que son arrays) dentro del array empleados
            }
            if(isset($empleados)){
                return $empleados; //devolvemos el array que trataremos en la vista
            }else{
                return 0;
            }


        return 0;

    }// Fin buscar empleados

/****************************************Listar Empleados************************************************/

    function ListarEmpleados() {

        $sql = "SELECT * FROM `empleados`";
        $consulta = $this->conexion()->query($sql);

        while ($filas = $consulta->fetch_assoc()) {
            $empleados[] = $filas;
        }

        return $empleados;
    }

/****************************************Buscar empleado ID*********************************************/

    function obtenerEmpleado($idEmpleado){

      // $idEmpleado = mysqli_real_escape_string($idEmpleado);

        $sql = "SELECT * FROM `empleados` WHERE idEmpleado =" . $idEmpleado;

        if (isset($idEmpleado) and !empty($idEmpleado)) {
            $resultado = $this->conexion()->query($sql);
            if (!$resultado) {
                $error= 'No se pudo ejecutar la consulta: ' . mysql_error();
                echo $error;
                return $error;
            }
            $fila = $resultado->fetch_assoc();

            $empleado= new Empleado($fila['idEmpleado'], $fila['Nick'], $fila['Pass'], $fila['FkPrivilegio'], $fila['NroFuncionario'], $fila['Nombre'], $fila['Apellido'], $fila['Cedula'], $fila['Direccion'], $fila['Residencia'], $fila['Tel'], $fila['Cel'], $fila['Correo'], $fila['CorreoInstitucional'], $fila['FkHorario'], $fila['FkCargo'], $fila['Estado'], $this->BuscarRelojesEmpleado($idEmpleado));

            return $empleado;//devolvemos el array que trataremos en el controlador
        }
        else {
            return 0;
        }

    }

    function MAXid() {
        $sql = "SELECT MAX(idEmpleado) as `id` FROM `empleados`";
        $rs=$this->conexion()->query($sql);

        if($row = $rs->fetch_assoc()){
           return $row["id"];
        }
        return "error";
    }

    function BajaEmpleado($id) {
        $sql = "UPDATE `empleados` SET `Estado`= '0' WHERE `idEmpleado`= '" . $id . "'";
        return $this->conexion()->query($sql);
    }

/****************************************Empleado Reloj************************************************/

    function AltaEmpleadoReloj($idEmpleado, $idReloj){

        $id = mysqli_real_escape_string($this->conexion(), $idEmpleado);
        $id2 = mysqli_real_escape_string($this->conexion(), $idReloj);

        $sql = "INSERT INTO `EmpleadoRelojes`(`FKidempleado`,`FKidreloj`) VALUES "
                . "('" . $id . "','" . $id2 . "')";

        if (!$this->conexion()->query($sql)) {
            return "Código de error: " . $this->conexion()->errno;
        }
        return "ok";
    }

    function BuscarRelojesEmpleado($idEmpleado){

        $controladorReloj=  ControladorR::getInstance();
        $sql = "SELECT * FROM `EmpleadoRelojes` WHERE `FKidempleado`=" . $idEmpleado;
        $consulta = $this->conexion()->query($sql);

        $array=null;

        while($result=$consulta->fetch_assoc() ){

                $array[]= $controladorReloj->BuscarReloj($result['FKidreloj']);
            }
            if(!$array){
//                echo '<div class="alert alert-info alert-dismissible" role="alert">'.
//                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.
//                     'ERROR: el usuario no tiene relojes asignados</div>';

                return 0;
            }
            return $array;

    }

}
