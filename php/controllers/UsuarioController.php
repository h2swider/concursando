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
        echo 1;exit;
        header('location:/cerror/custom/?error=Este es un error custom');exit;
    }

    public function test() {
        echo "test2";
    }

}