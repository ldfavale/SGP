
<?php require('core.php');

require('model/Persistencia/class.Conexion.php');

$db = new Conexion();



  $sql = "CREATE TABLE horario (
idHorario INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
tipo VARCHAR(30) NOT NULL,
descripcion VARCHAR(100) NOT NULL
)";

if ($db->query($sql) === TRUE) {

    echo "La tabla 'horario' se creo con éxito  ;)";

    $query = "INSERT INTO horario VALUES (NULL, 'fijo', '')";
    $db->query($query);
    $query = "INSERT INTO horario VALUES (NULL, 'Global', '')";
    $db->query($query);
    $query = "INSERT INTO horario VALUES (NULL, 'flexible', '')";
    $db->query($query);
    $query = "INSERT INTO horario VALUES (NULL, 'Nocturno', '')";
    $db->query($query);


} else {
    echo "Error creando tabla horario : " . $db->error;
}






  $db->close();
 ?>
