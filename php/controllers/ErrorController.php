<?php

class ErrorController extends Controller {

    public function __construct() {
        
    }

    public function main($error) {
        parent::cargarVista('header.php');
        parent::cargarVista('error.php', $error);
        parent::cargarVista('footer.php');
    }

}
