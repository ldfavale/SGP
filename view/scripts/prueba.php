<?php

$valores;

$valores["nombre"]="fredd";
$valores["apellido"]="hannay";
$valores["edad"]=22;

$cont=0;


foreach ($valores as $clave=> $valor){
    echo "clave: ".$clave." valor:".$valor;
}