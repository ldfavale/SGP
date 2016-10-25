<?php
require_once (APP_DIR."/model/Logica/logica.php");
require_once('Conexion.php');

class PSede extends Conectar{

    private static $instance = NULL;


    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new PSede();
        }
        return self::$instance;
    }

    function NuevaSede($sede){
            $nombre = mysqli_real_escape_string($this->conexion(),$sede->getNombre()) ;
            $departamento= mysqli_real_escape_string($this->conexion(),$sede->getDepartamento());
            $telefono= mysqli_real_escape_string($this->conexion(),$sede->getTelefono());
            $sql = "INSERT INTO `sedes`(`Nombre`, `Departamento`, `Telefono`) VALUES ('".$nombre."','".$departamento."','".$telefono."')";

            if($this->conexion()->query($sql)){
               return 1;
            }
            return 0;

    }
//    function BorrarSede($nombre){
//
//        $sql = "DELETE * FROM `sedes` WHERE `Nombre`='".mysqli_real_escape_string($this->conexion(),$nombre)."'";
//        if($this->conexion()->query($sql)){
//               return 1;
//        }
//        return 0;
//
//    }
    function ModificarSede(Sede $sede){
            $id= mysqli_real_escape_string($this->conexion(),$sede->getId()) ;
            $nombre = mysqli_real_escape_string($this->conexion(),$sede->getNombre()) ;
            $departamento= mysqli_real_escape_string($this->conexion(),$sede->getDepartamento());
            $telefono= mysqli_real_escape_string($this->conexion(),$sede->getTelefono());
            $sql = "UPDATE `sedes` SET `Nombre`= '".$nombre."', `Departamento`= '".$departamento."', `Telefono`= '".$telefono."' WHERE `idSede`= '".$id."'";

                if($this->conexion()->query($sql)){
                   return 1;
                }
                return 0;

    }
    function BuscarSede($valorid){
        $id=mysqli_real_escape_string($this->conexion(),$valorid);
        $sql= "select * from `sedes` where `idSede`= '".$id."'";
        $consulta=$this->conexion()->query($sql);

        while($filas=$consulta->fetch_assoc()){
	            $sede[]=$filas;
	}

	return $sede;

    }
    function ListarSedes(){
        $consulta=$this->conexion()->query("select * from sedes;");
	while($filas=$consulta->fetch_assoc()){
	            $Sedes[]=$filas;
	}
	return $Sedes;
    }

}
