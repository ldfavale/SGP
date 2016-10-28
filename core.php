<?php

session_start();
require('funciones/encrypt.php');
require('config/database.php');
$base = new database();
//$base->getInstance();

define('DB_HOST',$base->getHost());
define('DB_USER',$base->getUser());
define('DB_PASS',$base->getPass());
define('DB_NAME',$base->getDB()); 

define('APP_URL',"http://contralor.cure.edu.uy/");
define('ABS_PATH',getcwd());
define('APP_NAME',"SGPH");
define('APP_DIR',$_SERVER["DOCUMENT_ROOT"]."/".APP_NAME);

?>
