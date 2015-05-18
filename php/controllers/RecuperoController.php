<?php

class RecuperoController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function main() {
        
    }

    public function recovery() {
        parent::cargarVista("header.php");
        parent::cargarVista("recuperar_clave.php");
        parent::cargarVista("footer.php", get_class());
    }

    public function send($data = null) {
        if (!parent::validarEmail($data['post']['email'])) {
            $user = new UserModel();
            $userID = $user->existsEmail($data['post']['email']);
            if ($userID) {
                $token = $user->recovery($userID);
                Mail::recovery($data['post']['email'], $userID . "-" . $token);
                header("Location: /recuperar/ok/{$data['post']['email']}");
                exit;
            } else {
                header("Location: /recuperar-clave/");
                exit;
            }
        } else {
            header("Location: /recuperar-clave/");
            exit;
        }
    }

    public function sendOk($data) {
        $data['msg'] = 'Se envio un mail a <strong>'.$data['url'].'</strong> para cambiar su clave.';
        parent::cargarVista('header.php');
        parent::cargarVista('form_login.php', $data);
        parent::cargarVista('footer.php', get_class());
    }
    
    public function changePassword($data) {
        parent::cargarVista('header.php');
        parent::cargarVista('cambiar_clave.php', $data);
        parent::cargarVista('footer.php', get_class());
    }

}
