<?php

class Controller {

    public function __construct() {

        function __autoload($className) {
            $paths['model'] = MODELS_PATH . $className . '.php';
            $paths['controller'] = CONTROLLERS_PATH . $className . '.php';
            foreach ($paths as $path) {
                if (file_exists($path)) {
                    include $path;
                }
            }
        }

    }

    public function cargarVista($url_template, $data = null) {
        require( VIEWS_PATH . $url_template);
    }
	
	protected function validarFechaNacimiento($input) {
		$date = strtotime('now');
		$timestamp = strtotime(str_replace('/', '-', $input));
		if ($timestamp > $date) {
			return true;
		}
		return false;
	}
	
	protected function validarEmail($input) {
		if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
			Log::form('Mail incorrecto');
			return true;
        }
		return false;
	}
	
	protected function validarPassword($input) {
		if (!preg_match('/^[a-f0-9]{32}$/', $input)) {
			Log::form("El string no es md5");
			return true;
		}
		return false;
	}
	
	protected function validarRequerido($input, $clave) {
		if (empty($input)) {
			Log::form("El campo ".$clave." es requerido.");
			return true;
		}
		return false;
	}
	
	protected function validarClaves($p1, $p2) {
		if ($p1 != $p2) {
			Log::form("Las claves no son iguales");
			return true;
		}
		return false;
	}
	
	protected function validarLargo($input, $clave, $length) {
		if (strlen($input) >$length) {
			Log::form("El campo ".$clave." es mayor a ".$length.". Valor otorgado: ".$input);
		}
		return false;
	}
	
	protected function validarString($input, $clave) {
		if (!filter_var($input, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-záéíóúñ]+$/i")))) {
			Log::form("El valor de ".$clave." no puede ser vacio ni contener caracteres especiales");
			return true;
		}
		return false;
	}

}
