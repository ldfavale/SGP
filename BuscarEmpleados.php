<?php

 
require_once($_SERVER ['DOCUMENT_ROOT']."/controller/Controller.php");
$controlador = ControladorE::getInstance();
$busqueda = null;

//********************************** BUSQUEDA AVANZADA ******************************************************

if(isset($_REQUEST['formBuscarEmpleadosAvanzada'])) {
    
    
$busqueda['idEmpleado'] = $_REQUEST['idempleado'];
$busqueda['nrofuncionario'] = $_REQUEST['nrofuncionario'];
$busqueda['nombre'] = $_REQUEST['nombre'];
$busqueda['apellido'] = $_REQUEST['apellido'];
$busqueda['cedula'] = $_REQUEST['cedula'];
$busqueda['direccion'] = $_REQUEST['direccion'];
$busqueda['residencia'] = $_REQUEST['residencia'];
$busqueda['telefono'] = $_REQUEST['telefono'];
$busqueda['celular'] = $_REQUEST['celular'];
$busqueda['email'] = $_REQUEST['email'];
$busqueda['emailinstitucional'] = $_REQUEST['emailinstitucional'];
$busqueda['horario'] = $_REQUEST['horario'];
$busqueda['cargo'] = $_REQUEST['cargo'];
$busqueda['estado'] = $_REQUEST['estado']; //Booleano

}
 
//***********************************FIN BUSQUEDA AVANZADA***************************************************//
//********************************** BUSQUEDA  NORMAL *******************************************************//

if(isset($_REQUEST['formBuscarEmpleados'])) {

$busqueda['busqueda'] = $_REQUEST['busqueda'];
}
//
//if(!isset($busqueda) && $busqueda != null)
//{
//    $result = null;
//}else{
//    $result = $controlador->BuscarEmpleados($busqueda);
//}


    $result = $controlador->BuscarEmpleados($busqueda);


?>
<!--*********************************************NUEVO*********************************************************************************************************-->
<!--***************************************************************************************************************************************************************-->


            <!-- column 2 -->
<!--            <ul class="list-inline pull-right">
                <li><a href="#"><i class="glyphicon glyphicon-cog"></i></a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-comment"></i><span class="count">3</span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">1. Is there a way..</a></li>
                        <li><a href="#">2. Hello, admin. I would..</a></li>
                        <li><a href="#"><strong>All messages</strong></a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
                <li><a title="Add Widget" data-toggle="modal" href="#addWidgetModal"><span class="glyphicon glyphicon-plus-sign"></span> Add Widget</a></li>
            </ul>-->
            <a href="#"><strong><i class="glyphicon glyphicon-user"></i> Funcionarios</strong></a>
            <hr>

            <div class="row">
                <!-- center left-->
             <div class="col-xs-12">   
