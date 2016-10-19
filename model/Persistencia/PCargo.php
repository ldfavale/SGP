<?php
require_once('Conexion.php');
require_once "./Logica/Cargo.php";

class PCargo extends Conectar{
        
    private static $instance = NULL;
    private $Cargos;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new PCargo();
        }
        return self::$instance;
    }

    function NuevoCargo(Cargo $cargo){
            $denominacion = mysqli_real_escape_string($this->conexion(),$cargo->getdenominacion()) ;
            $escalafon= mysqli_real_escape_string($this->conexion(),$cargo->getescalafon()); 
            $subescalafon= mysqli_real_escape_string($this->conexion(),$cargo->getdesubescalafon()); 
            $grado= mysqli_real_escape_string($this->conexion(),$cargo->getgrado()); 
            $cargahoraria= mysqli_real_escape_string($this->conexion(),$cargo->getcargahoraria());
            $idsede= mysqli_real_escape_string($this->conexion(),$cargo->getsede());
            $regional= mysqli_real_escape_string($this->conexion(),$cargo->getregional());
            $tipo= mysqli_real_escape_string($this->conexion(),$cargo->gettipo());
            $caracter= mysqli_real_escape_string($this->conexion(),$cargo->getcaracter());
            $extencionreduccion= mysqli_real_escape_string($this->conexion(),$cargo->getextensionreduccion()); 
            
            $sql = "INSERT INTO `cargos`(`Denominacion`, `Escalafon`, `SubEscalafon`, `Grado`, `CargaHoraria`, `idSede`, `Regional`, `Tipo`, `Caracter`, `ExtencionReduccion`) VALUES ('".$denominacion."','".$escalafon."','".$subescalafon."','".$grado."','".$cargahoraria."','".$idsede."','".$regional."','".$tipo."','".$caracter."','".$extencionreduccion."')";       
            
            if($this->conexion()->query($sql)){
               return 1;
            }
            return 0;
            
    }
    function BorrarCargo($nombre){
        
        $sql = "DELETE * FROM `sedes` WHERE `nombre`='".mysqli_real_escape_string($this->conexion(),$nombre)."'";       
        if($this->conexion()->query($sql)){
               return 1;
        }
        return 0;

    }
    function ModificarCargo(Cargo $cargo, $id){
        $denominacion = mysqli_real_escape_string($this->conexion(),$cargo->getdenominacion()) ;
        $escalafon= mysqli_real_escape_string($this->conexion(),$cargo->getescalafon()); 
        $subescalafon= mysqli_real_escape_string($this->conexion(),$cargo->getdesubescalafon()); 
        $grado= mysqli_real_escape_string($this->conexion(),$cargo->getgrado()); 
        $cargahoraria= mysqli_real_escape_string($this->conexion(),$cargo->getcargahoraria());
        $idsede= mysqli_real_escape_string($this->conexion(),$cargo->getsede());
        $regional= mysqli_real_escape_string($this->conexion(),$cargo->getregional());
        $tipo= mysqli_real_escape_string($this->conexion(),$cargo->gettipo());
        $caracter= mysqli_real_escape_string($this->conexion(),$cargo->getcaracter());
        $extencionreduccion= mysqli_real_escape_string($this->conexion(),$cargo->getextensionreduccion());  
        $sql = "UPDATE `cargos` SET `Denominacion`= '".$denominacion."', `Escalafon`= '".$escalafon."', `SubEscalafon`= '".$subescalafon."', `Grado`= '".$grado."', `CargaHoraria`= '".$cargahoraria."', `idSede`= '".$idsede."', `Regional`= '".$regional."', `Tipo`= '".$tipo."', `Caracter`= '".$caracter."', `ExtencionReduccion`= '".$extencionreduccion."' WHERE `idEmpleado`= '".$id."'";       

                if($this->conexion()->query($sql)){
                   return 1;
                }
                return 0;

    }
    function BuscarCargo($id){
        $ID=mysqli_real_escape_string($this->conexion(),$id);
        
        $consulta=$this->conexion()->query("select * from cargos where id= $ID;");
	while($filas=$consulta->fetch_assoc()){
	            $this->Cargos[]=$filas;
	}
	return $this->Cargos;

    }
    function ListarCargos(){
        $consulta=$this->conexion()->query("select * from cargos;");
	while($filas=$consulta->fetch_assoc()){
	            $this->Cargos[]=$filas;
	}
	return $this->Cargos;
    }


 }