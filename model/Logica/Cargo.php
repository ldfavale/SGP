<?php
/*
 *   Clase Cargo
 *   @author Fredd Hannay
 */

class Cargo{
    private $denominacion;
    private $escalafon; 
    private $subescalafon; 
    private $grado; 
    private $cargahoraria;
    private $idsede;
    private $regional;
    private $tipo;
    private $caracter;
    private $extencionreduccion; 
    
    
    function __construct($arg_denominacion , $arg_escalafon, $arg_subescalafon, $arg_grado, $arg_cargahoraria, $arg_sede, $arg_regional, $arg_tipo, $arg_caracter, $arg_extred) //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
	    {
	        $this->denominacion=$arg_denominacion; //cargamos el argumento obtenido cuando defines el objeto
	        $this->escalafon=$arg_escalafon;
                $this->subescalafon=$arg_subescalafon;
                $this->grado=$arg_grado;
                $this->cargahoraria=$arg_cargahoraria;
                $this->idsede=$arg_sede;
                $this->regional=$arg_regional;
                $this->tipo=$arg_tipo;
                $this->caracter=$arg_caracter;
                $this->extencionreduccion=$arg_extred;

	    }
            
            
	function getdenominacion(){
		return $this->denominacion;
	}
	function getescalafon(){
		return $this->escalafon;
	}
        function getdesubescalafon(){
		return $this->subescalafon;
	}
	function getgrado(){
		return $this->grado;
	}
        function getcargahoraria(){
		return $this->cargahoraria;
	}
	function getsede(){
		return $this->idsede;
        }
        function getregional(){
		return $this->regional;
	}
	function gettipo(){
		return $this->tipo;
	}
        function getcaracter(){
		return $this->caracter;
	}
	function getextensionreduccion(){
		return $this->extencionreduccion;
	}       
        
        
        function setdenominacion($arg_denominacion){
		$this->denominacion=$arg_denominacion;
	}
	function setescalofon($arg_escalofon){
		$this->escalafon=$arg_escalofon;
	}
        function setsubescalofon($arg_subescalofon){
		$this->subescalafon=$arg_subescalofon;
	}
	function setgrado($arg_grado){
		$this->grado=$arg_grado;
	}
        function setcargahoraria($arg_cargahoraria){
		$this->cargahoraria=$arg_cargahoraria;
	}
	function setsede($arg_sede){
		$this->idsede=$arg_sede;
	}
        function setregional($arg_regional){
		$this->regional=$arg_regional;
	}
	function settipo($arg_tipo){
		$this->tipo=$arg_tipo;
	}
        function setcaracter($arg_caracter){
		$this->caracter=$arg_caracter;
	}
	function setextensionreduccion($arg_extred){
		$this->extencionreduccion=$arg_extred;
	}
                        
}    
