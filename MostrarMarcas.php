<?php
require_once($_SERVER ['DOCUMENT_ROOT']."/controller/ControladorM.php");
$controladorMarcas=  ControladorM::getInstance();

$result = $controladorMarcas->BuscarMarcas($_GET["ID"]);

if(isset($result) && $result != NULL){


        $esclavos = $result;
        ?>

        <div class="table-responsive">
            <table class="table table-condensed table-hover table-responsive table-striped"> 
                <tr><td><b>ID</b></td><td><b>Userid</b></td><td><b>Fecha</b></td><td><b>Tipo</b></td> </tr> 

<?php
foreach ($esclavos as $row) {
?>

                <tr><td><?php echo $row["Logid"] ?></td><td><?php echo $row["Userid"] ?></td><td><?php echo $row["CheckTime"] ?></td><td><?php echo $row["CheckType"] ?></td></tr> 

<?php
}
?>
            </table>  
                <?php
                }


                        
                                        //}
                       
                
?>
            
            
            
     </div>       
            
