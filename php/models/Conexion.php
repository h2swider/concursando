<?php

class Conexion {

    private static $instance;
    public $conex;

    public function __construct() {

        $data = parse_ini_file(CONFIG_PATH . 'db.ini', true);
        try {
            $this->conex = new PDO("mysql:host={$data['concursando']['host']};dbname={$data['concursando']['db']}", $data['concursando']['user'], $data['concursando']['pass']);
            $this->conex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conex->exec("set names utf8");
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public static function getInstance() {

        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __destruct() {
        $this->conex = null;
    }

}
