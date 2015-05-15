<?php

class UsuarioController extends Controller {

    public function __construct() {
        
    }

    public function main() {
        
    }

    public function panelUsuario($data = '') {
        var_dump($data);
    }

    public function printHola($data) {
        echo "HOLA, los get son:";
        var_dump($data);
    }

    public function test() {
        echo "test2";
    }

}

?>