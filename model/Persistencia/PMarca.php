<?php

require_once (APP_DIR."/model/Logica/Marca.php");
require_once (APP_DIR."/model/Logica/Empleado.php");
require_once ("Conexion.php");


class PMarca extends Conectar {

    private static $instance = NULL;
    private $marcas;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new PMarca();
        }
        return self::$instance;
    }

    function NuevaMarca(Marca $marca) {
        $id = mysqli_real_escape_string($this->conexion(), $marca->getid());
        $userid = mysqli_real_escape_string($this->conexion(), $marca->getuserid());
        $tipo = mysqli_real_escape_string($this->conexion(), $marca->gettipo());
        $fecha = mysqli_real_escape_string($this->conexion(), $marca->getfecha());

        $sql = "INSERT INTO `Checkinout`(`Logid`,`Userid`, `Checktime`, `Checktype`) VALUES "
                . "('" . $id . "','" . $userid . "','" . $fecha . "','" . $tipo . "')";



        if (!$this->conexion()->query($sql)) {
            return "Código de error: ". $this->conexion()->errno;
        }
        return "ok";

    }

//    function BorrarMarca($id) {
//        $sql = ;
//        return $this->conexion()->query($sql);
//    }

    function ModificarMarca(Marca $marca) {
        $id = mysqli_real_escape_string($this->conexion(), $marca->getid());
        $userid = mysqli_real_escape_string($this->conexion(), $marca->getuserid());
        $tipo = mysqli_real_escape_string($this->conexion(), $marca->gettipo());
        $fecha = mysqli_real_escape_string($this->conexion(), $marca->getfecha());

        $sql = "UPDATE `Checkinout` SET `Userid`= '" . $userid . "', `CheckType`= '" . $tipo . "', `CheckTime`= '" . $fecha . "' WHERE `Logid`= '" . $id . "'";

        if ($this->conexion()->query($sql)) {
            return 1;
        }
        return 0;
    }

    function BuscarMarcas($userid,$desde,$hasta) {

        // $desde ='2015-12-22';
        // $hasta ='2015-12-25';


        $sql = "SELECT * FROM `attendance_record` WHERE `user_code`= '$userid'  AND cast(datetime as date) BETWEEN '$desde' AND '$hasta' ORDER BY `datetime` DESC";

        $consulta = $this->conexion()->query($sql);
        while($filas=$consulta->fetch_assoc()){

            $this->marcas[]=$filas;

            }

        return $this->marcas; //devolvemos el array que trataremos en la vista
    }

    function ObtenerMarcasContralor($userid) {


    }



}
