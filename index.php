<?php
require('core.php');
if(!isset($_SESSION['id'])){
	header('location: login.php');
        close;
}else{
        if(isset($_GET['sec'])){

            switch ($_GET['sec']) {

                case 'BuscarEmpleados':
                    if($_SESSION['tipo'] == 3){
                        header('location: index.php?sec=verEmpleado&id='.$_SESSION['id']);
                        close;
                    }
                break;

                case 'NuevoEmpleado':
                    if($_SESSION['tipo'] == 3){
                        header('location: index.php?sec=verEmpleado&id='.$_SESSION['id']);
                        close;
                    }
                break;

                case 'ModificarEmpleado':
                    if($_SESSION['tipo'] == 3){
											if(isset($_GET['id'])){
													if($_GET['id'] != $_SESSION['id'] ){
															header('location: index.php?sec=verEmpleado&id='.$_SESSION['id']);

															close;
													}
                    	}
										}

                break;

                case 'verEmpleado':
                   if($_SESSION['tipo'] == 3){
                        if(isset($_GET['id'])){
                            if($_GET['id'] != $_SESSION['id'] ){
                                header('location: index.php?sec=verEmpleado&id='.$_SESSION['id']);

                                close;
                            }
                        }
                   }
                break;

                default:
                    break;
            }

        }else{
            if($_SESSION['tipo'] == 3){

                header('location: index.php?sec=verEmpleado&id='.$_SESSION['id']);
                close;
            }else{
                //Nada por ahora
            }
        }
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>SGPH</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="public/css/bootstrap.min.css" rel="stylesheet">
        <!--[if lt IE 9]>
                <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="public/css/styles.css" rel="stylesheet">
        <link href="public/css/datepicker.css" rel="stylesheet">
        <script src="public/js/jquery-2.1.4.min.js"></script>
        <script src="public/js/bootstrap.min.js"></script>
        <script src="public/js/scripts.js"></script>
        <script src="public/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="public/js/moment.min.js"></script>
        <!-- <script type="text/javascript" src="/path/to/bootstrap/js/transition.js"></script>
        <script type="text/javascript" src="/path/to/bootstrap/js/collapse.js"></script> -->
    </head>
    <body>
        <!-- header -->
        <div id="top-nav" class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SGPH</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <?php if(isset($_SESSION['id'])){echo $_SESSION['nombre'];}else{ echo 'hola';} ?> <span class="caret"></span></a>
                            <ul id="g-account-menu" class="dropdown-menu" role="menu">
                                <li><a href="index.php?sec=verEmpleado&id=<?php if(isset($_SESSION['id'])){echo $_SESSION['id'];}?>">Mi Perfil</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php"><i class="glyphicon glyphicon-lock"></i> Salir</a></li>
                    </ul>
                </div>
            </div>
            <!-- /container -->
        </div>
        <!-- /Header -->

        <!-- Main -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <!-- Left column -->
                    <a href="#"><strong><i class="glyphicon glyphicon-list"></i> Menu</strong></a>

                    <hr>

                    <ul class="nav nav-stacked">
                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#userMenu">General <i class="glyphicon glyphicon-chevron-down"></i></a>
                            <ul class="nav nav-stacked collapse in" id="userMenu">
                                <li class="active"> <a href="index.php"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
                                                                                                        <li class="active"> <a href="index.php?sec=changePass"><i class="glyphicon glyphicon-lock"></i> Cambiar Contrase&ntilde;a</a></li>
                            </ul>
                        </li>

                        <?php if($_SESSION['tipo'] != 3){ ?>
                        <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"> Administracion <i class="glyphicon glyphicon-chevron-right"></i></a>

                            <ul class="nav nav-stacked collapse" id="menu2">
                                <li><a href="index.php?sec=BuscarEmpleados"><i class="glyphicon glyphicon-user"></i> Funcionarios</a></li>
                                <li><a href="index.php?sec=NuevoEmpleado"><i class="glyphicon glyphicon-plus"></i> Nuevo Funcionario</a></li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Salir</a></li>
                    </ul>
                    <hr>
                </div>
                <div class="col-sm-9 "><!--/row - contenido central-->

                    <!-- Contenido Dinamico-->
                    <?php
                            if(!isset($_GET['sec'])){
                                    include (APP_DIR."/BuscarEmpleados.php");
                                }
                                else{
                                    $sec=$_GET['sec'];

                                    if(file_exists(APP_DIR."/".$sec.".php")) {
                                        include(APP_DIR."/".$sec.".php");
                                    }
                                    else{
                                        if(file_exists(APP_DIR."/".$sec.".html")){
                                             include(APP_DIR."/".$sec.".html");
                                        }
                                        else{
                                            echo 'Lo sentimos pero la página solicitada no existe';
                                        }

                                    }
                                }
                    ?>
                    <!-- Fin Contenido Dinamico -->
                </div>
                <!--/col-span-9-->
            </div>
        </div>
        <!-- /Main -->
<!--        <footer class="text-center"> </footer>-->
    </body>
</html>
