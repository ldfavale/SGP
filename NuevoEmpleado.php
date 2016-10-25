<script>
    function ValidarNumero(numero){
        if (!/^([0-9])*$/.test(numero))
          alert("El valor " + numero + " del campo no es un número");
    }
</script>

<?php

require_once($_SERVER ['DOCUMENT_ROOT']."/controller/Controller.php");

$busqueda = null;

//********************************** Nuevo Empleado ******************************************************

if(isset($_POST['Confirmar'])) {
    $controlador = ControladorE::getInstance();
    
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
    $arg_horario= 0;
    $arg_cargo= 0;
    $arg_estado= 1;//Booleano
    if(isset($_POST['checkboxes'])){
        $arg_arrayrelojes=$_POST['checkboxes'];
    }else{
         $arg_arrayrelojes=null;
    }
    $arg_privilegio=$_POST['privilegio'];
    
    
    $result=$controlador->AltaEmpleado($arg_nick,$arg_privilegio, $arg_nrofuncionario, $arg_nombre, $arg_apellido, $arg_cedula, $arg_direccion, $arg_residencia, $arg_tel, $arg_cel, $arg_correo, $arg_correoinstitucional, $arg_horario, $arg_cargo, $arg_estado, $arg_arrayrelojes);

    if($result==1){
?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <b>Excelente</b> se a agregado el nuevo funcionario.
                    </div> 
   
<?php 

    }else{
        echo '<div class="alert alert-info alert-dismissible" role="alert">'.
                     '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.
                     'ERROR: '.$result.'</div>';

    }
      
}
?>

<!-- Barra superior-->
            <a href="#"><strong><i class="glyphicon glyphicon-plus"></i> Nuevo Funcionario</strong></a>
            <hr>
<!--End  Barra superior-->

<form action="index.php?sec=NuevoEmpleado" method="POST" role="form" class="form-horizontal">

<fieldset>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Nick">Nombre de Usuario:</label>  
  <div class="col-md-4">
  <input id="nick" name="nick" placeholder="UserName" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input NUMERO DE FUNCIONARIO-->
<div class="form-group">
  <label class="col-md-4 control-label" for="nrofuncionario">N°</label>  
  <div class="col-md-4">
      <input id="nrofuncionario" name="nrofuncionario" placeholder="Numero de funcionario" class="form-control input-md" required="" type="text" onkeyup="ValidarNumero(this.value); " onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Nombre">Nombre</label>  
  <div class="col-md-4">
  <input id="Nombre" name="nombre" placeholder="Nombre" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="apellido">Apellido</label>  
  <div class="col-md-4">
  <input id="apellido" name="apellido" placeholder="Apellido" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input NUMERO DE CEDULA-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cedula">Cedula</label>  
  <div class="col-md-4">
      <input id="cedula" name="cedula" placeholder="12345678" maxlength="8" class="form-control input-md" required="" type="text" onkeyup="ValidarNumero(this.value); " onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="residencia">Lugar de residencia</label>  
  <div class="col-md-4">
  <input id="residencia" name="residencia" placeholder="ej: Maldonado" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="direccion">Direccion</label>  
  <div class="col-md-4">
  <input id="direccion" name="direccion" placeholder="Roman Guerra 1999" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input NUMERO DE TELEFONO-->
<div class="form-group">
  <label class="col-md-4 control-label" for="telefono">Telefono</label>  
  <div class="col-md-4">
      <input id="telefono" name="telefono" placeholder="Tel" class="form-control input-md" type="tel" required="" onkeyup="ValidarNumero(this.value); " onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
    
  </div>
</div>

<!-- Text input NUMERO DE CELULAR-->
<div class="form-group">
  <label class="col-md-4 control-label" for="celular">Celular</label>  
  <div class="col-md-4">
      <input id="celular" name="celular" placeholder="Cel" maxlength="9" class="form-control input-md" required="" type="tel" onkeyup="ValidarNumero(this.value); " onchange="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="correo">Correo</label>  
  <div class="col-md-4">
  <input id="correo" name="email" placeholder="Correo" class="form-control input-md" type="email">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="correoinstitucional">Correo Institucional</label>  
  <div class="col-md-4">
  <input id="correoinstitucional" name="emailinstitucional" placeholder="Correo Institucional" class="form-control input-md" required="" type="email">
    
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

 <?php
        $controlador2 = ControladorE::getInstance();
        $privilegios= $controlador2->ListarPrivilegios();
 ?>  
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Seleccione Privilegio:</label>
  <div class="col-md-4">
    <select id="selectbasic" name="privilegio" class="form-control">
      <?php

        foreach ($privilegios as $privilegio){ 

            
            if($_SESSION['tipo']== 1){
                
                if($privilegio->getnombre()!="Funcionario"){
                    echo '<option value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';  
                }
                else{
                    echo '<option selected value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';
                }
                
            }
            else{
                
                if($privilegio->getnombre()!="Funcionario"){
                   if($privilegio->getnombre()!="Administrador"){ echo '<option value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';} 
                }
                else{
                    echo '<option selected value="'.$privilegio->getid().'">'.$privilegio->getnombre().'</option>';
                }
                
            }
            
        }
      
      ?>    
    
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
                
                foreach ($result as $row){

                    echo '<label class="checkbox-inline" for="checkboxes-'.$count.'">';
                    echo '<input name="checkboxes[]" id="checkboxes-'.$count.'" value="'.$row["ID"].'" type="checkbox">';
                    
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
<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="">Añadir empleado</label>
  <div class="col-md-4">
    <button id="" name="Confirmar" class="btn btn-primary">Confirmar</button>
  </div>
</div>

</fieldset>
</form>
