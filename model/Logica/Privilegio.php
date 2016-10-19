<?php

class Privilegio{
    private $id;
    private $nombre; 

    
    
    function __construct($arg_id, $arg_nombre) //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
	    {
	        $this->id=$arg_id; //cargamos el argumento obtenido cuando defines el objeto
	        $this->nombre=$arg_nombre;
	    }           
            
	function getid(){
		return $this->id;
	}
	function getnombre(){
		return $this->nombre;
	}       
        
        function setid($arg_id){
		$this->id=$arg_id;
	}
	function setnombre($arg_nombre){
		$this->nombre=$arg_nombre;
	} 
}