<?php
class Marca{
    private $id;
    private $userid; //
    private $tipo;
    private $fecha;
    //private $puesto; Campo 
    
    
    function __construct($arg_id, $arg_userid, $arg_tipo, $arg_fecha) {
                $this->id=$arg_id;
	        $this->userid=$arg_userid; 
	        $this->tipo=$arg_tipo;
                $this->fecha=$arg_fecha;
                
	    }
    	function getid(){
		return $this->id;
	}
	function getuserid(){
		return $this->userid;
	}
	function gettipo(){
		return $this->tipo;
	}
        function getfecha(){
		return $this->fecha;
	}
        
        
        function setid($id){
		$this->id=$id;
	}
	function setuserid($userid){
		$this->userid=$userid;
	}
	function settipo($tipo){
		$this->tipo=$tipo;
	}
    	function setfecha($fecha){
		$this->fecha=$fecha;
	}
}
