<?php

/**
 * Clase que abstrae la informacion de las marcas del reloj.
 *
 * @author Federico Ubal
 */
class Marca {

    private $uid;
    private $date;
    private $back;
    private $type;

    /**
     * @param type $uid
     * id del usuario
     * @param type $date
     * Fecha de la marca
     * @param type $back
     * Modo en que se realizo la marca.
     * @param type $type
     * Tipo de marca.
     */
    public function __construct($uid, $date, $back, $type) {
        $this->uid = $uid;
        $this->date = $date;
        $this->back = $back;
        $this->type = $type;
    }

    public function getUID() {
        return $this->uid;
    }

    public function getFecha() {
        return $this->date;
    }

    public function getTipoBackup() {
        return $this->back;
    }

    public function getTipo() {
        return $this->type;
    }

}
