<?php

class ErrorController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main($data) {
        Log::error($data);
        parent::cargarVista('header.php');
        parent::cargarVista('error.php');
        parent::cargarVista('footer.php', get_class());
    }

}
