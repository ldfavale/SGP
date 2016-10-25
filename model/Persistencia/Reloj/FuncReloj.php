<?php

/**
 * Clase que abstrae la información de los funcionarios en el reloj.
 * 
 * @author Federico Ubal
 */
class FuncReloj {

    private $id;
    private $pwd;
    private $card;
    private $nombre; // String (Máx 10 caracteres)
    private $dep;
    private $group;
    private $mode;
    private $fp;
    private $admin; //192 - Admin, 0 - Usuario

    /**
     * 
     * @param type $id
     * ID del funcionario en el reloj
     * @param type $nombre
     * Nombre del usuario
     * @param type $admin
     * Permisos del usuario en el reloj
     * @param type $dep
     * Departamento del usuario (de los configurados en el reloj)
     * @param type $group
     * Grupo de horario (de los configurados en el reloj)
     * @param type $mode
     * Modo de autentificacion
     * @param type $fp
     * Huellas registradas.
     */

    public function __construct($id, $nombre, $admin = 0, $dep = 1, $group = 0, $mode = 6, $fp = 0, $pwd = "", $card = "") {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->admin = $admin;
        $this->dep = $dep;
        $this->group = $group;
        $this->mode = $mode;
        $this->fp = $fp;
        $this->pwd = $pwd;
        $this->card = $card;
    }

    public function getID() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getAdmin() {
        return $this->admin;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getCard() {
        return $this->card;
    }

    public function getGrupo() {
        return $this->group;
    }

    public function getModo() {
        return $this->mode;
    }

    public function getFP() {
        return $this->fp;
    }

    public function getDepartamento() {
        return $this->dep;
    }

    public function setNombre($value) {
        $this->nombre = $value;
    }

    public function setAdmin($value) {
        $this->admin = $value;
    }

    public function setGrupo($value) {
        $this->group = $value;
    }

    public function setModo($value) {
        $this->mode = $value;
    }

    public function setDepartamento() {
        $this->dep = $value;
    }

}
