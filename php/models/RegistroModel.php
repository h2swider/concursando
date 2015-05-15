<?php

class RegistroModel {

    private $conexion;

    public function __construct() {

        $this->conexion = Conexion::getInstance()->conex;
    }

    public function doSomething() {
        
        var_dump($this->conexion);
        echo "En este momento ya tengo una conexion PDO completamente funcional";
        
    }


}
