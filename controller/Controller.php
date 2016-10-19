<?php

/* 
 * Clase para cargar todos los controladores una vez
 * Se evitan nombres incorrectos y otras incosistencias 
 */

require_once($_SERVER ['DOCUMENT_ROOT']."/controller/ControladorE.php");
require_once($_SERVER ['DOCUMENT_ROOT']."/controller/ControladorM.php");
require_once($_SERVER ['DOCUMENT_ROOT']."/controller/ControladorR.php");
require_once($_SERVER ['DOCUMENT_ROOT']."/controller/ControladorS.php");
require_once($_SERVER ['DOCUMENT_ROOT']."/controller/ControladorP.php");
