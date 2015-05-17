<?php

class RegistroController extends Controller {

    private $errors = array();
    private $salt = '¡c0ncurs4nd0!';

    public function __construct() {
        parent::__construct();
    }

    public function main($data = null) {
        $paises = new PaisModel();
        $data['paises'] = $paises->getPaises();
        parent::cargarVista('header.php');
        parent::cargarVista('form_registro.php', $data);
        parent::cargarVista('footer.php', get_class());
    }

    public function procesarRegistro($data = '') {
        $this->error[] = parent::validarEmail($data['post']['email']);
        $this->error[] = parent::validarPassword($data['post']['password']);
        $this->error[] = parent::validarRequerido($data['post']['email'], "email");
        $this->error[] = parent::validarRequerido($data['post']['password'], "password");
        $this->error[] = parent::validarRequerido($data['post']['nombre'], "nombre");
        $this->error[] = parent::validarRequerido($data['post']['apellido'], "apellido");
        $this->error[] = parent::validarRequerido($data['post']['fecha_nacimiento'], "fecha_nacimiento");
        $this->error[] = parent::validarFechaNacimiento($data['post']['fecha_nacimiento']);
        $this->error[] = parent::validarLargo($data['post']['email'], 'email', 100);
        $this->error[] = parent::validarLargo($data['post']['nombre'], 'nombre', 45);
        $this->error[] = parent::validarLargo($data['post']['apellido'], 'apellido', 45);
        $this->error[] = parent::validarString($data['post']['nombre'], 'nombre');
        $this->error[] = parent::validarString($data['post']['apellido'], 'apellido');
        $this->error[] = parent::validarClaves(md5($data['post']['password'] . $this->salt), md5($data['post']['password2'] . $this->salt));
        
        var_dump($this->error);
        
        if (in_array(true, $this->error)) {
            $this->main($data);
        } else {
            $this->registrarUsuario($data);
        }
    }

    public function validarUsuario($data) {
        $usuario = new UserModel();
        echo json_encode($usuario->valid($data['post']['email']));
    }

    public function errorRegistro() {
        $this->main();
    }

    public function registrarUsuario($data) {
        $usuario = new UserModel();
        $data['post']['password'] = md5($data['post']['password'] . $this->salt);
        if ($usuario->guardarUsuario($data['post'])) {
            Mail::registro($data['post']['email']);
        }
    }

}
