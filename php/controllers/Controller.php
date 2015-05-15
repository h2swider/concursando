<?php

class Controller {

    public function __construct() {
        
    }

    public function cargarVista($url_template, $data = null) {
        require( VIEWS_PATH . $url_template);
    }

}