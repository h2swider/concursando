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
			return false;
		}
		return true;
	}
	
	protected function validarEmail($input) {
		if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
			Log::form('Mail incorrecto');
			return false;
        }
		return true;
	}
	
	protected function validarPassword($input) {
		if (!preg_match('/^[a-f0-9]{32}$/', $input)) {
			Log::form("El string no es md5");
			return false;
		}
		return true;
	}
	
	protected function validarRequerido($input, $clave) {
		if (empty($input)) {
			Log::form("El campo ".$clave." es requerido.");
			return false;
		}
		return true;
	}

}
