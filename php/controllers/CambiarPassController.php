<?php

class CambiarPassController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main($data) {

        if (true) { // si es valido el token
            parent::cargarVista('header.php');
            parent::cargarVista('cambiar_clave.php', $data);
            parent::cargarVista('footer.php', get_class());
        } else {
            
        }
    }

    public function changePassword($data) {

        $this->main($data);
    }
    
    public function savePassword($data) {

        var_dump($data);
    }

}
