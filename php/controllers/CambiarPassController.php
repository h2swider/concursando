<?php

class CambiarPassController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main($data) {

        parent::cargarVista('header.php');
        parent::cargarVista('cambiar_clave.php', $data);
        parent::cargarVista('footer.php', get_class());
    }

    public function changePassword($data) {
        $recupero = new RecuperoModel();
        if ($recupero->isValidToken($data['url'])) {
            $this->main($data);
        } else {
            parent::cargarVista('header.php');
            parent::cargarVista('token_expirado.php', $data);
            parent::cargarVista('footer.php', get_class());
        }
    }

    public function savePassword($data) {

        $recupero = new RecuperoModel();
        if ($recupero->isValidToken($data['post']['token'])) {

            $this->error[] = parent::validarPassword($data['post']['password']);
            $this->error[] = parent::validarClaves(md5($data['post']['password'] . SALT), md5($data['post']['password2'] . SALT));
            if (in_array(true, $this->error)) {
                
                $data['get']['token'] = $data['post']['token'];
                $this->main($data);
            } else {
                
                $user = new UserModel();
                $user->savePass(explode('-', $data['post']['token'])[0], $data['post']['password']);
                   header('location:/login/clave-cambiada');
                exit;
            }
        } else {
            
            parent::cargarVista('header.php');
            parent::cargarVista('token_expirado.php', $data);
            parent::cargarVista('footer.php', get_class());
        }
    }

}
