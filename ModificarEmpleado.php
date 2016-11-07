    <script>
      function ValidarNumero(numero){
        if (!/^([0-9])*$/.test(numero))
          alert("El valor " + numero + " del campo no es un número");
      }

      }
    </script>

<?php

require_once(APP_DIR."/controller/Controller.php");
require_once(APP_DIR."/model/Logica/logica.php");
$controlador = ControladorE::getInstance();



//**********************************  ******************************************************

if(isset($_POST['Confirmar'])) {

    $arg_id= $_POST['id'];
    $arg_nick= $_POST['nick'];
    $arg_nrofuncionario= $_REQUEST['nrofuncionario'];
    $arg_nombre = $_REQUEST['nombre'];
    $arg_apellido = $_REQUEST['apellido'];
    $arg_cedula= $_REQUEST['cedula'];
    $arg_direccion= $_REQUEST['direccion'];
    $arg_residencia= $_REQUEST['residencia'];
    $arg_tel = $_REQUEST['telefono'];
    $arg_cel = $_REQUEST['celular'];
    $arg_correo = $_REQUEST['email'];
    $arg_correoinstitucional= $_REQUEST['emailinstitucional'];
    $arg_horario= $_POST['horario'];
    $arg_cargo= 0;
    $arg_estado= 1;//Booleano
    $arg_privilegio=$_POST['privilegio'];
    $arg_arrayrelojes=null;

    if(isset($_POST['checkboxes'])){
        if($_SESSION['tipo']== 1){
            $arg_arrayrelojes=$_POST['checkboxes'];
        }
        else{ ?>
                     <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <b>Cuidado!</b> Para registrarte en otros departamentos contacta a RRHH.
                    </div>
     <?php   }

    }


    $result=$controlador->ModificarEmpleado($arg_id,$arg_nick,$arg_privilegio, $arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_horario, $arg_cargo, $arg_estado, $arg_arrayrelojes);

    if($result){
?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <b>Excelente</b> se a modiciado correctamente.
                    </div>

<?php }
    else{
        echo "Error: ModificarEmpleado.php ".$result;
    }
}
    if(isset($_GET['id'])){$empleado=$controlador->obtenerEmpleado($_GET['id']);}

?>

<!-- Barra superior-->
<a href="#"><strong><i class="glyphicon glyphicon-pencil"></i> Modificar Funcionario</strong></a>
<hr>
<!--End  Barra superior-->

<form action="index.php?sec=ModificarEmpleado&id=<?php echo $empleado->getid();?>" method="POST" role="form" class="form-horizontal">

<fieldset>

<!-- Text input User Name-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Nick" >Nombre de Usuario:</label>
  <div class="col-md-4">
      <input id="nick" name="nick" placeholder="UserName" class="form-control input-md" required="" type="text" value="<?php echo $empleado->getNombreUsuario(); ?>" OnFocus="this.blur()">

  </div>
</div>

<!-- Text input Numero de funcinario -->
<div class="form-group">
  <label class="col-md-4 control-label" for="nrofuncionario">N°</label>
  <div class="col-md-4">
      <input id="nrofuncionario" name="nrofuncionario" placeholder="Numero de funcionario" class="form-control input-md" required="" type="text" value="<?php echo $empleado->getnrofuncionario(); ?>" onkeyup="ValidarNumero(this.value); " onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
  </div>
</div>

<!-- Text input Nombre-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Nombre">Nombre</label>
  <div class="col-md-4">
  <input id="Nombre" name="nombre" placeholder="Nombre" class="form-control input-md" required="" type="text" value="<?php echo $empleado->getnombre(); ?>">

  </div>
</div>

<!-- Text input Apellido-->
<div class="form-group">
  <label class="col-md-4 control-label" for="apellido">Apellido</label>
  <div class="col-md-4">
  <input id="apellido" name="apellido" placeholder="Apellido" class="form-control input-md" type="text" value="<?php echo $empleado->getapellido(); ?>">

  </div>
</div>

<!-- Text input Cedula-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cedula">Cedula</label>
  <div class="col-md-4">
      <input id="cedula" name="cedula" placeholder="12345678" class="form-control input-md" maxlength="8" required="" type="text" value="<?php echo $empleado->getcedula(); ?>" onkeyup="ValidarNumero(this.value); " onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">

  </div>
</div>

<!-- Text input Residencia-->
<div class="form-group">
  <label class="col-md-4 control-label" for="residencia">Lugar de residencia</label>
  <div class="col-md-4">
  <input id="residencia" name="residencia" placeholder="ej: Maldonado" class="form-control input-md" type="text" value="<?php echo $empleado->getresidencia(); ?>">

  </div>
</div>

<!-- Text input Direccion-->
<div class="form-group">
  <label class="col-md-4 control-label" for="direccion">Direccion</label>
  <div class="col-md-4">
  <input id="direccion" name="direccion" placeholder="Roman Guerra 1999" class="form-control input-md" type="text" value="<?php echo $empleado->getdireccion(); ?>">

  </div>
