<?php 
class RutasController {
	public function __construct() {
		$this->cargarRutasConfig();
	}
	
	private function cargarRutasConfig() {
		require("Controller.php");
		require("php/config/rutas.php");
		require("php/config/config.php");
		foreach($rutas as $k=>$v) {
			$parts = explode("/", $_SERVER['REQUEST_URI']);
			if ($k == $parts[2]) {				
				$val = $rutas[$parts[2]];
				$parts = explode("/", $val);
				$controller = $parts[0];
				$method = $parts[1];
				require($controller.".php");
				$obj = new $controller();
				$obj->$method();
			}
		}
	}
	
}
?>