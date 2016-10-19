<?php

class Sede{
private $id;
private $Nombre;
private $Departamento; 
private $Telefono;

    function __construct($arg_id, $arg_Nombre , $arg_Departamento, $arg_Telefono) //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
	    {
                $this->id=$arg_id;
	        $this->Nombre=$arg_Nombre; //cargamos el argumento obtenido cuando defines el objeto
	        $this->Departamento=$arg_Departamento;
                $this->Telefono=$arg_Telefono;
               
	    }
            
        function getId(){
		return $this->id;
	}
	function getNombre(){
		return $this->Nombre;
	}
	function getDepartamento(){
		return $this->departamento;
	}
        function getTelefono(){
		return $this->Telefono;
	}
        
        function setId($arg_id){
		$this->id=$arg_id;
	}
	function setNombre($arg_Nombre){
		$this->Nombre=$arg_Nombre;
	}
	function setDepartamento($arg_Departamento){
		$this->Departamento=$arg_Departamento;
	}    
        function setTelefono($arg_Telefono){
		$this->Telefono=$arg_Telefono;
	} 
    
}

