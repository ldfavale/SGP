<?php

/*
 * Interaccion con la tabla Reloj en la base del sistema
 * ABML relojes
 * @author Fredd Hannay
 */

require_once (APP_DIR."/model/Logica/logica.php");
require_once ("Conexion.php");

class PReloj extends Conectar {

    private static $instance = NULL;
    private $relojes;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new PReloj();
        }
        return self::$instance;
    }

    function NuevoReloj(Relojes $reloj) {


        $id = mysqli_real_escape_string($this->conexion(), $reloj->getid());
        $puerto = mysqli_real_escape_string($this->conexion(), $reloj->getpuerto());
        $ip = mysqli_real_escape_string($this->conexion(), $reloj->getip());
        $db = mysqli_real_escape_string($this->conexion(), $reloj->getdb());
        $idsede = mysqli_real_escape_string($this->conexion(), $reloj->getsede()->getid()); //Obtener id de la sede para la BD

        $sql = "INSERT INTO `Reloj`(`ID`,`IP`, `PUERTO`, `DB`, `idSede`) VALUES "
                . "('" . $id . "','" . $ip . "','" . $puerto . "','" . $db . "','" . $idsede ."')";

        //return $this->conexion()->query($sql) or die($this->conexion()->connect_errno);

        if (!$this->conexion()->query($sql)) {
            return "Código de error: " . $this->conexion()->errno;
        }
        return "ok";
    }

//    function BajaReloj($id) {
//
//    }

    function ModificarReloj(Relojes $reloj) {

        $id = mysqli_real_escape_string($this->conexion(), $reloj->getid());
        $puerto = mysqli_real_escape_string($this->conexion(), $reloj->getpuerto());
        $ip = mysqli_real_escape_string($this->conexion(), $reloj->getip());
        $db = mysqli_real_escape_string($this->conexion(), $reloj->getdb());
        $idsede = mysqli_real_escape_string($this->conexion(), $reloj->getsede()->getid());

        $sql = "UPDATE `Reloj` SET `puerto`= '" . $puerto . "', `ip`= '" . $ip . "', `db`= '" . $db . "', `idSede`= '" . $idsede ."' WHERE `id`= '" . $id. "'";

        if ($this->conexion()->query($sql)) {
            return 1;
        }
        return 0;
    }

    function ListarRelojes() {

        $sql = "SELECT * FROM `Reloj`";
        $consulta = $this->conexion()->query($sql);

        //recorremos el resultado con while y el método fetch_assoc
        /* la diferencia entre fetch_assoc y fetch_array es que fetch_assoc te permite hacer SOLO arrays asociativos */
        while ($filas = $consulta->fetch_assoc()) {
            //metemos cada fila de la tabla (que son arrays) dentro del array usuarios
            $this->relojes[] = $filas;
        }

        return $this->relojes; //devolvemos el array que trataremos en la vista
    }



    function BuscarReloj($id) {

        $sql = "SELECT * FROM `Reloj` WHERE ID =" . $id;

        $resultado = $this->conexion()->query($sql);

        if($resultado){
            $fila = $resultado->fetch_assoc();
            $reloj= new Relojes($fila["ID"],$fila["PUERTO"], $fila["IP"],$fila["DB"], $fila["IP"], $fila["idSede"]);
            return $reloj;
        }
        return 0;
    }


}
