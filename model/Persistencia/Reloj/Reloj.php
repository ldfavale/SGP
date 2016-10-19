<?php

/**
 * Módulo de comunicación con los relojes biométricos.
 *
 * @author Federico Ubal
 */
class Reloj {

    private $dev_id;
    private $ip;
    private $port;
    private $last_result;
    private $db;
    private $ini;

    /**
     * 
     * @param type $dev_id
     * Id del reloj
     * @param type $ip
     * Dirección IP del reloj
     * @param type $port
     * Puerto
     * @param type $db
     * Cadena de conexion a la base de datos
     */
    public function __construct($dev_id, $ip, $port=5010, $db = null) {
        $this->dev_id = $dev_id;
        $this->ip = $ip;
        $this->port = $port;
        $this->last_result = array();
        $this->db = $db;
        $this->ini = $this->exportRelojIni();
    }

    /**
     * Función que exporta el archivo de configuración para la utilidad de
     * comunicación con el reloj. Devuelve la ruta del mismo.
     * @return string
     */
    private function exportRelojIni() {
        $path = "/tmp/anviz.ini";
        $ini = fopen($path, "w");
        fwrite($ini, "[anviz]\n");
        fwrite($ini, "model = OA1000\n");
        fwrite($ini, "ip_addr = $this->ip\n");
        fwrite($ini, "ip_port = $this->port\n");
        fwrite($ini, "device_id = $this->dev_id\n");
        fwrite($ini, "\n");
        if (!is_null($this->db)) {
            fwrite($ini, "[sqlalchemy]\n");
            fwrite($ini, "uri = $this->db\n");
        }
        fclose($ini);
        return $path;
    }

    /**
     * Exporta el archivo con los datos de los funcionarios indicados
     * para que sean ingresados en el reloj. Devuelve la ruta al mismo.
     * @param array $func
     * Arreglo que contiene los funciarios a ingresar al reloj.
     * @return string
     */
    private function exportStaff(array $func) {
        $path = "/tmp/staff.csv";
        $archivo = fopen($path, "w");
        foreach ($func as $person) {
            $linea = $person->getID() . "," . "," . ","
                    . $person->getNombre() . ",1,0,6,0,"
                    . $person->getAdmin() . "\n";
            fwrite($archivo, $linea);
        }
        fclose($archivo);
        return $path;
    }

    /**
     * Devuelve el Resultado de la ultima operación realizada por la utilidad
     * de comunicación con los relojes.
     * 
     * @return array
     * El resultado está contenido en un array que contiene tres claves:
     * - comando: contiene el ultimo comando realizado.
     * - salida: contiene la salida generada de la ejecucion del comando.
     * - resultado: contiene el valor generado al finalizar dicha ejecución.
     */
    public function getUltimoResultado() {
        return $this->last_result;
    }

    /**
     * Extrae la información de las marcas. Si el parametro $all = true,
     * se extraen todas las marcas almacenadas, sino solo se extraen las
     * marcas nuevas.
     * @param bool $all
     */
    public function getMarcas($all = false) {
        if ($all) {
            $a = "-a";
        }
        $marcas = array();

        exec("anviz -c $this->ini -m " . $a, $salida, $result);
        foreach ($salida as $line) {
            $var = split(",", $line);
            array_push($marcas, new Marca($var[0], $var[1], $var[2], $var[3]));
        }
        $this->last_result = [ "comando" => "getMarcas",
            "salida" => $salida,
            "resultado" => $result];
        return $marcas;
    }

    /**
     * Extrae la información de las marcas. Si el parametro $all = true,
     * se extraen todas las marcas almacenadas, sino solo se extraen las
     * marcas nuevas.
     * @param bool $all
     */
    public function sincronizaMarcas($all = false) {
        if ($all) {
            $a = "-a";
        }
        exec("anviz -c $this->ini -s" . $a, $salida, $result);
        $this->last_result = [ "comando" => "getMarcas",
            "salida" => $salida,
            "resultado" => $result];
        return $marcas;
    }

    /**
     * Se extrae la informacion de los funcionarios contenida en el reloj.
     * @return array
     */
    public function getFuncionarios() {
        exec("anviz -c $this->ini -d", $salida, $result);
        $func = array();
        foreach ($salida as $line) {
            $var = split(",", $line);
            array_push($func, new FuncReloj($var[0], $var[3], $var[8]));
        }
        $this->last_result = [ "comando" => "getFuncionarios",
            "salida" => $salida,
            "resultado" => $result];
        return $func;
    }

    /**
     * Se ingresa la informacion de los funcionarios indicados
     * al reloj.
     * @param array $func
     * array que contiene objetos de tipo Funcionarios.
     */
    public function setFuncionarios(array $func) {
        $path = $this->exportStaff($func);
        $cmd = "anviz -c $this->ini -u $path";
        exec($cmd, $salida, $result);
        $this->last_result = [ "comando" => "setFuncionarios",
            "salida" => $salida,
            "resultado" => $result];
    }

}
