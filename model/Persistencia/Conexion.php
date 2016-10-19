<?php
require_once ($_SERVER["DOCUMENT_ROOT"].'/config/database.php');

    class Conectar extends database{

	    //Creamos un método estático que no necesita ser instanciado
	    public static function conexion(){
                $db=Conectar::getInstance();

                //new mysqli creamos o instanciamos el objeto mysqli
                //new mysqli('servidor','usuario','contraseña','nombre de la BD');
                $conexion= new mysqli($db->getHost(), $db->getUser(), $db->getPass(), $db->getDB());

                //llamamos a la conexión y hacemos una consulta para utilizar UTF-8
                $conexion->query("SET NAMES 'utf8'");

                //devolvemos la conexión para que pueda ser utilizada en otros métodos
                return $conexion;

	    }
	}






//$enlace = mysql_connect ($host, $user, $password);
//mysql_select_db($db, $enlace);
//mysql_query("SET NAMES ".$charset);
