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
        $this->error = parent::validarEmail($data['post']['email']);
		$this->error = parent::validarPassword($data['post']['password']);
		$this->error = parent::validarRequerido($data['post']['email'], "email");
		$this->error = parent::validarRequerido($data['post']['password'], "password");
		$this->error = parent::validarRequerido($data['post']['nombre'], "nombre");
		$this->error = parent::validarRequerido($data['post']['apellido'], "apellido");
		$this->error = parent::validarRequerido($data['post']['fecha_nacimiento'], "fecha_nacimiento");
		$this->error = parent::validarFechaNacimiento($data['post']['fecha_nacimiento']);
		$this->error = parent::validarClaves($data['post']['password'], $data['post']['password2']);
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
