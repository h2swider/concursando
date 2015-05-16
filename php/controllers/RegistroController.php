<?php

class RegistroController extends Controller {
	private $error = false;
	
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
        parent::validarEmail($data['post']['email']);
		parent::validarPassword($data['post']['password']);
		parent::validarRequerido($data['post']['email'], "email");
		parent::validarRequerido($data['post']['password'], "password");
		parent::validarRequerido($data['post']['nombre'], "nombre");
		parent::validarRequerido($data['post']['apellido'], "apellido");
		parent::validarRequerido($data['post']['fecha_nacimiento'], "fecha_nacimiento");
		parent::validarFechaNacimiento($data['post']['fecha_nacimiento']);
		if ($this->error) {
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
		$usuario->guardarUsuario($data['post']);
    }
}
