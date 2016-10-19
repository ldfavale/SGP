<?php

class database{

    //private $host="olinda.cure.edu.uy";
    private $host="localhost";
    private $user="sgph";
    //private $user="usuario";
    private $password="2tBUSSQtP34yPNfP";
    //private $password="pass";
    private $db="sgph";
    private $charset = "utf8";
    private static $instance = NULL;

    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new database();
        }
        return self::$instance;
    }

    function getHost(){
        return $this->host;
    }
    function getUser(){
        return $this->user;
    }
    function getPass(){
        return $this->password;
    }
    function getDB(){
        return $this->db;
    }
    function getCharset(){
        return $this->charset;
    }
}
