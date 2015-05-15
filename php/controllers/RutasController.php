<?php

class RutasController {

    private $error = false;
    private $rutas;

    public function __construct() {
        require_once("php/config/config.php");
        require_once("Controller.php");
        $this->rutas = parse_ini_file(ROOT . '/php/config/rutas.ini');
        $this->cargarRutasConfig($_SERVER['REQUEST_URI']);
    }

    private function parseUrl($path) {

        if (isset($this->rutas[$path])) {

            $partsURL = explode("/", $this->rutas[$path]);
            $data['controller'] = $partsURL[0];
            $data['method'] = $partsURL[1];
            return $data;
        } else {
            $this->error = "No existe la ruta '$path'";
            $this->controllerError();
        }
    }

    private function getController($controller) {
        $path = CONTROLLERS_PATH . "$controller.php";
        if (file_exists($path)) {
            require($path);
            if (class_exists($controller)) {
                return new $controller();
            } else {
                $this->error = "No existe la clase '$controller'";
                $this->controllerError();
            }
        } else {
            $this->error = "No existe el archivo '$path'";
            $this->controllerError();
        }
    }

    private function callMethod($obj, $method, $params = null) {
        if (method_exists($obj, $method)) {
            $obj->$method($params);
        } else {
            $this->error = "No existe el metodo '$method'";
            $this->controllerError();
        }
    }

    private function controllerError() {
        require_once CONTROLLERS_PATH . "ErrorController.php";
        $data = array();
        $data['get']['error'] = $this->error;
        $this->callMethod(new ErrorController(), 'main', $data);
        exit;
    }

    private function cargarRutasConfig($base_url) {
        $foo = explode("?", $base_url);
        $partesURL = array_filter(explode("/", $foo[0]));
        switch (count($partesURL)) {
            case 0:
                $data = $this->parseUrl("main");
                break;
            case 1:
                $data = $this->parseUrl($partesURL[1]);
                break;
            case 2:
                $data = $this->parseUrl($partesURL[1] . "/" . $partesURL[2]);
                break;
            default:
                $data = $this->parseUrl($partesURL[1] . "/" . $partesURL[2] . "/@param");
                break;
        }
        $obj = $this->getController($data['controller']);
        $request['post'] = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $request['get'] = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->callMethod($obj, $data['method'], $request);
    }

}
