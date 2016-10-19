<?php
// El puesto es el sensor fisico, tiene una id, nombre, y la sede a la que corresponde.
// Ejemplo  id=1 nombre= Puerta frontal sede= Rocha
class Puesto{
    private $ID;
    private $Nombre; 
    private $sede;


    
    
    function __construct($arg_ID, $arg_nombre, $arg_sede) {
                $this->ID=$arg_ID;//cargamos el argumento obtenido cuando defines el objeto
	        $this->nombre=$arg_nombre; 
	        $this->sede=$arg_sede;
       
	    }

	function getid(){
		return $this->ID;
	}
	function getnombre(){
		return $this->Nombre;
	}
        function getsede(){
		return $this->sede;
	}
        
        function setid($nro){
		$this->ID=$nro;
	}
	function setnombre($nombre){
		$this->Nombre=$nombre;
	}
	function setsede($sede){
		$this->sede=$sede;
	}
 
}

