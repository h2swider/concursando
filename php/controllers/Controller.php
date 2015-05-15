<?php

class Controller {

    public function __construct() {

        function __autoload($className) {
            include MODELS_PATH . $className . '.php';
        }

    }

    public function cargarVista($url_template, $data = null) {
        require( VIEWS_PATH . $url_template);
    }

}
