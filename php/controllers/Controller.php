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

}
