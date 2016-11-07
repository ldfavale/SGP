<?php

class Empleado{

    private $id;
    private $NombreUsuario;
    private $Contraseña;
    private $privilegio; //FK al privilegio
    private $nrofuncionario; //Corresponde al numero real del funcionario
    private $nombre;
    private $apellido;
    private $cedula;
    private $direccion;
    private $residencia;
    private $tel;
    private $cel;
    private $correo;
    private $correoinstitucional;
    private $idHorario; //Fk al horario
    private $cargo; //FK al cargo
    private $estado;//Booleano 0 inactivo 1 activo
    private $relojes; // Coleccion de los relojes en los que esta registrado el funcionario

    function __construct($arg_id, $arg_Nick , $arg_contraseña, $arg_privilegio, $arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_idhorario, $arg_cargo, $arg_estado, $arg_relojes= "") //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
	    {
                $this->id=$arg_id;
        	      $this->NombreUsuario=$arg_Nick; 
	              $this->Contraseña=$arg_contraseña;
                $this->privilegio=$arg_privilegio;
                $this->nrofuncionario=$arg_nrofuncionario;
	              $this->nombre=$arg_nombre;
	              $this->apellido=$arg_apellido;
                $this->cedula=$arg_cedula;
                $this->direccion=$arg_direccion;
                $this->residencia=$arg_residencia;
                $this->tel=$arg_tel;
                $this->cel=$arg_cel;
                $this->correo=$arg_correo;
                $this->correoinstitucional=$arg_correoinstitucional;
                $this->idHorario=$arg_idhorario;
                $this->cargo=$arg_cargo;
                $this->estado=$arg_estado;
                $this->relojes=$arg_relojes;
	    }
	function getNombreUsuario(){
		return $this->NombreUsuario;
	}
	function getContraseña(){
		return $this->Contraseña;
	}
        function getPrivilegio(){
		return $this->privilegio;
	}
	function getnrofuncionario(){
		return $this->nrofuncionario;
	}
	function getnombre(){
		return $this->nombre;
	}
	function getapellido(){
		return $this->apellido;
	}
    	function getcedula(){
		return $this->cedula;
	}
	function getdireccion(){
		return $this->direccion;
	}
    	function getresidencia(){
		return $this->residencia;
	}
	function gettel(){
		return $this->tel;
	}
    	function getcel(){
		return $this->cel;
	}
	function getcorreo(){
		return $this->correo;
	}
        function getcorreoinstitucional(){
		return $this->correoinstitucional;
	}
    	function gethorario(){
		return $this->idHorario;
	}
	function getcargo(){
		return $this->cargo;
	}
	function getid(){
		return $this->id;
	}
        function getestado(){
		return $this->estado;
	}
        function getrelojes(){
		return $this->relojes;
	}
        function setNombreUsuario($arg_nombre){
		$this->NombreUsuario=$arg_nombre;
	}
	function setContraseña($arg_pass){
		$this->Contraseña=$arg_pass;
	}
        function setPrivilegio($arg_privilegio){
		$this->privilegio=$arg_privilegio;
	}
        function setnrofuncionario($nro){
		$this->nrofuncionario=$nro;
	}
	function setnombre($nombre){
		$this->nombre=$nombre;
	}
	function setapellido($apellido){
		$this->apellido=$apellido;
	}
    	function setcedula($cedula){
		$this->cedula=$cedula;
	}
	function setdirecion($direccion){
		$this->direccion=$direccion;
	}
    	function setresidencia($residencia){
		$this->residencia=$residencia;
	}
	function settel($tel){
		$this->tel=$tel;
	}
    	function setcel($cel){
		$this->cel=$cel;
	}
	function setcorreo($correo){
		$this->correo=$correo;
	}
        function setcorreoinstitucional($correo){
		$this->correoinstitucional=$correo;
	}
    	function sethorario($horario){
		$this->idHorario=$horario;
	}
	function setcargo($cargo){
		$this->cargo=$cargo;
	}
	function setestado($estado){
		$this->estado=$estado;
	}
        function setid($id){
		$this->id=$id;
	}
        function setrelojes($relojes){
		$this->relojes=$relojes;
	}

        function  toString(){
            $string="Nombre de usuario: ".  $this->NombreUsuario.
                    " - Contrase;a: ".      $this->Contraseña.
                    " - Privilegio: ".      $this->privilegio.
                    " - Nro Funcionario: ". $this->nrofuncionario.
                    " - Nombre: ".          $this->nombre.
                    " - Apellido: ".        $this->apellido.
                    " - Cedula: ".          $this->cedula.
                    " - Direccion: ".       $this->direccion.
                    " - Residencia: ".      $this->residencia.
                    " - Tel: ".             $this->tel.
                    " - Cel: ".             $this->cel.
                    " - Correo: ".          $this->correo.
                    " - Correo INST: ".     $this->correoinstitucional.
                    " - ID horario: ".      $this->idHorario.
                    " - ID cargo: ".        $this->cargo.
                    " - Estado: ".          $this->estado;
            return $string;
        }
}
