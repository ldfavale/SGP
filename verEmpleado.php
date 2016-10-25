<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once(APP_DIR."/controller/Controller.php");

$controlador = ControladorE::getInstance();
$controladorMarcas=  ControladorM::getInstance();

$idEmpleado = $_GET['id'];

$resultado= $controlador->obtenerEmpleado($idEmpleado);

if(isset($_POST['desde']) and isset($_POST['hasta'])){
  $desde = $_POST['desde'];
  $hasta = $_POST['hasta'];

}else{

//    $desde = date('Y-m-d');
//    $hasta = $desde;

    $desde = date('Y')."-".date('m')."-1";
    $hasta = date('Y-m-d');


}
$result = $controladorMarcas->BuscarMarcas($idEmpleado,$desde,$hasta);

if(isset($_POST['BajaEmpleado'])) {
 if($controlador->BajaEmpleado($_POST['id'])){
     echo '<div class="alert alert-info alert-dismissible" role="alert">'.
                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.
                     'El usuario a sido dado de baja con exito</div>';
 }else{
     echo '<div class="alert alert-info alert-dismissible" role="alert">'.
                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.
                     'Ocurrio un error durante la baja intentelo mas tarde</div>';
 }

}

if(isset($_POST['SubirImagen'])) {

    $subirimagen= new SubirImagen();
    $subirimagen->__set("_name", "perfil".$_POST['nick']);
    $subirimagen->init($_FILES['imagen']);

}

//********************************** BUSQUEDA NORMAL ******************************************************

if (isset($resultado)) {
    $exito = true;
    $empleado = $resultado;
    $marcas = $result;
} else {
    $exito = false;
    if (is_string($resultado)) {

        $error = $resultado;
    } else {
        $error = "No se pudo pudo obtener la solicitud";
    }
}
?>

<!-- Barra superior-->
<ul class="list-inline pull-right">
    <li><a title="Modificar" data-toggle="modal" href="index.php?sec=ModificarEmpleado&id=<?php echo $idEmpleado; ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
</ul>
<a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> Perfil Funcionario</strong></a>
<hr>
<!--End  Barra superior-->


