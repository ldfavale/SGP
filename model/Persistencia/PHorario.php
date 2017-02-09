<?php

/*
 * L Privilegio
 * @author Fredd Hannay
 */

require_once (APP_DIR."/model/Logica/logica.php");
require_once ("Conexion.php");

class PHorario extends Conectar {

    private static $instance = NULL;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new PHorario();
        }
        return self::$instance;
    }

    function ListarHorarios() {

        $sql = "SELECT * FROM `horario`";


        if($consulta = $this->conexion()->query($sql)){

            while ($fila = $consulta->fetch_assoc()) {
            $horario = new Privilegio($fila["idHorario"],$fila["tipo"]);
            $horarios[] = $horario;
            }
            return $horarios;
        }

        return "error";

    }

}
