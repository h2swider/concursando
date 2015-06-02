<?php

class WebController extends Controller {

    public function main($data) {
        parent::cargarVista('header.php');
        parent::cargarVista('menu.php');
        parent::cargarVista('index.php');
        parent::cargarVista('footer.php', get_class());
    }

    public function participa($data) {
        parent::cargarVista('header.php');
        parent::cargarVista('menu.php');
        parent::cargarVista('participa.php');
        parent::cargarVista('footer.php', get_class());
    }

}
