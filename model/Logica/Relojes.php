<?php

class Relojes {
    
    private $id;
    private $puerto; //Corresponde al numero real del funcionario
    private $ip;
    private $db;
    private $sede;
    
    
    function __construct($arg_id, $arg_puerto, $arg_ip, $arg_db, $arg_sede) //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
	    {
                $this->id=$arg_id;//cargamos el argumento obtenido cuando defines el objeto
	        $this->puerto=$arg_puerto; 
	        $this->ip=$arg_ip;
                $this->db=$arg_db;
                $this->sede=$arg_sede;
                
	    }
	function getid(){
		return $this->id;
	}            
	function getpuerto(){
		return $this->puerto;
	}
	function getip(){
		return $this->ip;
	}
    	function getdb(){
		return $this->db;
	}
	function getsede(){
		return $this->sede;
	}
    	
        
        function setid($id){
		$this->id=$id;
	}
	function setpuerto($puerto){
		$this->puerto=$puerto;
	}
	function setip($ip){
		$this->ip=$ip;
	}
    	function setdb($db){
		$this->db=$db;
	}
	function setsede($sede){
		$this->sede=$sede;
	}
    	
}
