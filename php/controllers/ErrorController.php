<?php

class ErrorController extends Controller {

    public function __construct() {
        
    }

    public function main($data) {
        parent::cargarVista('header.php');
        parent::cargarVista('error.php', $data);
        parent::cargarVista('footer.php');
    }

}
