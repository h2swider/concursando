<?php 
class RutasController {
	public function __construct() {
		$this->cargarRutasConfig();
	}
	
	private function cargarRutasConfig() {
		require("Controller.php");
		require("php/config/rutas.php");
		require("php/config/config.php");
		if (!empty($_GET)) {
			$url = explode("?", $_SERVER['REQUEST_URI']);
			$url = $url[0];
		} else {
			$url = $_SERVER['REQUEST_URI'];
		}
		$partesURL = array_filter(explode("/", $url));
		$primerElemento = array_shift($partesURL);
		$urlLength = count($partesURL);
		var_dump($partesURL);
		switch($urlLength) {
				case 0:
					$val = $rutas["main"];
					$partesURL = explode("/", $val);
					$controller = $partesURL[0];
					$method = $partesURL[1];
					require($controller.".php");
					$obj = new $controller();
					$obj->$method();
				break;
				case 1:
					$val = $rutas[$partesURL[0]];
					$partesURL = explode("/", $val);
					$controller = $partesURL[0];
					$method = $partesURL[1];
					require($controller.".php");
					$obj = new $controller();
					$data = array();
					if (!empty($_POST)) {
						$data['post'] = $_POST;
					} else if (!empty($_GET)) {
						$data['get'] = $_GET;
					} 
					if (!empty($data)) {
						$obj->$method($data);
					} else {
						$obj->$method();
					}
				break;
				case 2:
					$val = $rutas[$partesURL[0]."/".$partesURL[1]];
					$partesURL = explode("/", $val);
					$controller = $partesURL[0];
					$method = $partesURL[1];
					require($controller.".php");
					$obj = new $controller();
					if (!empty($_POST)) {
						$data['post'] = $_POST;
					}
					if (!empty($_GET)) {
						$data['get'] = $_GET;
					}
					$obj->$method($data);
				break;
				case 3:
					$objectData = explode("/", $rutas[$partesURL[0]."/".$partesURL[1]."/@param"]);
					$e = explode("/", $_SERVER['REQUEST_URI']);
					$data['url'] = $e[4];
					$controller = $objectData[0];
					$method = $objectData[1];
					require($controller.".php");
					$obj = new $controller();
					if (!empty($_POST)) {
						$data['post'] = $_POST;
					}
					if (!empty($_GET)) {
						$data['get'] = $_GET;
					}
					$obj->$method($data);
				break;
			
			}
	}
	
}
?>