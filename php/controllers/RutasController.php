<?php
class RutasController {

    private $error = '';

    public function __construct() {
        $this->cargarRutasConfig();
    }

    private function parseUrl($path) {

        $partsURL = explode("/", $path);
        $data['controller'] = $partsURL[0];
        $data['method'] = $partsURL[1];
        return $data;
    }

    private function getController($controller) {
        $path = CONTROLLERS_PATH."$controller.php";
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
        switch (count($partesURL)) {

            case 0:
                $data = $this->parseUrl($rutas["main"]);
                break;
            case 1:
                $data = $this->parseUrl($rutas[$partesURL[1]]);
                break;
            case 2:
                $data = $this->parseUrl($rutas[$partesURL[1] . "/" . $partesURL[2]]);
                break;
            case 3:
                $data = $this->parseUrl($rutas[$partesURL[1] . "/" . $partesURL[2] . "/@param"]);
                $partsRequest = explode("/", $_SERVER['REQUEST_URI']);
                $request['url'] = $e[4];
                break;
            default:
                //Error todo
                break;
        }

        $obj = $this->getController($data['controller']);
        $request['post'] = $_POST;
        $request['get'] = $_GET;
        var_dump($_GET);
        var_dump($_GET['path']);
        var_dump($_SERVER['REQUEST_URI']);
        var_dump($_POST);exit;
        if (!$obj || !$this->callMethod($obj, $data['method'], $request)) {
            echo $this->error && die;
        }
    }

}
