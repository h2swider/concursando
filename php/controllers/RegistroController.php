<?php

class RegistroController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main() {
        parent::cargarVista('header.php');
        parent::cargarVista('form_registro.php');
        parent::cargarVista('footer.php', get_class());
    }

    public function procesarRegistro($data = '') {
        if (!empty($data['post'])) {
            if (filter_var($data['post']['email'], FILTER_VALIDATE_EMAIL) === false) {
                die("Mail incorrecto");
            }
            if (!preg_match('/^[a-f0-9]{32}$/', $data['post']['password'])) {
                die("El string no es md5");
            }
        } else {
            die("No data");
        }
    }

    public function testConexion() {
        $registro = new RegistroModel();
        $registro->doSomething();
    }

}
