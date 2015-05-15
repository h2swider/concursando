<?php

class RutasController {

    private $error = false;
    private $rutas;

    public function __construct() {
        require("php/config/config.php");
        require("Controller.php");
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
            return false;
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
                return false;
            }
        } else {
            $this->error = "No existe el archivo '$path'";
            return false;
        }
    }

    private function callMethod($obj, $method, $params = null) {
        if (method_exists($obj, $method)) {
            $obj->$method($params);
        } else {
            $this->error = "No existe el metodo '$method'";
            return false;
        }
    }

    private function cargarRutasConfig($base_url) {

        $partesURL = array_filter(explode("/", explode("?", $base_url)[0]));
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
            case 3:
                $data = $this->parseUrl($partesURL[1] . "/" . $partesURL[2] . "/@param");
                $e = explode("/", $base_url);
                $request['url'] = $e[4];
                break;
            default:
                $data['controller'] = 'ErrorController';
                $data['method'] = 'main';
                $request['get']['error'] = 'Cantidad de parametros invalida';
                break;
        }
        if (!$this->error) {

            $obj = $this->getController($data['controller']);

            $request['post'] = $_POST;
            $request['get'] = $_GET;

            if ($this->error || !$this->callMethod($obj, $data['method'], $request)) {
                require_once CONTROLLERS_PATH . "ErrorController.php";
                $data['get']['error'] = $this->error;
               
                $this->callMethod(new ErrorController(), 'main', $data);
            }
        } else {
            require_once CONTROLLERS_PATH . "ErrorController.php";
            $data['get']['error'] = $this->error;
            $this->callMethod(new ErrorController(), 'main', $data);
        }
    }

}