<!--****************************************************** BUSQUEDA *****************************************************************-->
                
                
                
        <form action="index.php?sec=BuscarEmpleados" method="POST" role="form" class="form">

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" name="busqueda" class="form-control" placeholder="Buscar Empleados...">
                        <span class="input-group-btn">
                            <button class="btn btn-default"  type="submit"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                        <input type="hidden" name="formBuscarEmpleados">
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <!--
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Buscar Empleados"/>
                        </div>-->

        </form>

        <a class="" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Busqueda Avanzada  <span class="caret"></span>
        </a>

        <div class="collapse" id="collapseExample">
            <div class="well">



                <!--      *****************        BUSQUEDA AVANZADA     *******************************-->
                <form action="index.php?sec=BuscarEmpleados" class="form" method="POST">

                <div class="form-group col-md-3">
                    <label for="nrofuncionario">Nro funcionario</label>   
                    <input type="number" class="form-control input-sm " name="nrofuncionario" placeholder="Nro Funcionario"/>
                </div>

                    <div class="form-group col-md-3">
                        <label for="nombre">Nombre</label>
                        <input type="text"   class="form-control input-sm" name="nombre"         placeholder="Nombre"/>
                    </div>    

                    <div class="form-group col-md-3">
                        <label for="apellido">Apellido</label>
                        <input type="text"  class="form-control input-sm col-md-3"  name="apellido"       placeholder="apellido"/>
                    </div>   

                    <div class="form-group col-md-3"> 
                        <label for="cedula">Cedula</label>
                        <input type="text"  class="form-control input-sm"  name="cedula" placeholder="cedula"/>
                    </div>   

                    <div class="form-group col-md-3">
                        <label for="direccion">Direccion</label>
                        <input type="text"   class="form-control input-sm" name="direccion"      placeholder="direccion"/>
                    </div>  

                    <div class="form-group col-md-3 ">
                        <label for="residencia">Residencia</label>
                        <input type="text"   class="form-control input-sm" name="residencia"     placeholder="residencia"/>
                    </div>  

                    <div class="form-group col-md-3">
                        <label for="telefono">Telefono</label>
                        <input type="tel"     class="form-control input-sm" name="telefono"       placeholder="telefono"/>	
                    </div>  

                    <div class="form-group col-md-3">
                        <label for="celular">Celular</label>
                        <input type="tel"     class="form-control input-sm" pattern="[0-9]{9}" name="celular" placeholder="celular"/>
                    </div>   

                    <div class="form-group col-md-3">
                        <label for="nombre">Email</label>
                        <input type="email" class="form-control input-sm"   name="email"          placeholder="email"/>
                    </div>   

                    <div class="form-group col-md-3">
                        <label for="email">Email Inst</label>
                        <input type="text"   class="form-control input-sm"  name="emailinstitucional" placeholder="emailinstitucional"/>
                    </div>   


                    <div class="form-group col-md-3">
                        <label for="horario">Horario</label>
                        <input type="text"   class="form-control input-sm"  name="horario"        placeholder="horario"/>
                    </div>  

                    <div class="form-group col-md-3">
                        <label for="nombre">Nombre</label>
                        <input type="text"    class="form-control input-sm" name="cargo"          placeholder="cargo"/>
                    </div>  

                    <div class="form-group col-md-3">
                        <label for="estado">Estado</label>
                        <input type="text"    class="form-control input-sm" name="estado"         placeholder="estado"/>
                    </div>  

                    <div class="form-group col-md-3">
                        <label for="idempleado">id</label>
                        <input type="text"  class="form-control input-sm" name="idempleado" placeholder="idempleado"/>
                    </div>  
                    <div class="clearfix"> </div>
                    <div class="form-group col-md-6 ">
                        <input type="hidden" name="formBuscarEmpleadosAvanzada">
                        <input type="submit" id="submit" class="btn btn-sm btn-primary "  value=" Buscar ">
                    </div>  
                    <div class="clearfix"> </div>
                </form>    

<!-- ************************** FIN BUSQUEDA AVANZADA ***********************************************-->
            </div>
        </div>



        <hr>


<?php
    if(isset($result) && $result != NULL){

?>
        <div class="table-responsive">
            <table class="table table-condensed table-hover table-responsive table-striped"> 
                <tr><td><b>Nombre</b></td><td><b>Apellido</b></td>      <td><b>Cedula</b></td><td><b>Direccion</b></td><td><b>Residencia</b></td><td><b>Telefono</b></td><td><b>Cel</b></td><td><b>Correo</b></td><td><b>CorreoInstitucional</b></td> </tr> 

<?php
        foreach ($result as $row) {
?>

                <tr onclick="document.location = 'index.php?sec=verEmpleado&id=<?php echo $row["idEmpleado"] ?>'"><td><?php echo $row["Nombre"] ?></td><td><?php echo $row["Apellido"] ?></td><td><?php echo $row["Cedula"] ?></td><td><?php echo $row["Direccion"] ?></td><td><?php echo $row["Residencia"] ?></td><td><?php echo $row["Tel"] ?></td><td><?php echo $row["Cel"] ?></td><td><?php echo $row["Correo"] ?></td><td><?php echo $row["CorreoInstitucional"] ?></td></tr> 

<?php
}
?>
            </table>  
<?php
                }
                else{
                        if (isset($_POST['formBuscarEmpleados'])) {


//                                        $error = $_GET['error'];

//                                        if($_GET['error'] == '1'){
                                       ?>
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <b>Lo sentimos.</b> No se encontro la busqueda solicitada.
                                    </div> 

                        <?php
                                        //}
                       }
                }
?>
            
            
            
       </div>               
    </div> 
  </div>
            