</div>

<!-- Text input Telefono-->
<div class="form-group">
  <label class="col-md-4 control-label" for="telefono">Telefono</label>
  <div class="col-md-4">
      <input id="telefono" name="telefono" placeholder="Tel" class="form-control input-md" type="text" value="<?php echo $empleado->gettel(); ?>" onkeyup="ValidarNumero(this.value); " onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">

  </div>
</div>

<!-- Text input Celular-->
<div class="form-group">
  <label class="col-md-4 control-label" for="celular">Celular</label>
  <div class="col-md-4">
      <input id="celular" name="celular" placeholder="Cel" class="form-control input-md" maxlength="9" required="" type="text" value="<?php echo $empleado->getcel(); ?>" onkeyup="ValidarNumero(this.value); " onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">

  </div>
</div>

<!-- Text input Correo -->
<div class="form-group">
  <label class="col-md-4 control-label" for="correo">Correo</label>
  <div class="col-md-4">
      <input id="correo" name="email" placeholder="Correo" class="form-control input-md" type="email" value="<?php echo $empleado->getcorreo(); ?>">

  </div>
</div>

<!-- Text input Correo Institucional-->
<div class="form-group">
  <label class="col-md-4 control-label" for="correoinstitucional">Correo Institucional</label>
  <div class="col-md-4">
      <input id="correoinstitucional" name="emailinstitucional" placeholder="Correo Institucional" class="form-control input-md"  type="email" value="<?php echo $empleado->getcorreoinstitucional();?>">

  </div>
</div>

<!-- Text input
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">Horario</label>
  <div class="col-md-4">
  <input id="textinput" name="textinput" placeholder="Horario" class="form-control input-md" type="text">
  </div>
</div>

 Text input
<div class="form-group">
  <label class="col-md-4 control-label" for="cargo">Cargo</label>
  <div class="col-md-4">
  <input id="cargo" name="cargo" placeholder="Cargo" class="form-control input-md" type="text">

  </div>
</div>-->

<!-- Select Basic PRIVILEGIOS -->

<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Seleccione Privilegio:</label>
  <div class="col-md-4">
    <select id="selectbasic" name="privilegio" class="form-control">
      <?php

            $controlador2 = ControladorE::getInstance();
            $privilegios= $controlador2->ListarPrivilegios();

            foreach ($privilegios as $privilegio){

                if($empleado->getPrivilegio()==$privilegio->getid()){
                    echo '<option selected value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';
                }
                else{
                    if($_SESSION['tipo']== 1){
                        echo '<option value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';
                    }
                    else{
                        //echo '<option disabled value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';
                    }
                }
            }

      ?>
    </select>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Horario:</label>
  <div class="col-md-4">
    <select id="" name="horario" class="form-control">

      <option value="1"> Fijo</option>
      <option value="2"> Global</option>
      <option value="3"> Flexible</option>
      <option value="4"> Nocturno</option>
            <!-- // $controlador2 = ControladorE::getInstance();
            // $privilegios= $controlador2->ListarPrivilegios();
            //
            // foreach ($privilegios as $privilegio){
            //
            //     if($empleado->getPrivilegio()==$privilegio->getid()){
            //         echo '<option selected value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';
            //     }
            //     else{
            //         if($_SESSION['tipo']== 1){
            //             echo '<option value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';
            //         }
            //         else{
            //             //echo '<option disabled value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';
            //         }
            //     }
            // } -->


    </select>
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="checkboxes">Seleccione los sensores</label>
  <div class="col-md-4">

      <?php $controladorsede  =ControladorS::getInstance();
      $controladorreloj= ControladorR::getInstance();

            $result= $controladorreloj->ListarRelojes();
            $count=0;

            if(isset($result)){

                if($empleado->getrelojes()!=0){
                    foreach ($empleado->getrelojes() as $reloj){
                        $arrayidrelojes[]=$reloj->getid();
                    }
                }else{
                    $arrayidrelojes[]=0;
                }

                foreach ($result as $row){

                    echo '<label class="checkbox-inline" for="checkboxes-'.$count.'">';
                    if(in_array($row['ID'], $arrayidrelojes)){
                        echo '<input name="checkboxes[]" id="checkboxes-'.$count.'" value="'.$row["ID"].'" type="checkbox" checked disabled>';
                    }
                    else{
                        echo '<input name="checkboxes[]" id="checkboxes-'.$count.'" value="'.$row["ID"].'" type="checkbox">';
                    }

                    $sede=$controladorsede->BuscarSede($row["idSede"]);
                    echo $sede[0]["Nombre"];
                    unset($sede);
                    echo '</label>';
                    $count++;
                }

            }
      ?>

  </div>
</div>
<input type="hidden" name="id" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}?>">
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="">Modificar Funcionario</label>
  <div class="col-md-4">
    <button id="" name="Confirmar" class="btn btn-primary">Confirmar</button>
  </div>
</div>

</fieldset>
</form>
