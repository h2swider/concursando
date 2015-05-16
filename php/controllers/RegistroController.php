<?php

class RegistroController extends Controller {
	private $error = false;
	
    public function __construct() {
        parent::__construct();
    }

    public function main($data = null) {
        parent::cargarVista('header.php');
        parent::cargarVista('form_registro.php', $data);
        parent::cargarVista('footer.php');
    }

    public function procesarRegistro($data = '') {
        if (!filter_var($data['post']['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = 'Mail incorrecto';
			Log::error($this->error);
        }
        if (!preg_match('/^[a-f0-9]{32}$/', $data['post']['password'])) {
			$this->error = "El string no es md5";
			Log::error($this->error);
		}
		
		if ($this->error) {
			$this->main($data);
		} else {
			$this->registrarUsuario($data);
		}
    }

    public function registrarUsuario($data) {
        $usuario = new UserModel();
        $usuario->setUsuario($data['post']['mail']);
		$usuario->setClave($data['post']['password']);
		$usuario->guardarUsuario();
    }

}