<div class="row">
    <div class="col-md-12">
        <div class="row">

    <?php
            if($exito == false){

             ?>
            <div class="col-md-12">
                <div class="alert alert-danger">
                     <button type="button" class="close" data-dismiss="alert">×</button>
                         <strong>Error!</strong> <?php echo $error ?>

                </div>
            </div>
           <?php
            }else
            {
?>
            <div class="col-md-3">

                <?php
                    $ext=null;
                    $ruta= 'public/img/perfil'.$empleado->getNombreUsuario();
                    if(is_file($ruta.".jpg")) $ext=".jpg";
                    if(is_file($ruta.".gif")) $ext=".gif";
                    if(is_file($ruta.".png")) $ext=".png";

                ?>

                <img src="<?php echo $ruta.$ext;?>" style="height: 300px; width: 300px;"class="center-block img-circle img-responsive" onerror="this.src='public/img/user_placeholder.png';">


<!--            <h3 class="text-center">Informatica</h3>
                <p class="text-center">Desarrollador</p>-->
<br>
                <form id="subirImg" name="SubirImagen" enctype="multipart/form-data" method="post" action="index.php?sec=verEmpleado&id=<?php echo $empleado->getid();?>">
                    <label for="imagen">Subir imagen:</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                    <input type="hidden" name="nick" value="<?php echo $empleado->getNombreUsuario();?>">
                    <input type="file" name="imagen" id="imagen" />
                    <input type="submit" name="SubirImagen" id="SubirImagen" value="Subir imagen" />
                </form>

            </div>
            <div class=" col-md-offset-1 col-md-8">
                <h1><?php echo $empleado->getnombre()." ".$empleado->getapellido()?>  </h1>

                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <ol class=" list-unstyled text-left">
                            <li>ID en Reloj:&nbsp;</li>
                            <li>Numero de funcionario:&nbsp;</li>
                            <li>Cedula:</li>
                            <li>Direccion:</li>
                            <li>Residencia:</li>
                            <li>Telefono:</li>
                            <li>Celular:</li>
                            <li>Email:</li>
                            <li>Email Institucional:</li>
                            <li>Password: </li>
<?php if($_SESSION['tipo']!= 3){  ?>
                            <li>
                                <br>
                                <form action="index.php?sec=verEmpleado&id=<?php echo $empleado->getid();?>" method="POST" role="form" class="form-horizontal">
                                    <input type="hidden" name="id" value="<?php echo $empleado->getid();?>">
                                    <!-- Button -->
                                    <div class="form-group">
                                      <div class="col-md-4">
                                        <button id="" name="BajaEmpleado" class="btn btn-danger">Dar de baja</button>
                                      </div>
                                    </div>
                                </form>
                            </li>
<?php } ?>
                        </ol>
                    </div>
                    <div class="col-xs-6">
                        <ol class="list-unstyled text-left text-muted">
                            <li><?php echo $empleado->getid();?></li>
                            <li><?php echo $empleado->getnrofuncionario()?></li>
                            <li><?php echo $empleado->getcedula()?></li>
                            <li><?php echo $empleado->getdireccion()?></li>
                            <li><?php echo $empleado->getresidencia()?></li>
                            <li><?php echo $empleado->gettel()?></li>
                            <li><?php echo $empleado->getcel()?></li>
                            <li><?php echo $empleado->getcorreo()?></li>
                            <li><?php echo $empleado->getcorreoinstitucional()?></li>
                            <li> XXXXXXXXXXX <a title="Setear" data-toggle="modal" href="index.php?sec=resetPass&id=<?php echo $empleado->getid(); ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
                        </ol>
                    </div>
                </div>

                <form class="form form-inline" action="PHPExcel/crearExcel.php" method="post">

                  <input name="id" type="hidden" value="<?php echo $empleado->getid()?>">
                  <input name="nombre" type="hidden" value="<?php echo $empleado->getnombre()?>">
                  <input name="apellido" type="hidden" value="<?php echo $empleado->getapellido()?>">
        <!-- Form Name -->
        <!-- ******************** CONTRALOR *************************************** -->
        <legend>Contralor</legend>

        <!-- Select Basic -->
        <div class="form-group ">
          <label class=" control-label" for="anio"> A&ntilde;o </label>

            <select id="anio" name="anio" class="form-control input-sm">
              <option value="<?php echo date("Y")-3;?>"><?php echo date("Y")-3;?></option>
              <option value="<?php echo date("Y")-2;?>"><?php echo date("Y")-2;?></option>
              <option value="<?php echo date("Y")-1;?>"><?php echo date("Y")-1;?></option>
              <option selected value="<?php echo date("Y");?>"><?php echo date("Y");?></option>
            </select>

        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class=" control-label" for="mes"> Mes </label>

            <select id="mes"  name="mes" class="form-control input-sm">


              <option value="1">Enero</option>
              <option value="2">Febrero</option>
              <option value="3">Marzo</option>
              <option value="4">Abril</option>
              <option value="5">Mayo</option>
              <option value="6">Junio</option>
              <option value="7">Julio</option>
              <option value="8">Agosto</option>
              <option value="9">Setiembre</option>
              <option value="10">Octubre</option>
              <option value="11">Noviembre</option>
              <option value="12">Diciembre</option>

            </select>

        </div>

            <!-- Button -->
            <div class="form-group">
              <!-- <label class="col-md-4 control-label" for="singlebutton"></label> -->

                <button  class="btn btn-primary input-sm">Descargar</button>

            </div>
        </form>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1 class="text-primary">Marcas&nbsp;</h1>
        </div>


        <form class="form-inline " action="index.php?sec=verEmpleado&id=<?php echo $empleado->getid()?>" method="post">

<!-- Desde-->
<!-- <div class="form-group ">
  <label class=" control-label" for="desde">Desde:</label>

  <input id="desde" name="desde" type="date" placeholder="aaaa-mm-dd" class="form-control input-sm">


</div>


<div class="form-group ">
  <label class="control-label" for="hasta">Hasta:</label>

  <input id="hasta" name="hasta" type="date" placeholder="aaaa-mm-dd" class="form-control input-sm">


</div> -->

<div class="input-daterange input-group" id="datepicker">
    <input type="text"  class="datepicker  form-control" name="desde" readonly />
    <span class="input-group-addon glyphicon glyphicon-calendar ">  </span>
    <input type="text" class="datepicker  form-control" name="hasta"  readonly />
    <span class="input-group-addon glyphicon glyphicon-calendar">

  </span>
  <script>
  $(document).ready(function(){

    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        todayHighlight: true,
        autoclose: true,
    });
  });


  </script>
</div>

<script>



</script>
<div class="form-group ">
  <!-- <label class="col-md-4 control-label" for="singlebutton"></label> -->

    <input  class="btn btn-info input-sm" type="submit"></input>
<!-- <span class="glyphicon glyphicon-search"></span> -->
</div>

</fieldset>
</form>
<hr>

    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped">
            <tbody>
              <thead>
                  <tr>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Tipo Marca</th>
                      <th>User Id</th>
                  </tr>
              </thead>
<?php
if(!is_string($result)){
        foreach ($result as $row) {

               $datetime = date_create($row["datetime"]);
                $fecha = date_format($datetime, 'd/m/Y');
                $hora =  date_format($datetime,'H:i');

        ?>
                       <tr>
                            <td><?php echo $fecha?></td>
                            <td><?php echo $hora?></td>
                            <td><?php if( $row["type_code"] == 0){echo 'Entrada';}else{echo'Salida';} ?></td>
                            <td><?php echo $row["user_code"]?></td>
                        </tr>
<?php

        //echo $row['fecha']."    ".$row['hora '];
        }
}else{
       ?>
       <div class="alert alert-info alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $result; ?>
</div>
       <?php
}
?>

            </tbody>

        </table>
    </div>
</div>

<?php
}
?>
