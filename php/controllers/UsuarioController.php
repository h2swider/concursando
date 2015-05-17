<?php

class UsuarioController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main() {
        echo 3;
    }

    public function panelUsuario($data = '') {
        var_dump($data);
    }
    
    public function confirmar($data){
        var_dump($data['url']);
    }

}