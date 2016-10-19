<?php
/* 
 *   @author Fredd Hannay
 */
class Horario{
var $HraEntrada;
var $HraSalida; 
var $dias;
var $Gobal_Fijo;


    function __construct($arg_HraEntrada , $arg_HraSalida, $arg_dias, $arg_G_F) //funcion que se autoejecuta cuando defines un objeto, le puedes poner argumentos de inicialización, por defecto todo es vacio
	    {
	        $this->HraEntrada=$arg_HraEntrada; //cargamos el argumento obtenido cuando defines el objeto
	        $this->HraSalida=$arg_HraSalida;
                $this->dias=$arg_dias;
                $this->Global_Fijo=$arg_G_F;
	    }
    function getHraEntrada(){
		return $this->HraEntrada;
            }
    function getHraSalida(){
		return $this->HraSalida;
            }
    
}
